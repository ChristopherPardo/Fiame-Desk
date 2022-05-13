<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'firstname' => 'Christopher',
            'lastname' => 'Pardo',
            'phone' => '0798765432',
            'admin' => 1,
            'token' => Str::random(30),
            'password' => Hash::make('Pa$$w0rd'), // password
        ]);
    }
}
