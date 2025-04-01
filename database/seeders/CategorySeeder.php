<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();

        $categories = [
            ['category_name' => 'مادربرد', 'created_at' => $this->randomDate()],
            ['category_name' => 'پردازنده', 'created_at' => $this->randomDate()],
            ['category_name' => 'کارت گرافیک', 'created_at' => $this->randomDate()],
            ['category_name' => 'رم', 'created_at' => $this->randomDate()],
            ['category_name' => 'منبع تغذیه', 'created_at' => $this->randomDate()],
            ['category_name' => 'هارد دیسک', 'created_at' => $this->randomDate()],
            ['category_name' => 'هارد اس اس دی', 'created_at' => $this->randomDate()],
            ['category_name' => 'خنک‌ کننده', 'created_at' => $this->randomDate()],
            ['category_name' => 'مانیتور', 'created_at' => $this->randomDate()],
            ['category_name' => 'کیبورد', 'created_at' => $this->randomDate()],
            ['category_name' => 'ماوس', 'created_at' => $this->randomDate()],
            ['category_name' => 'درایو نوری', 'created_at' => $this->randomDate()],
            ['category_name' => 'کارت صدا', 'created_at' => $this->randomDate()],
            ['category_name' => 'کارت شبکه', 'created_at' => $this->randomDate()],
            ['category_name' => 'کیس', 'created_at' => $this->randomDate()],
            ['category_name' => 'اسپیکر', 'created_at' => $this->randomDate()],
            ['category_name' => 'هدست', 'created_at' => $this->randomDate()],
            ['category_name' => 'دوربین وب', 'created_at' => $this->randomDate()],
            ['category_name' => 'پرینتر', 'created_at' => $this->randomDate()],
            ['category_name' => 'اسکنر', 'created_at' => $this->randomDate()],
        ];

        DB::table('categories')->insert($categories);
    }

    private function randomDate()
    {
        $timestamp = rand(Carbon::now()->subYear()->timestamp, Carbon::now()->timestamp);
        return Carbon::createFromTimestamp($timestamp);
    }
}
