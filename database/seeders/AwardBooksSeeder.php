<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AwardBooksSeeder extends Seeder
{
    public function run()
    {
        $books = [];
        for ($i = 1; $i <= 100; $i++) {
            $books[] = [
                'image' => "/images/asd/awardbook$i.jpg",
                'title' => "Финалист премии $i",
                'author' => "Писатель Премиальный $i",
                'description' => "Участник литературной премии «Большая книга» — номинация №$i.",
                'publisher' => "Премиальное Издательство",
                'series' => rand(0, 1) ? "Премия Большая книга" : null,
                'year' => rand(2015, 2023),
                'isbn' => "978-5-" . rand(100, 999) . "-" . rand(1000, 9999) . "-" . ($i % 10),
                'price' => rand(600, 1000),
                'quantity' => rand(1, 100),
                'added_by' => 'Иванов И.И.',
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('award_books')->insert($books);
    }
}
