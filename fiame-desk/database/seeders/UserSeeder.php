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
        $users = [
            [
                'firstname' => 'Christopher',
                'lastname' => 'Pardo',
                'phone' => '0798765432',
                'admin' => 1,
                'token' => Str::random(30),
                'password' => Hash::make('Pa$$w0rd'), // password
            ],
            [
                'firstname' => 'David',
                'lastname' => 'Roulet',
                'phone' => '0723456789',
                'admin' => 0,
                'token' => Str::random(30),
                'password' => Hash::make('Pa$$w0rd'), // password
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
