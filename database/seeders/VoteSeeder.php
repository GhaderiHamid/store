<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VoteSeeder extends Seeder
{
    public function run()
    {
        $users = range(17, 217); // محدوده user_id
        $products = range(201, 420); // محدوده product_id
        $count = 1000; // تعداد رأی‌ها
        $userIndex = 0; // شمارنده برای توزیع مساوی

        for ($i = 0; $i < $count; $i++) {
            $user_id = $users[$userIndex];
            $product_id = $products[array_rand($products)];
            $value = rand(1, 5);
            $timestamp = Carbon::now()->subDays(rand(0, 365));

            // بررسی اینکه آیا مقدار قبلاً درج شده است
            $exists = DB::table('votes')
                ->where('user_id', $user_id)
                ->where('product_id', $product_id)
                ->exists();

            if (!$exists) {
                DB::table('votes')->insert([
                    'user_id' => $user_id,
                    'product_id' => $product_id,
                    'value' => $value,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ]);
            }

            // تغییر userIndex برای توزیع مساوی
            $userIndex = ($userIndex + 1) % count($users);
        }
    }
}
