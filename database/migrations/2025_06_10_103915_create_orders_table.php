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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->text('cart_items'); // Сохраняем содержимое корзины в формате JSON
            $table->string('customer_name'); // Имя клиента
            $table->string('phone');
            $table->string('email');
            $table->text('address');
            $table->decimal('total', 10, 2); // Общая сумма заказа
            $table->string('status')->default('pending'); // pending, paid, completed и т.д.
            $table->timestamps(); // Можно удалить, если не нужен created_at / updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
