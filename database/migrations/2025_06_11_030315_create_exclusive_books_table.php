<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exclusive_books', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('title');
            $table->string('author');
            $table->text('description');
            $table->string('publisher');
            $table->string('series')->nullable();
            $table->integer('year');
            $table->string('isbn')->unique();
            $table->decimal('price', 8, 2);

            // Новые поля
            $table->integer('quantity')->default(1);
            $table->string('added_by')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exclusive_books');
    }
};
