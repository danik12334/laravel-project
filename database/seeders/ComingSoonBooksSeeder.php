<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComingSoonBooksSeeder extends Seeder
{
    public function run()
    {
        $books = [];
        for ($i = 1; $i <= 100; $i++) {
            $books[] = [
                'image' => "/images/asd/soonbook$i.jpg",
                'title' => "Скоро в продаже $i",
                'author' => "Автор СкороКниги $i",
                'description' => "Ожидаемая новинка — скоро поступит в продажу, книга №$i.",
                'publisher' => "Издательство Ожиданий",
                'series' => rand(0, 1) ? "Скоро в продаже" : null,
                'year' => 2025,
                'isbn' => "978-5-" . rand(100, 999) . "-" . rand(1000, 9999) . "-" . ($i % 10),
                'price' => rand(300, 900),
                'quantity' => rand(1, 100),
                'added_by' => 'Иванов И.И.',
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('coming_soon_books')->insert($books);
    }
}
