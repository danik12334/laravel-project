@extends('layouts.app')

@section('title', 'Просмотр книги')

@section('content')
<style>
    /* Стили только для этой страницы */
    .book-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        color: #333;
        background-color: #fff;
    }

    .book-container h1 {
        color: #2c3e50;
        margin-bottom: 30px;
        text-align: center;
    }

    .book-details {
        display: flex;
        gap: 30px;
        margin-bottom: 30px;
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .book-image {
        max-width: 300px;
        height: auto;
        border-radius: 4px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .book-info {
        flex: 1;
    }

    .book-info h2 {
        color: #2c3e50;
        margin-top: 0;
        margin-bottom: 15px;
    }

    .book-info p {
        margin-bottom: 10px;
        line-height: 1.6;
        color: #495057;
    }

    .book-info strong {
        color: #2c3e50;
        font-weight: 600;
    }

    .actions {
        text-align: center;
        margin-top: 30px;
    }

    .btn-back {
        display: inline-block;
        background-color: #6c757d;
        color: white;
        padding: 10px 20px;
        border-radius: 4px;
        text-decoration: none;
        transition: background-color 0.3s;
        font-weight: 500;
    }

    .btn-back:hover {
        background-color: #5a6268;
        color: white;
    }

    @media (max-width: 768px) {
        .book-details {
            flex-direction: column;
        }
        
        .book-image {
            max-width: 100%;
            margin-bottom: 20px;
        }
    }
</style>

<div class="book-container">
    <h1>Просмотр книги</h1>

    <div class="book-details">
        <img src="{{ asset($book->image) }}" alt="{{ $book->title }}" class="book-image">
        <div class="book-info">
            <h2>{{ $book->title }}</h2>
            <p><strong>Автор:</strong> {{ $book->author }}</p>
            <p><strong>Описание:</strong> {{ $book->description }}</p>
            <p><strong>Издатель:</strong> {{ $book->publisher }}</p>
            <p><strong>Серия:</strong> {{ $book->series }}</p>
            <p><strong>Год:</strong> {{ $book->year }}</p>
            <p><strong>ISBN:</strong> {{ $book->isbn }}</p>
            <p><strong>Цена:</strong> {{ number_format($book->price, 2) }} ₽</p>
        </div>
    </div>

    <div class="actions">
        <a href="/catalog/catalog/{{ $type }}" class="btn-back">Вернуться к списку</a>
    </div>
</div>
@endsection