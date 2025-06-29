<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecommendationController extends Controller
{
    public function recommendProducts($userId)
    {
        // گرفتن سفارشات کاربران
        $orders = DB::table('orders as o')
            ->join('order_details as od', 'o.id', '=', 'od.order_id')
            ->select('o.user_id', 'od.product_id')
            ->distinct()
            ->get();

        // ساخت جدول Pivot
        $pivot = [];
        foreach ($orders as $order) {
            $pivot[$order->user_id][$order->product_id] = 1;
        }

        // بررسی وجود کاربر
        if (!isset($pivot[$userId])) {
            return view('frontend.user.recommendations')->with('recommendedProducts', []);
        }

        // محاسبه شباهت با سایر کاربران
        $similarities = [];
        foreach ($pivot as $otherUserId => $products) {
            if ($otherUserId == $userId) continue;

            $similarity = $this->cosineSimilarity($pivot[$userId], $products);
            $similarities[$otherUserId] = $similarity;
        }

        // انتخاب نزدیک‌ترین کاربران
        arsort($similarities);
        $nearestUsers = array_slice(array_keys($similarities), 0, 5);

        // جمع‌آوری محصولات پیشنهادی
        $userProducts = array_keys($pivot[$userId]);
        $recommended = [];

        foreach ($nearestUsers as $neighUserId) {
            $neighProducts = array_keys($pivot[$neighUserId]);
            foreach ($neighProducts as $productId) {
                if (!in_array($productId, $userProducts)) {
                    $recommended[] = $productId;
                }
            }
        }

        $recommended = array_unique($recommended);

        // گرفتن محصولات و افزودن صفحه‌بندی
        $recommendedProducts = Product::whereIn('id', $recommended)
            ->where('quntity', '>', 0)
            ->paginate(16);

        return view('frontend.user.recommendations', compact('recommendedProducts'));
    }

    private function cosineSimilarity($vecA, $vecB)
    {
        $dot = 0;
        $normA = 0;
        $normB = 0;
        $allKeys = array_unique(array_merge(array_keys($vecA), array_keys($vecB)));

        foreach ($allKeys as $key) {
            $valA = $vecA[$key] ?? 0;
            $valB = $vecB[$key] ?? 0;
            $dot += $valA * $valB;
            $normA += $valA * $valA;
            $normB += $valB * $valB;
        }

        return ($normA * $normB) == 0 ? 0 : $dot / (sqrt($normA) * sqrt($normB));
    }
}
