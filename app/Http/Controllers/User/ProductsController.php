<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Vote;
use App\Support\Storage\Contracts\StorageInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ProductsController extends Controller
{
    public function all(Request $request)
    {
        $query = Product::query();

        // اگر دسته‌بندی انتخاب شده باشد
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));

            // فقط محصولات موجود
            if ($request->filled('in_stock')) {
                $query->where('quntity', '>', 0);
            }

            // فیلتر قیمت
            if ($request->filled('min_price')) {
                $query->whereRaw('(price - (price * discount / 100)) >= ?', [$request->min_price]);
            }

            if ($request->filled('max_price')) {
                $query->whereRaw('(price - (price * discount / 100)) <= ?', [$request->max_price]);
            }

            // اگر مرتب‌سازی بر اساس قیمت است، مقدار محاسبه شده را select کنید
            if (in_array($request->get('sort'), ['price_asc', 'price_desc'])) {
                $query->selectRaw('*, (price - (price * discount / 100)) as final_price');
            }

            // مرتب‌سازی
            if ($request->get('sort') === 'newest') {
                $query->orderBy('created_at', 'desc');
            } elseif ($request->get('sort') === 'price_asc') {
                $query->orderBy('final_price', 'asc');
            } elseif ($request->get('sort') === 'price_desc') {
                $query->orderBy('final_price', 'desc');
            }
        } elseif ($request->filled('search')) {
            // اعمال جستجو فقط اگر دسته‌بندی انتخاب نشده باشد
            $query->where(function ($q) use ($request) {
                $search = $request->input('search');
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('brand', 'like', '%' . $search . '%');
            });
        } else {
            // اگر هیچ دسته‌ای انتخاب نشده باشد، هیچ محصولی نمایش داده نشود
            $query->whereRaw('0 = 1');
        }

        $products = $query->paginate(20)->appends($request->except('page'));

        return view('frontend.product.all', compact('products'));
    }


    public function single($product_id)
    {

        $product = Product::findOrFail($product_id);
        $similarProducts = Product::where('category_id', $product->category_id)
            ->where('quntity', '>', 0)
            ->take(4)
            ->get();
        return view('frontend.product.single', compact('product', 'similarProducts'));
    }
    // public function recommendProducts($userId)
    // {
    //     // دریافت داده‌های پیشنهادی از API
    //     $response = file_get_contents("http://127.0.0.1:5000/products/recommend?user_id=" . $userId);
    //     $data = json_decode($response, true);

    //     // بررسی اینکه آیا داده‌ای دریافت شده است
    //     if (!isset($data['recommendations']) || empty($data['recommendations'])) {
    //         return view('frontend.user.recommendations')->with('recommendedProducts', []);
    //     }

    //     // دریافت محصولات پیشنهادی از دیتابیس
    //     $recommendedProducts = Product::whereIn('id', $data['recommendations'])->get();

    //     return view('frontend.user.recommendations', compact('recommendedProducts'));
    // }
  

    public function recommendProducts($userId)
    {
        // آدرس جدید API روی سرور Render
        // $apiUrl = 'https://flask-ai-ps4l.onrender.com/recommend';
        $apiUrl = 'https://recommend.liara.run';
    
        // ارسال درخواست به API Flask
        $response = Http::get($apiUrl, [
            'user_id' => $userId,
        ]);

        // بررسی موفقیت پاسخ
        if (!$response->successful()) {
            return view('frontend.user.recommendations')->with('recommendedProducts', []);
        }

        $data = $response->json();

        // بررسی وجود پیشنهادها
        if (!isset($data['recommendations']) || empty($data['recommendations'])) {
            return view('frontend.user.recommendations')->with('recommendedProducts', []);
        }

        // دریافت اطلاعات محصولات از دیتابیس
        $recommendedProducts = Product::whereIn('id', $data['recommendations'])->get();

        return view('frontend.user.recommendations', compact('recommendedProducts'));
    }
    
   
}
