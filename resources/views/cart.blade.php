@extends('layouts.app')

@section('title', 'Корзина')

@section('content')
<div class="container">
    <h1>Ваша корзина</h1>

    @if(session('success'))
        <div class="order-success-message">
            <div class="success-icon">🎉</div>
            <div class="success-text">{{ session('success') }}</div>
        </div>
    @endif

    @if(empty($cartItems))
        <div class="empty-cart-message">
            <div class="sad-emoji">😞</div>
            <div class="empty-cart-text">Ваша корзина пуста</div>
            <a href="{{ route('catalog') }}" class="catalog-link">Загляните в Каталог!</a>
        </div>
    @else
        @php
            $total = 0;
            foreach ($cartItems as $key => $item) {
                $total += $item['price'] * $item['quantity'];
            }
        @endphp

        <div class="cart-items">
            @foreach($cartItems as $key => $item)
            <div class="cart-item">
                <img src="{{ asset($item['image'] ?? 'images/no-image.png') }}" alt="{{ $item['title'] }}" width="100">
                <div class="item-details">
                    <h3>{{ $item['title'] }}</h3>
                    <p>Цена: {{ number_format($item['price'], 2) }} ₽</p>
                    <p>Количество: {{ $item['quantity'] }}</p>
                    <p>Сумма: {{ number_format($item['price'] * $item['quantity'], 2) }} ₽</p>
                </div>
                <form action="{{ route('cart.remove', ['type' => $item['type'], 'id' => $item['id']]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">-</button>
                </form>
            </div>
            @endforeach

            <div class="cart-total">
                <h3>Итого: {{ number_format($total, 2) }} ₽</h3>
            </div>
            
            <div class="checkout-form">
                <h2>Оформление заказа</h2>
                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>ФИО</label>
                        <input type="text" name="full_name" required>
                    </div>
                    <div class="form-group">
                        <label>Телефон</label>
                        <input type="text" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>Адрес доставки</label>
                        <textarea name="address" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Оформить заказ</button>
                </form>
            </div>
        </div>
    @endif
</div>

<style>
    /* Стили для сообщения о пустой корзине */
    .empty-cart-message {
        background: white;
        border-radius: 10px;
        padding: 30px;
        text-align: center;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        max-width: 500px;
        margin: 20px auto;
    }

    .sad-emoji {
        font-size: 50px;
        margin-bottom: 15px;
    }

    .empty-cart-text {
        font-size: 18px;
        margin-bottom: 15px;
        color: #555;
    }

    .catalog-link {
        display: inline-block;
        background: #3498db;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        transition: background 0.3s;
    }

    .catalog-link:hover {
        background: #2980b9;
    }

    /* Стили для сообщения об успешном заказе */
    .order-success-message {
        background: white;
        border-radius: 10px;
        padding: 20px;
        margin: 20px auto;
        max-width: 500px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .success-icon {
        font-size: 30px;
    }

    .success-text {
        font-size: 16px;
        color: #333;
    }
</style>
@endsection