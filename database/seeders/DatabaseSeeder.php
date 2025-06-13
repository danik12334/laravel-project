<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Вызываем сидеры для таблиц
        $this->call([
            NewBooksSeeder::class,
            BestBooksSeeder::class,
            AwardBooksSeeder::class,
            ExclusiveBooksSeeder::class,
            ComingSoonBooksSeeder::class,
        ]);
    }
}
