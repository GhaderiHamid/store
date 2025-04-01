<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // پاکسازی جدول products (اختیاری)
        DB::table('products')->delete();

        DB::table('products')->insert([
            [
                'name'         => 'مادربرد قدرتمند',
                'description'  => 'حجم حافظه: 64GB، فرکانس پردازنده: 3.6GHz، نسل: 12، پورت‌ها: USB-C و HDMI.',
                'brand'        => 'اینتل',
                'price'        => 5000000,
                'quntity'     => 10,
                'category_id'  => 21,
                'created_at'   => '2025-04-01 19:41:00',
            ],
            [
                'name'         => 'مادربرد حرفه‌ای',
                'description'  => 'حجم حافظه: 128GB، فرکانس پردازنده: 4.0GHz، نسل: 11، پورت‌ها: USB 3.0 و DisplayPort.',
                'brand'        => 'اسوس',
                'price'        => 4500000,
                'quntity'     => 8,
                'category_id'  => 21,
                'created_at'   => '2025-04-01 19:41:00',
            ],
            [
                'name'         => 'مادربرد اقتصادی',
                'description'  => 'حجم حافظه: 32GB، فرکانس پردازنده: 2.8GHz، نسل: 10، پورت‌ها: VGA و USB 2.0.',
                'brand'        => 'مایکروتک',
                'price'        => 3000000,
                'quntity'     => 15,
                'category_id'  => 21,
                'created_at'   => '2025-04-01 19:41:00',
            ],
            [
                'name'         => 'مادربرد پیشرفته',
                'description'  => 'حجم حافظه: 256GB، فرکانس پردازنده: 4.2GHz، نسل: 13، پورت‌ها: Thunderbolt 4 و HDMI.',
                'brand'        => 'اینوکس',
                'price'        => 5500000,
                'quntity'     => 7,
                'category_id'  => 21,
                'created_at'   => '2025-04-01 19:41:00',
            ],
            [
                'name'         => 'مادربرد اورکلاک',
                'description'  => 'حجم حافظه: 128GB، فرکانس پردازنده: 5.0GHz، نسل: 12، پورت‌ها: USB-C و HDMI.',
                'brand'        => 'جی‌پی‌ایکس',
                'price'        => 6000000,
                'quntity'     => 6,
                'category_id'  => 21,
                'created_at'   => '2025-04-01 19:41:00',
            ],
            [
                'name'         => 'مادربرد مدرن',
                'description'  => 'حجم حافظه: 64GB، فرکانس پردازنده: 3.2GHz، نسل: 11، پورت‌ها: USB-C و DisplayPort.',
                'brand'        => 'فاستل',
                'price'        => 5200000,
                'quntity'     => 9,
                'category_id'  => 21,
                'created_at'   => '2025-04-01 19:41:00',
            ],
            [
                'name'         => 'مادربرد گیمینگ',
                'description'  => 'حجم حافظه: 256GB، فرکانس پردازنده: 4.5GHz، نسل: 13، پورت‌ها: USB-C و Thunderbolt 4.',
                'brand'        => 'ایم‌ویو',
                'price'        => 5800000,
                'quntity'     => 12,
                'category_id'  => 21,
                'created_at'   => '2025-04-01 19:41:00',
            ],
            [
                'name'         => 'مادربرد چند سیستمی',
                'description'  => 'حجم حافظه: 128GB، فرکانس پردازنده: 3.8GHz، نسل: 12، پورت‌ها: USB-C و VGA.',
                'brand'        => 'آرتموس',
                'price'        => 4900000,
                'quntity'     => 11,
                'category_id'  => 21,
                'created_at'   => '2025-04-01 19:41:00',
            ],
            [
                'name'         => 'مادربرد سبک و فشرده',
                'description'  => 'حجم حافظه: 32GB، فرکانس پردازنده: 2.5GHz، نسل: 10، پورت‌ها: USB 2.0 و HDMI.',
                'brand'        => 'بایوتک',
                'price'        => 4000000,
                'quntity'     => 20,
                'category_id'  => 21,
                'created_at'   => '2025-04-01 19:41:00',
            ],
            [
                'name'         => 'مادربرد ارزان قیمت',
                'description'  => 'حجم حافظه: 16GB، فرکانس پردازنده: 2.2GHz، نسل: 9، پورت‌ها: VGA و USB 2.0.',
                'brand'        => 'نوین',
                'price'        => 2500000,
                'quntity'     => 25,
                'category_id'  => 21,
                'created_at'   => '2025-04-01 19:41:00',
            ],
        ]);
    }
}
