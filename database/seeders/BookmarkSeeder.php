<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookmarkSeeder extends Seeder
{
    public function run()
    {
        $users = range(17, 217); // لیست کاربران
        $products = range(201, 420); // لیست محصولات
        $count = 500; // تعداد کل داده‌ها
        $userIndex = 0; // شمارنده برای گردش کاربران

        for ($i = 0; $i < $count; $i++) {
            $user_id = $users[$userIndex];
            $product_id = $products[array_rand($products)];
            $created_at = Carbon::now()->subDays(rand(0, 365)); // زمان تصادفی در یک سال گذشته
            $updated_at = $created_at->copy()->addDays(rand(0, 30)); // مقدار تصادفی بین created_at و 30 روز بعد

            // بررسی داده تکراری قبل از درج
            $exists = DB::table('bookmarks')
                ->where('user_id', $user_id)
                ->where('product_id', $product_id)
                ->exists();

            if (!$exists) {
                DB::table('bookmarks')->insert([
                    'user_id' => $user_id,
                    'product_id' => $product_id,
                    'created_at' => $created_at,
                    'updated_at' => $updated_at,
                ]);
            }

            // تغییر userIndex برای توزیع مساوی
            $userIndex = ($userIndex + 1) % count($users);
        }
    }
}
