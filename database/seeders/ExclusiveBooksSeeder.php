<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExclusiveBooksSeeder extends Seeder
{
    public function run()
    {
        $books = [];
        for ($i = 1; $i <= 100; $i++) {
            $books[] = [
                'image' => "/images/asd/exclusivebook$i.jpg",
                'title' => "Эксклюзив BookShop $i",
                'author' => "Эксклюзивный Автор $i",
                'description' => "Только в нашем магазине — эксклюзивная книга №$i.",
                'publisher' => "BookShop Пресс",
                'series' => rand(0, 1) ? "Эксклюзивы" : null,
                'year' => rand(2020, 2024),
                'isbn' => "978-5-" . rand(100, 999) . "-" . rand(1000, 9999) . "-" . ($i % 10),
                'price' => rand(700, 1300),
                'quantity' => rand(1, 100),
                'added_by' => 'Иванов И.И.',
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('exclusive_books')->insert($books);
    }
}
