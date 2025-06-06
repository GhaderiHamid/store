<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Payment;
use App\Models\Product;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $users = range(17, 217);
        shuffle($users); // برای توزیع تصادفی بین کاربران

        for ($i = 0; $i < 2000; $i++) {
            $userId = $users[$i % count($users)]; // توزیع مساوی بین کاربران
            $this->createOrder($userId);
        }
    }

    private function createOrder($userId)
    {
        $order = Order::create([
            'user_id' => $userId,
            'status' => $status = $this->getRandomStatus(),
            'created_at' => $this->getCreatedAt($status),
            'updated_at' => $this->getUpdatedAt($status),
        ]);

        $products = Product::whereBetween('id', [201, 420])
            ->inRandomOrder()
            ->take(rand(1, 5))
            ->get();

        $totalAmount = 0;

        foreach ($products as $product) {
            $quantity = rand(1, 5);
            $discountPercentage = $product->discount ?? 0;
            $price = $product->price;
            $discountAmount = ($price * $discountPercentage) / 100;
            $finalPrice = $price - $discountAmount;

            Order_detail::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $price,
                'discount' => $discountPercentage,
                'status' => $status,
                'created_at' => $this->getCreatedAt($status),
                'updated_at' => $this->getUpdatedAt($status),
            ]);

            $totalAmount += $finalPrice * $quantity;
        }

        Payment::create([
            'order_id' => $order->id,
            'amount' => $totalAmount,
            'transaction' => 'TRX-' . strtoupper(uniqid()),
            'status' => 'paid',
        ]);
    }

    private function getRandomStatus()
    {
        return ['processing', 'shipped', 'delivered', 'returned'][rand(0, 3)];
    }

    private function getCreatedAt($status)
    {
        switch ($status) {
            case 'processing':
                return Carbon::now()->subDays(rand(1, 3));
            case 'shipped':
                return Carbon::now()->subDays(rand(4, 7));
            case 'delivered':
                return Carbon::now()->subDays(rand(10, 30));
            case 'returned':
                return Carbon::now()->subDays(rand(60, 90));
            default:
                return Carbon::now();
        }
    }

    private function getUpdatedAt($status)
    {
        switch ($status) {
            case 'processing':
                return Carbon::now()->subDays(rand(1, 3));
            case 'shipped':
                return Carbon::now();
            case 'delivered':
                return Carbon::now()->subDays(rand(10, 30));
            case 'returned':
                return Carbon::now()->subDays(rand(60, 90));
            default:
                return Carbon::now();
        }
    }
}