@extends('layouts.app')

@section('title', 'Каталог книг')

@section('content')
<style>
    .add-to-cart-btn {
        position: relative;
        overflow: hidden;
        transition: background-color 0.3s ease;
        padding: 8px 16px;
        font-size: 14px;
        cursor: pointer;
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

    .add-to-cart-btn:hover {
        background-color: #45a049;
    }
</style>

<div class="catalog-page">
    <!-- Новинки литературы -->
    <section class="category-section">
        <div class="category-header">
            <h2 class="category-title">Новинки литературы</h2>
            <a href="{{ route('catalog.category', ['category' => 'new']) }}" class="view-all">Смотреть все</a>
        </div>
        <div class="books-carousel">
            <div class="books-container" data-current="0">
                @foreach($newBooks as $book)
                <div class="book-card">
                    <img src="{{ asset($book->image) }}" alt="{{ $book->title }}">
                    <h3>{{ $book->title }}</h3>
                    <p class="author">{{ $book->author }}</p>
                    <p class="price">{{ $book->price }} ₽</p>
                    <form action="{{ route('cart.add', ['type' => 'new', 'id' => $book->id]) }}" method="POST" class="add-to-cart-form">
                        @csrf
                        <button type="submit" class="add-to-cart-btn btn btn-sm btn-success">
                            <span class="btn-text">В корзину</span>
                            <span class="checkmark">✔</span>
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Лучшие из лучших -->
    <section class="category-section">
        <div class="category-header">
            <h2 class="category-title">Лучшие из лучших</h2>
            <a href="{{ route('catalog.category', ['category' => 'best']) }}" class="view-all">Смотреть все</a>
        </div>
        <div class="books-carousel">
            <div class="books-container" data-current="0">
                @foreach($bestBooks as $book)
                <div class="book-card">
                    <img src="{{ asset($book->image) }}" alt="{{ $book->title }}">
                    <h3>{{ $book->title }}</h3>
                    <p class="author">{{ $book->author }}</p>
                    <p class="price">{{ $book->price }} ₽</p>
                    <form action="{{ route('cart.add', ['type' => 'best', 'id' => $book->id]) }}" method="POST" class="add-to-cart-form">
                        @csrf
                        <button type="submit" class="add-to-cart-btn btn btn-sm btn-success">
                            <span class="btn-text">В корзину</span>
                            <span class="checkmark">✔</span>
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Финалисты премии -->
    <section class="category-section">
        <div class="category-header">
            <h2 class="category-title">Финалисты премии «Большая книга»</h2>
            <a href="{{ route('catalog.category', ['category' => 'award']) }}" class="view-all">Смотреть все</a>
        </div>
        <div class="books-carousel">
            <div class="books-container" data-current="0">
                @foreach($awardBooks as $book)
                <div class="book-card">
                    <img src="{{ asset($book->image) }}" alt="{{ $book->title }}">
                    <h3>{{ $book->title }}</h3>
                    <p class="author">{{ $book->author }}</p>
                    <p class="price">{{ $book->price }} ₽</p>
                    <form action="{{ route('cart.add', ['type' => 'award', 'id' => $book->id]) }}" method="POST" class="add-to-cart-form">
                        @csrf
                        <button type="submit" class="add-to-cart-btn btn btn-sm btn-success">
                            <span class="btn-text">В корзину</span>
                            <span class="checkmark">✔</span>
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Эксклюзивы -->
    <section class="category-section">
        <div class="category-header">
            <h2 class="category-title">Эксклюзивно в «BookShop»</h2>
            <a href="{{ route('catalog.category', ['category' => 'exclusive']) }}" class="view-all">Смотреть все</a>
        </div>
        <div class="books-carousel">
            <div class="books-container" data-current="0">
                @foreach($exclusiveBooks as $book)
                <div class="book-card">
                    <img src="{{ asset($book->image) }}" alt="{{ $book->title }}">
                    <h3>{{ $book->title }}</h3>
                    <p class="author">{{ $book->author }}</p>
                    <p class="price">{{ $book->price }} ₽</p>
                    <form action="{{ route('cart.add', ['type' => 'exclusive', 'id' => $book->id]) }}" method="POST" class="add-to-cart-form">
                        @csrf
                        <button type="submit" class="add-to-cart-btn btn btn-sm btn-success">
                            <span class="btn-text">В корзину</span>
                            <span class="checkmark">✔</span>
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Скоро в продаже -->
    <section class="category-section">
        <div class="category-header">
            <h2 class="category-title">Скоро в продаже</h2>
            <a href="{{ route('catalog.category', ['category' => 'coming']) }}" class="view-all">Смотреть все</a>
        </div>
        <div class="books-carousel">
            <div class="books-container" data-current="0">
                @foreach($comingSoonBooks as $book)
                <div class="book-card">
                    <img src="{{ asset($book->image) }}" alt="{{ $book->title }}">
                    <h3>{{ $book->title }}</h3>
                    <p class="author">{{ $book->author }}</p>
                    <p class="price">{{ $book->price }} ₽</p>
                    <form action="{{ route('cart.add', ['type' => 'coming', 'id' => $book->id]) }}" method="POST" class="add-to-cart-form">
                        @csrf
                        <button type="submit" class="add-to-cart-btn btn btn-sm btn-success">
                            <span class="btn-text">В корзину</span>
                            <span class="checkmark">✔</span>
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>

<script>
    document.querySelectorAll('.add-to-cart-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const button = this.querySelector('.add-to-cart-btn');
            const textSpan = this.querySelector('.btn-text');
            const checkmark = this.querySelector('.checkmark');

            if (!button.classList.contains('success')) {
                // Показываем галочку
                button.classList.add('loading');
                textSpan.style.opacity = 0;
                checkmark.style.opacity = 1;

                // Через 1 секунду восстанавливаем кнопку
                setTimeout(() => {
                    button.classList.remove('loading');
                    button.classList.add('success');
                    textSpan.style.opacity = 1;
                    checkmark.style.opacity = 0;

                    // Возвращаем обратно
                    setTimeout(() => {
                        button.classList.remove('success');
                        textSpan.style.opacity = 1;
                    }, 1000);

                    // Отправляем форму
                    this.submit();
                }, 300);
            }
        });
    });
</script>
@endsection