<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UpdateUserPasswordsSeeder extends Seeder
{
    public function run()
    {
        User::query()->update(['password' => Hash::make('1234')]);
    }
}
