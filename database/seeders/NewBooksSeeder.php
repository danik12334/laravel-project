<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewBooksSeeder extends Seeder
{
    public function run()
    {
        $books = [];
        for ($i = 1; $i <= 100; $i++) {
            $books[] = [
                'image' => "/images/asd/newbook$i.jpg",
                'title' => "Новинка литературы $i",
                'author' => "Автор Новинки $i",
                'description' => "Описание новой книги №$i — свежее поступление в мир литературы.",
                'publisher' => "Издательство Литера",
                'series' => rand(0, 1) ? "Серия Новинок" : null,
                'year' => rand(2020, 2024),
                'isbn' => "978-5-" . rand(100, 999) . "-" . rand(1000, 9999) . "-" . ($i % 10),
                'price' => rand(400, 1200),
                'quantity' => rand(1, 100),
                'added_by' => 'Иванов И.И.',
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('new_books')->insert($books);
    }
}
