<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class ShipperSeeder extends Seeder
{
    private $faker;
    private static $nextId = 1;

    public function __construct()
    {
        $this->faker = Faker::create('fa_IR');
    }

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('shippers')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $provincesWithCities = [
            'آذربایجان شرقی' => ['آذربایجان شرقی'],
            'آذربایجان غربی' => ['آذربایجان غربی'],
            'اردبیل' => ['اردبیل'],
            'اصفهان' => ['اصفهان'],
            'البرز' => ['البرز'],
            'ایلام' => ['ایلام'],
            'بوشهر' => ['بوشهر'],
            'تهران' => ['تهران'],
            'چهارمحال و بختیاری' => ['چهارمحال و بختیاری'],
            'خراسان جنوبی' => ['خراسان جنوبی'],
            'خراسان رضوی' => ['خراسان رضوی'],
            'خراسان شمالی' => ['خراسان شمالی'],
            'خوزستان' => ['خوزستان'],
            'زنجان' => ['زنجان'],
            'سمنان' => ['سمنان'],
            'سیستان و بلوچستان' => ['سیستان و بلوچستان'],
            'فارس' => ['فارس'],
            'قزوین' => ['قزوین'],
            'قم' => ['قم'],
            'کردستان' => ['کردستان'],
            'کرمان' => ['کرمان'],
            'کرمانشاه' => ['کرمانشاه'],
            'کهگیلویه و بویراحمد' => ['کهگیلویه و بویراحمد'],
            'گلستان' => ['گلستان'],
            'گیلان' => ['گیلان'],
            'لرستان' => ['لرستان'],
            'مازندران' => ['مازندران'],
            'مرکزی' => ['مرکزی'],
            'هرمزگان' => ['هرمزگان'],
            'همدان' => ['همدان'],
            'یزد' => ['یزد'],
        ];

        foreach ($provincesWithCities as $province => $cities) {
            $count = $this->getShipperCount($province);
            for ($i = 1; $i <= $count; $i++) {
                $city = $this->faker->randomElement($cities);
                DB::table('shippers')->insert([
                    'id' => $this->getNextId(),
                    'first_name' => $this->faker->firstName,
                    'last_name' => $this->faker->lastName,
                    'email' => $this->faker->unique()->safeEmail,
                  
                    'city' => $city,
                    'address' => $this->generatePersianAddress($city, $province),
                    'phone' => '09' . $this->faker->numerify('#########'),
                    'sheba_number' => $this->generateShebaNumber(),
                    'password' => Hash::make('1234'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    private function generatePersianAddress($city, $province): string
    {
        $streets = [
            'شهید مطهری',
            'شهید بهشتی',
            'انقلاب',
            'آزادی',
            'ولیعصر',
            'شهید کلاهدوز',
            'شهید دستغیب',
            'شهید فهمیده',
            'شهید چمران',
            'شهید نواب صفوی'
        ];

        $alleys = [
            'شهید فلانی',
            'اقدسیه',
            'نسترن',
            'گلستان',
            'پردیس',
            'بنفشه',
            'نیلوفر',
            'لاله',
            'یاس',
            'نارون'
        ];

        return sprintf(
            "استان %s، شهر %s، خیابان %s، کوچه %s، پلاک %d، واحد %d",
            $province,
            $city,
            $this->faker->randomElement($streets),
            $this->faker->randomElement($alleys),
            rand(1, 100),
            rand(1, 20)
        );
    }

    private function generateShebaNumber(): string
    {
        $sheba = 'IR';
        for ($i = 0; $i < 24; $i++) {
            $sheba .= rand(0, 9);
        }
        return $sheba;
    }

    private function getNextId(): int
    {
        return self::$nextId++;
    }

    private function getShipperCount(string $province): int
    {
        return match ($province) {
            'تهران' => rand(20, 25),
            'اصفهان', 'خراسان رضوی', 'فارس', 'خوزستان' => rand(12, 16),
            'آذربایجان شرقی', 'آذربایجان غربی', 'کرمان', 'گیلان', 'مازندران', 'همدان', 'یزد' => rand(8, 12),
            default => rand(5, 10),
        };
    }
}
