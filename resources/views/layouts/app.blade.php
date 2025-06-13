<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookShop - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body>
    <header class="header">
        <div class="container header-container">
            <!-- Логотип -->
            <h1 class="logo"><a href="{{ route('home') }}">BookShop</a></h1>

            <!-- Навигация -->
            <nav class="main-nav">
                <ul>
                    <li class="nav-item">
                        <a href="{{ route('catalog') }}">Каталог</a>
                        <a href="{{ route('catalog') }}"><img src="{{ asset('images/catalog-icon.png') }}" alt="Каталог" class="nav-icon"></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('about') }}">О нас</a>
                        <a href="{{ route('about') }}"><img src="{{ asset('images/about-icon.png') }}" alt="О нас" class="nav-icon"></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('contacts') }}">Контакты</a>
                        <a href="{{ route('contacts') }}"><img src="{{ asset('images/contacts-icon.png') }}" alt="Контакты" class="nav-icon"></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cart') }}">Корзина</a>
                        <a href="{{ route('cart') }}"><img src="{{ asset('images/cart-icon.png') }}" alt="Корзина" class="nav-icon"></a>
                    </li>
                    
                     @auth
                        @if(auth()->user()->is_admin)
                            <li class="nav-item">
                                <a href="{{ route('orders.index') }}">Заказы</a>
                                <a href="{{ route('orders.index') }}"><img src="{{ asset('images/zakaz-icon.png') }}" alt="Заказы" class="nav-icon"></a>
                            </li>
                        @endif
                    @endauth
                </ul>
            </nav>

            <!-- Авторизация / Регистрация -->
            <div class="auth-section">
                @auth
                    <a href="#" class="user-profile">
                        <img src="{{ asset('images/user-icon.png') }}" alt="Профиль" class="user-icon">
                        <span>{{ auth()->user()->name }}</span>
                    </a>
                    <!-- Кнопка выхода -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <button onclick="document.getElementById('logout-form').submit()" class="logout-btn">Выйти</button>
                @else
                    <img src="{{ asset('images/user-icon.png') }}" alt="Профиль" class="user-icon">
                    <a href="{{ route('auth.login') }}" class="auth-link">Войти</a>
                    <a href="{{ route('auth.register') }}" class="auth-link">Регистрация</a>
                @endguest
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} BookShop. Все права защищены.</p>
        </div>

        <div class="socials">
            <p>+7 (495) 123-45-67 (бесплатно по РФ)</p>
            <p>Наши соцсети:</p>
            <div class="social-icons">
                <a href="https://instagram.com"  target="_blank" aria-label="Instagram">
                    <img src="{{ asset('images/instagram-icon.png') }}" alt="Instagram">
                </a>
                <a href="https://t.me/yourchannel"  target="_blank" aria-label="Telegram">
                    <img src="{{ asset('images/telegram-icon.png') }}" alt="Telegram">
                </a>
                <a href="https://m.vk.com"  target="_blank" aria-label="VK">
                    <img src="{{ asset('images/vk-icon.png') }}" alt="VK">
                </a>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>