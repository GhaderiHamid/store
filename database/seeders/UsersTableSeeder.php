<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('fa_IR'); // استفاده از لوکال فارسی

        // ابتدا حذف داده‌های موجود
        DB::table('users')->delete();

        foreach (range(1, 200) as $index) { // ایجاد ۵۰ کاربر تصادفی
            $address = $faker->address;
            $address = $this->removeProvinceKeyword($address); // حذف کلمه "استان" اگر موجود باشد

            // استخراج نام شهر از آدرس
            $city = $this->extractCityFromAddress($address); // استفاده از تابع استخراج شهر

            DB::table('users')->insert([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'password' => Hash::make('password'), // رمز عبور پیش‌فرض
                'email' => $faker->unique()->safeEmail,
                'city' => $city, // نام شهر استخراج‌شده
                'phone' => '09' . $faker->numberBetween(100000000, 999999999), // شماره موبایل معتبر ایرانی
                'role' => 'user',
                'address' => $address, // آدرس تصادفی
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'), // تاریخ تصادفی
            ]);
        }
    }

    /**
     * Extract city name from address.
     *
     * @param string $address
     * @return string
     */
    private function extractCityFromAddress($address)
    {
        // الگوریتم برای استخراج نام شهر تا قبل از کلمه "خیابان"
        preg_match('/^(.*?)\sخیابان/u', $address, $matches); // متن تا قبل از کلمه "خیابان" استخراج می‌شود
        return isset($matches[1]) ? trim($matches[1]) : 'نامشخص'; // اگر پیدا نشد، مقدار پیش‌فرض قرار داده می‌شود
    }
    private function removeProvinceKeyword($address)
    {
        // بررسی وجود کلمه "استان" در ابتدای آدرس
        if (strpos($address, 'استان') === 0) {
            // حذف کلمه "استان" از ابتدای آدرس
            $address = preg_replace('/^استان\s*/u', '', $address);
        }
        return $address;
    }
}
