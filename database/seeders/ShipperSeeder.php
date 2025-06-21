<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class ShipperSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('fa_IR'); // استفاده از لوکال فارسی

        // ابتدا حذف داده‌های موجود
        DB::table('shippers')->delete();
        $cities = [
            ['city' => 'تهران', 'area' => 730],
            ['city' => 'اصفهان', 'area' => 551],
            ['city' => 'مشهد', 'area' => 328],
            ['city' => 'تبریز', 'area' => 324],
            ['city' => 'شیراز', 'area' => 240],
            ['city' => 'کرمانشاه', 'area' => 160],
            ['city' => 'قم', 'area' => 127],
            ['city' => 'اهواز', 'area' => 185],
            ['city' => 'سنندج', 'area' => 100],
            ['city' => 'رشت', 'area' => 80],
            ['city' => 'یزد', 'area' => 110],
            ['city' => 'زاهدان', 'area' => 200],
            ['city' => 'بندرعباس', 'area' => 45],
            ['city' => 'ارومیه', 'area' => 162],
            ['city' => 'کرمان', 'area' => 220],
            ['city' => 'گرگان', 'area' => 85],
            ['city' => 'خرم‌آباد', 'area' => 95],
            ['city' => 'ساری', 'area' => 90],
            ['city' => 'قزوین', 'area' => 120],
            ['city' => 'بوشهر', 'area' => 70],
            ['city' => 'ایلام', 'area' => 60],
            ['city' => 'اردبیل', 'area' => 105],
            ['city' => 'بجنورد', 'area' => 88],
            ['city' => 'بیرجند', 'area' => 92],
            ['city' => 'شهرکرد', 'area' => 75],
            ['city' => 'همدان', 'area' => 130],
            ['city' => 'خرمشهر', 'area' => 50],
            ['city' => 'کاشان', 'area' => 115],
            ['city' => 'نجف‌آباد', 'area' => 98],
            ['city' => 'مراغه', 'area' => 80],
            ['city' => 'کیش', 'area' => 30],
        ];

        foreach ($cities as $cityData) {
            $count = $this->getShipperCount($cityData['area']);
            for ($i = 1; $i <= $count; $i++) {
                DB::table('shippers')->insert([
                    'first_name' => $faker->firstName,
                    'last_name' => $faker->lastName,
                    'email' => $faker->unique()->safeEmail,
                    'city' => $cityData['city'],
                    'phone' => '09' . rand(100000000, 999999999),
                    'password' => Hash::make('1234'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    private function getShipperCount($area)
    {
        if ($area >= 1000) return rand(20, 25);    // کلان‌شهر بسیار بزرگ
        if ($area >= 700)  return rand(15, 20);    // کلان‌شهر پرجمعیت (مثل تهران)
        if ($area >= 500)  return rand(12, 16);    // مراکز استان متوسط
        if ($area >= 300)  return rand(8, 12);     // شهرهای بزرگ مثل مشهد یا تبریز
        if ($area >= 200)  return rand(6, 9);      // شهرهای متوسط
        if ($area >= 120)  return rand(4, 6);      // شهرهای درحال توسعه
        if ($area >= 60)   return rand(2, 4);      // شهرهای کوچک
        return 1;                                   // شهرهای بسیار کوچک یا روستاها
    }
}
