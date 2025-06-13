@extends('layouts.app')

@section('title', 'Добавить книгу')

@section('content')
<style>
    /* Стили для страницы добавления книги */
    .book-create-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        color: #333;
    }

    .book-create-container h1 {
        color: #2c3e50;
        text-align: center;
        margin-bottom: 30px;
        font-size: 28px;
    }

    .book-create-form {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .form-group {
        flex: 1 1 calc(50% - 20px);
        min-width: 300px;
        margin-bottom: 20px;
    }

    .book-create-form label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #2c3e50;
    }

    .book-create-form .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 16px;
        transition: all 0.3s;
        background-color: #f8f9fa;
        box-sizing: border-box;
    }

    .book-create-form .form-control:focus {
        border-color: #3490dc;
        outline: none;
        box-shadow: 0 0 0 3px rgba(52,144,220,0.1);
    }

    .book-create-form textarea.form-control {
        min-height: 150px;
        resize: vertical;
    }

    .full-width {
        flex: 1 1 100%;
    }

    .submit-container {
        flex: 1 1 100%;
        text-align: center;
        margin-top: 20px;
    }

    .book-create-form .btn-primary {
        background-color: #3490dc;
        color: white;
        border: none;
        padding: 14px 30px;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        width: auto;
        min-width: 200px;
        margin-top: 10px;
    }

    .book-create-form .btn-primary:hover {
        background-color: #227dc7;
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .book-create-container {
            padding: 20px;
        }
        
        .form-group {
            flex: 1 1 100%;
            min-width: auto;
        }
    }
</style>

<div class="book-create-container">
    <h1>Добавить книгу</h1>

    <form method="POST" action="{{ route('books.store') }}" class="book-create-form">
        @csrf
        <input type="hidden" name="type" value="{{ $type }}">

        <!-- Первая колонка -->
        <div class="form-group">
            <label for="title">Название</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="author">Автор</label>
            <input type="text" name="author" id="author" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="publisher">Издатель</label>
            <input type="text" name="publisher" id="publisher" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="year">Год издания</label>
            <input type="number" name="year" id="year" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="price">Цена (₽)</label>
            <input type="number" step="0.01" name="price" id="price" class="form-control" required>
        </div>

        <!-- Вторая колонка -->
        <div class="form-group">
            <label for="series">Серия</label>
            <input type="text" name="series" id="series" class="form-control">
        </div>

        <div class="form-group">
            <label for="isbn">ISBN</label>
            <input type="text" name="isbn" id="isbn" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="image">Ссылка на изображение</label>
            <input type="text" name="image" id="image" class="form-control" placeholder="Например: image/books/1.jpg" required>
        </div>

        <!-- Новые поля -->
        <div class="form-group">
            <label for="quantity">Количество</label>
            <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" required>
        </div>

        <div class="form-group">
            <label for="added_by">Добавивший</label>
            <input type="text" name="added_by" id="added_by" class="form-control" required>
        </div>

        <!-- Описание на всю ширину -->
        <div class="form-group full-width">
            <label for="description">Описание</label>
            <textarea name="description" id="description" class="form-control" rows="5" required></textarea>
        </div>

        <!-- Кнопка отправки -->
        <div class="submit-container">
            <button type="submit" class="btn btn-primary">Сохранить книгу</button>
        </div>
    </form>
</div>
@endsection