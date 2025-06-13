@extends('layouts.app')

@section('title', 'Заказы')

@section('content')
<div class="container">
    <h1>Заказы</h1>
    
    @if($orders->isEmpty())
        <p>У вас нет заказов</p>
    @else
        <div class="orders-list">
            @foreach($orders as $order)
            <div class="order-card">
                <div class="order-header">
                    <h3>Заказ #{{ $order->id }}</h3>
                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-order-complete">
                            Заказ выполнен
                        </button>
                    </form>
                </div>
                
                <div class="order-info">
                    <p><strong>ФИО:</strong> {{ $order->customer_name }}</p>
                    <p><strong>Телефон:</strong> {{ $order->phone }}</p>
                    <p><strong>Email:</strong> {{ $order->email }}</p>
                    <p><strong>Адрес:</strong> {{ $order->address }}</p>
                    <p><strong>Дата:</strong> {{ $order->created_at->format('d.m.Y H:i') }}</p>
                    <p><strong>Статус:</strong> 
                        <span class="badge badge-{{ $order->status == 'pending' ? 'warning' : 'success' }}">
                            {{ $order->status == 'pending' ? 'В обработке' : 'Завершен' }}
                        </span>
                    </p>
                    <p><strong>Сумма:</strong> {{ number_format($order->total, 2) }} ₽</p>
                </div>
                
                <div class="order-items">
                    <h5>Товары:</h5>
                    <ul>
                        @foreach(json_decode($order->cart_items, true) as $item)
                        <li class="order-item">
                            <img src="{{ asset($item['image'] ?? 'images/no-image.png') }}" width="50">
                            <span>{{ $item['title'] }} ({{ $item['quantity'] }} × {{ number_format($item['price'], 2) }} ₽)</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection