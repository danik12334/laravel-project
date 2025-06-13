<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

// Главная страница
Route::get('/', [PageController::class, 'home'])->name('home');

// Статические страницы
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contacts', [PageController::class, 'contacts'])->name('contacts');

// Каталог
Route::prefix('catalog')->group(function () {
    Route::get('/', [PageController::class, 'catalog'])->name('catalog');
    Route::get('/{category}', [PageController::class, 'showCategory'])->name('catalog.category');
    Route::get('/catalog/{category}', [PageController::class, 'showAll'])->name('catalog.category.all');
});

// Работа с книгами
Route::prefix('books')->group(function () {
    Route::get('/create', [PageController::class, 'create'])->name('books.create');
    Route::post('/store', [PageController::class, 'store'])->name('books.store');
    Route::get('/{id}/show', [PageController::class, 'show'])->name('books.show');
    Route::get('/{id}/edit', [PageController::class, 'edit'])->name('books.edit');
    Route::put('/{id}', [PageController::class, 'update'])->name('books.update');
    Route::delete('/{id}', [PageController::class, 'destroy'])->name('books.destroy');
});

// Корзина
Route::prefix('cart')->group(function() {
    Route::get('/', [PageController::class, 'cart'])->name('cart');
    Route::post('/add/{type}/{id}', [PageController::class, 'addToCart'])->name('cart.add');
    Route::delete('/remove/{type}/{id}', [PageController::class, 'removeFromCart'])->name('cart.remove'); // ✅ Исправлено здесь
    Route::post('/checkout', [PageController::class, 'checkout'])->name('cart.checkout');
});


// routes/web.php
Route::get('/test-session', function () {
    session(['test_key' => 'test_value']);
    return 'Session set: ' . session('test_key');
});

// Заказы
Route::get('/orders', [PageController::class, 'orders'])->name('orders.index');
Route::delete('/orders/{order}', [PageController::class, 'destroyOrder'])->name('orders.destroy');

// Авторизация — всё в PageController
Route::middleware('web')->group(function () {
    // Формы
    Route::get('/login', [PageController::class, 'showLoginForm'])->name('auth.login');
    Route::get('/register', [PageController::class, 'showRegisterForm'])->name('auth.register');

    // Обработка форм
    Route::post('/login', [PageController::class, 'login']);      // <-- Метод login()
    Route::post('/register', [PageController::class, 'register']); // <-- Метод register()

    // Выход
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');
});