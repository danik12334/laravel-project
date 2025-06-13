@extends('layouts.app')

@section('title', $title)

@section('content')
<style>
    .add-to-cart-btn {
        background:rgb(104, 102, 0);
        color: white;
        border: none;
        padding: 6px 10px;
        cursor: pointer;
        border-radius: 4px;
        transition: background 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .add-to-cart-btn .btn-text {
        display: inline-block;
        transition: opacity 0.3s ease;
    }

    .add-to-cart-btn.loading .btn-text {
        opacity: 0;
    }

    .add-to-cart-btn .checkmark {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        font-size: 18px;
        color: white;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .add-to-cart-btn.success .checkmark {
        opacity: 1;
    }
</style>

<div class="book-container">
    <h1 class="category-title">{{ $title }}</h1>

    <!-- Кнопка добавить запись (только для админа) -->
    @auth
        @if(auth()->user()->is_admin)
            <a href="/books/create?type={{ $bookType }}" class="add-record-btn">Добавить запись</a>
        @endif
    @endauth

    <!-- Форма поиска по ID -->
    <div class="search-container">
        <form method="GET" action="{{ url()->current() }}">
            <input type="number" name="search_id" placeholder="Введите ID книги"
                   value="{{ request('search_id') }}" min="1">
            <input type="hidden" name="book_type" value="{{ $bookType ?? '' }}">
            <button type="submit">Найти</button>
            @if(request()->has('search_id'))
                <a href="{{ url()->current() }}" class="reset-search">Сбросить</a>
            @endif
        </form>
    </div>

    <div class="table-responsive">
        <table class="book-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Фото</th>
                    <th>Название</th>
                    <th>Автор</th>
                    <th>Описание</th>
                    <th>Издатель</th>
                    <th>Серия</th>
                    <th>Год</th>
                    <th>ISBN</th>
                    <th>Цена</th>
                    @auth
                        @if(auth()->user()->is_admin)
                            <th>Количество</th>
                            <th>Добавил</th>
                        @endif
                    @endauth
                    <th>Действие</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if(request()->has('search_id'))
                    @php
                        $book = null;
                        $searchId = request('search_id');
                        $bookType = request('book_type');

                        switch ($bookType) {
                            case 'new': $book = \App\Models\NewBook::find($searchId); break;
                            case 'best': $book = \App\Models\BestBook::class::find($searchId); break;
                            case 'award': $book = \App\Models\AwardBook::find($searchId); break;
                            case 'exclusive': $book = \App\Models\ExclusiveBook::find($searchId); break;
                            case 'coming': $book = \App\Models\ComingSoonBook::find($searchId); break;
                            default: $book = \App\Models\NewBook::find($searchId) ??
                                        \App\Models\BestBook::find($searchId) ??
                                        \App\Models\AwardBook::find($searchId) ??
                                        \App\Models\ExclusiveBook::find($searchId) ??
                                        \App\Models\ComingSoonBook::find($searchId);
                        }
                    @endphp

                    @if($book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td><img src="{{ asset($book->image) }}" class="book-image"></td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ Str::limit($book->description, 50) }}</td>
                            <td>{{ $book->publisher }}</td>
                            <td>{{ $book->series }}</td>
                            <td>{{ $book->year }}</td>
                            <td>{{ $book->isbn }}</td>
                            <td>{{ number_format($book->price, 2) }} ₽</td>
                            
                            @auth
                                @if(auth()->user()->is_admin)
                                    <td>{{ $book->quantity }}</td>
                                    <td>{{ $book->added_by }}</td>
                                @endif
                            @endauth
                            
                            <td>
                                <!-- Кнопка "Смотреть" всегда доступна -->
                                <a href="/books/{{ $book->id }}/show?type={{ $bookType }}" class="action-btn view-btn">Смотреть</a>

                                <!-- Редактировать / Удалить — только для админа -->
                                @auth
                                    @if(auth()->user()->is_admin)
                                        <a href="/books/{{ $book->id }}/edit?type={{ $bookType }}" class="action-btn edit-btn">Редактировать</a>
                                        <form action="/books/{{ $book->id }}" method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="type" value="{{ $bookType }}">
                                            <button type="submit" class="action-btn delete-btn">Удалить</button>
                                        </form>
                                    @endif
                                @endauth
                            </td>
                            <td>
                                <form action="{{ route('cart.add', ['type' => $bookType, 'id' => $book->id]) }}" method="POST" class="add-to-cart-form">
                                    @csrf
                                    <button type="submit" class="add-to-cart-btn btn btn-sm btn-success">
                                        <span class="btn-text">В корзину</span>
                                        <span class="checkmark">✔</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="14" class="text-center">Книга с ID {{ request('search_id') }} не найдена</td>
                        </tr>
                    @endif
                @else
                    @foreach ($books as $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td><img src="{{ asset($book->image) }}" class="book-image"></td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ Str::limit($book->description, 50) }}</td>
                            <td>{{ $book->publisher }}</td>
                            <td>{{ $book->series }}</td>
                            <td>{{ $book->year }}</td>
                            <td>{{ $book->isbn }}</td>
                            <td>{{ number_format($book->price, 2) }} ₽</td>
                            
                            @auth
                                @if(auth()->user()->is_admin)
                                    <td>{{ $book->quantity }}</td>
                                    <td>{{ $book->added_by }}</td>
                                @endif
                            @endauth

                            <td>
                                <!-- Смотреть — всем -->
                                <a href="/books/{{ $book->id }}/show?type={{ $bookType }}" class="action-btn view-btn">Смотреть</a>

                                <!-- Редактировать / Удалить — только админу -->
                                @auth
                                    @if(auth()->user()->is_admin)
                                        <a href="/books/{{ $book->id }}/edit?type={{ $bookType }}" class="action-btn edit-btn">Редактировать</a>
                                        <form action="/books/{{ $book->id }}" method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="type" value="{{ $bookType }}">
                                            <button type="submit" class="action-btn delete-btn">Удалить</button>
                                        </form>
                                    @endif
                                @endauth
                            </td>
                            <td>
                                <form action="{{ route('cart.add', ['type' => $bookType, 'id' => $book->id]) }}" method="POST" class="add-to-cart-form">
                                    @csrf
                                    <button type="submit" class="add-to-cart-btn btn btn-sm btn-success">
                                        <span class="btn-text">В корзину</span>
                                        <span class="checkmark">✔</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    @unless(request()->has('search_id'))
        <div class="pagination-container">
            {{ $books->onEachSide(1)->links('pagination.custom') }}
            <p class="pagination-info">
                Показано {{ $books->firstItem() }}–{{ $books->lastItem() }} из {{ $books->total() }} книг
            </p>
        </div>
    @endunless
</div>

<script>
    document.querySelectorAll('.add-to-cart-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault(); // Отменяем стандартную отправку формы

            const button = this.querySelector('.add-to-cart-btn');
            const textSpan = this.querySelector('.btn-text');
            const checkmark = this.querySelector('.checkmark');

            if (!button.classList.contains('success')) {
                // Анимация галочки
                button.classList.add('loading');
                textSpan.style.opacity = '0';
                checkmark.style.opacity = '1';

                // Отправляем форму через 1 секунду
                setTimeout(() => {
                    this.submit();
                }, 1000);
            }
        });
    });
</script>

@endsection