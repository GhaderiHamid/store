<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class CartController extends Controller
{
    public function addAjax(Request $request)
    {
        Reservation::where('reserved_at', '<', now()->subMinutes(15))->delete();

        $productId = $request->input('product_id');
        $product = Product::find($productId);

        if (!$product) {
            return response()->json([
                'success' => false,
                'error' => 'out_of_stock',
                'message' => 'محصول موجود نیست'
            ]);
        }

        $cart = session()->get('cart', []);
        $currentQuantity = $cart[$productId] ?? 0;
        if ($product->limited > 0 && $currentQuantity >= $product->limited) {
            return response()->json([
                'success' => false,
                'error' => 'limited_exceeded',
                'message' => 'شما به حداکثر تعداد مجاز خرید این محصول رسیده‌اید'
            ]);
        }
        $reservedByOthers = Reservation::where('product_id', $productId)
            ->where('reserved_at', '>=', now()->subMinutes(15))
            ->where('user_id', '!=', auth('web')->id())
            ->sum('quantity');

        $available = $product->quntity - $reservedByOthers;
        if ($product->quntity <= 0) {
            return response()->json([
                'success' => false,
                'error' => 'out_of_stock',
                'message' => 'این محصول در حال حاضر موجود نیست'
            ]);
        }
        if ($available <= 0) {
            return response()->json([
                'success' => false,
                'error' => 'reserved_by_others',
                'message' => 'این محصول توسط سایر مشتریان رزرو شده است. لطفاً بعداً مجدداً تلاش کنید یا محصول مشابه دیگری انتخاب نمایید.'
            ]);
        }
        if (($currentQuantity + 1) > $available) {
            return response()->json([
                'success' => false,
                'error' => 'quantity_exceeded',
                'message' => sprintf('فقط %d عدد از این محصول قابل خرید است', $available)
            ]);
        }

        $cart[$productId] = $currentQuantity + 1;
        session(['cart' => $cart]);

        Reservation::updateOrCreate(
            ['user_id' => auth('web')->id(), 'product_id' => $productId],
            ['quantity' => $cart[$productId], 'reserved_at' => now()]
        );

        return response()->json([
            'success' => true,
            'cart_count' => array_sum($cart),
            'available_quantity' => $available - ($currentQuantity + 1)
        ]);
    }

    public function updateQuantity(Request $request)
    {
        Reservation::where('reserved_at', '<', now()->subMinutes(15))->delete();

        try {
            $request->validate([
                'product_id' => 'required|integer|exists:products,id',
                'quantity' => 'required|integer|min:1',
            ]);

            $product = Product::findOrFail($request->product_id);
            $cart = session()->get('cart', []);
            $newQuantity = $request->quantity;

            $reservedByOthers = Reservation::where('product_id', $product->id)
                ->where('reserved_at', '>=', now()->subMinutes(15))
                ->where('user_id', '!=', auth('web')->id())
                ->sum('quantity');

            $available = $product->quntity - $reservedByOthers;

            if ($newQuantity > $available) {
                return response()->json([
                    'success' => false,
                    'message' => 'موجودی کافی نیست. فقط ' . $available . ' عدد موجود است',
                ], 400);
            }

            $cart[$product->id] = $newQuantity;
            session(['cart' => $cart]);

            Reservation::updateOrCreate(
                ['user_id' => auth('web')->id(), 'product_id' => $product->id],
                ['quantity' => $newQuantity, 'reserved_at' => now()]
            );

            // محاسبه subtotal همین محصول
            $discount = $product->discount ?? 0;
            $final_price = round($product->price - ($product->price * $discount / 100));
            $subtotal = $final_price * $newQuantity;

            // محاسبه مجموع کل سبد خرید
            $total = 0;
            foreach ($cart as $id => $qty) {
                $p = Product::find($id);
                if ($p) {
                    $d = $p->discount ?? 0;
                    $f = round($p->price - ($p->price * $d / 100));
                    $total += $f * $qty;
                }
            }

            return response()->json([
                'success' => true,
                'new_quantity' => $newQuantity,
                'product_quantity' => $available,
                'cart_count' => array_sum($cart),
                'subtotal' => $subtotal,
                'total_price' => $total
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطای سرور: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function remove($productId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session(['cart' => $cart]);

            Reservation::where('user_id', auth('web')->id())
                ->where('product_id', $productId)
                ->delete();
        }

        return redirect()->route('frontend.cart.all');
    }

    public function all()
    {
        // ۱. حذف رزروهای منقضی‌شده (بیش از ۱۵ دقیقه گذشته)
        Reservation::where('reserved_at', '<', now()->subMinutes(15))->delete();

        $cart = session('cart', []);
        $reservations = [];
        $total = 0;

        if (auth('web')->check()) {
            // ۲. دریافت رزروهای معتبر کاربر
            $userReservations = Reservation::where('user_id', auth('web')->id())
                ->where('reserved_at', '>=', now()->subMinutes(15))
                ->get()
                ->keyBy('product_id');

            foreach ($userReservations as $productId => $reservation) {
                $reservations[$productId] = \Carbon\Carbon::parse($reservation->reserved_at)->timestamp;
            }

            // ۳. پاکسازی session از آیتم‌هایی که رزرو معتبر ندارند
            foreach ($cart as $productId => $qty) {
                if (!isset($reservations[$productId])) {
                    unset($cart[$productId]);
                }
            }

            session(['cart' => $cart]);

            // ۴. محاسبه جمع کل فقط از روی محصولات باقی‌مانده در سبد
            foreach ($cart as $productId => $qty) {
                $product = \App\Models\Product::find($productId);
                if ($product) {
                    $discount = $product->discount ?? 0;
                    $finalPrice = round($product->price - ($product->price * $discount / 100));
                    $total += $finalPrice * intval($qty);
                }
            }
        }

        // ۵. ارسال داده‌ها به ویو
        return view('frontend.cart.all', [
            'cart' => $cart,
            'reservations' => $reservations,
            'products' => \App\Models\Product::whereIn('id', array_keys($cart))->get(),
            'total' => $total,
        ]);
    }
    public function removeExpired(Product $product)
    {
        $cart = session('cart', []);
        unset($cart[$product->id]);
        session(['cart' => $cart]);

        Reservation::where('user_id', auth('web')->id())
            ->where('product_id', $product->id)
            ->delete();

        return response()->json(['success' => true]);
    }
    public function getTotal()
    {
        $cart = session('cart', []);
        $total = 0;

        foreach ($cart as $productId => $qty) {
            $product = \App\Models\Product::find($productId);
            if ($product) {
                $discount = $product->discount ?? 0;
                $final = round($product->price - ($product->price * $discount / 100));
                $total += $final * intval($qty);
            }
        }

        return response()->json(['total' => $total]);
    }
    public function checkReservationStatus()
    {
        $data = session('payment_data');

        if (!$data || !isset($data['user_id']) || !is_array($data['products'])) {
            return response()->json(['valid' => false, 'reason' => 'invalid_data']);
        }

        $userId = $data['user_id'];
        $products = $data['products'];

        foreach ($products as $p) {
            $product = \App\Models\Product::find($p['product_id']);

            if (!$product || $product->quntity < $p['quantity']) {
                return response()->json([
                    'valid' => false,
                    'reason' => 'purchased_by_others'
                ]);
            }
        }

        return response()->json(['valid' => true]);
    }
}
