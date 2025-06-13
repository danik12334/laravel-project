<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        // Администратор
        DB::table('users')->insert([
            'name' => 'Аdmin',
            'email' => 'admin@mail.ru',
            'phone' => '+79001234567', // <-- добавлено
            'password' => Hash::make('password'),
            'is_admin' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Обычный пользователь
        DB::table('users')->insert([
            'name' => 'Test',
            'email' => 'user@mail.ru',
            'phone' => '+79007654321', // <-- добавлено
            'password' => Hash::make('password'),
            'is_admin' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
