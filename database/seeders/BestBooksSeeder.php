<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BestBooksSeeder extends Seeder
{
    public function run()
    {
        $books = [];
        for ($i = 1; $i <= 100; $i++) {
            $books[] = [
                'image' => "/images/asd/topbook$i.jpg",
                'title' => "Лучшая книга $i",
                'author' => "Популярный Автор $i",
                'description' => "Эта книга пользуется огромной популярностью у читателей.",
                'publisher' => "Издательство Топ Книг",
                'series' => rand(0, 1) ? "Бестселлеры" : null,
                'year' => rand(2010, 2023),
                'isbn' => "978-5-" . rand(100, 999) . "-" . rand(1000, 9999) . "-" . ($i % 10),
                'price' => rand(500, 1100),
                'quantity' => rand(1, 100),
                'added_by' => 'Иванов И.И.',
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('best_books')->insert($books);
    }
}
