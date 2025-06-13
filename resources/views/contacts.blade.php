@extends('layouts.app')

@section('content')
<!-- Заголовок -->
<section class="contacts-header">
    <h1>Контакты</h1>
</section>

<!-- Основной контент -->
<section class="contacts-content">
    <div class="contact-methods">
        <div class="contact-item">
            <h3>Адрес главного магазина</h3>
            <p>г. Москва, ул. Пушкинская, д. 5</p>
            <p>Ежедневно с 10:00 до 21:00</p>
        </div>
        
        <div class="contact-item">
            <h3>Телефоны</h3>
            <p>+7 (495) 123-45-67</p>
            <p>+7 (800) 100-20-30 (бесплатно по РФ)</p>
        </div>
        
        <div class="contact-item">
            <h3>Электронная почта</h3>
            <p>info@bookshop.ru - общие вопросы</p>
            <p>orders@bookshop.ru - заказы</p>
        </div>
    </div>
</section>

<!-- Галерея -->
<section class="contacts-gallery">
    <h2>Наш магазин</h2>
    
    <div class="gallery-grid">
        <!-- Фото 1: Главный магазин -->
        <div class="gallery-item">
            <img src="{{('images/contact1.jpg') }}" alt="Магазин BookShop в Москве">
            <p>Магазин </p>
        </div>
        
        <!-- Фото 2: Читальный зал -->
        <div class="gallery-item">
            <img src="{{('images/contact2.jpg') }}" alt="Уютный читальный зал">
            <p>Уютный читальный зал</p>
        </div>
        
        <!-- Фото 3: Детский уголок -->
        <div class="gallery-item">
            <img src="{{('images/contact3.jpg') }}" alt="Детский книжный уголок">
            <p>Специальная зона для детей</p>
        </div>
        
        <!-- Фото 4: Кофейня -->
        <div class="gallery-item">
            <img src="{{('images/contact4.jpg') }}" alt="Книжная кофейня">
            <p>Книжная кофейня при магазине</p>
        </div>
        
        <!-- Фото 5: Авторские встречи -->
        <div class="gallery-item">
            <img src="{{('images/contact5.jpg') }}" alt="Авторские встречи">
            <p>Проводим встречи с писателями</p>
        </div>
        
        <!-- Фото 6: Книжные ярмарки -->
        <div class="gallery-item">
            <img src="{{('images/contact6.jpg') }}" alt="Книжные ярмарки">
            <p>Участвуем в книжных ярмарках</p>
        </div>
    </div>
</section>

<!-- Карта -->
<section class="contacts-map">
    <h2>Мы на карте</h2>
    <div class="map-container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2244.685014550768!2d37.6173!3d55.7558!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b54a636edcd2ad%3A0x4c2ca101e2332f1f!2z0J_RgNCw0YDRgdC60LjQtSDQvdCw0YLRgNC-0LLRi9GI0LrQuNGP0YDQvtGB0YLQstCw0Y8g0J_QtdGF0LXQutC40L4u!5e0!3m2!1sen!2sua!4v1694784000000!5m2!1sen!2sua" 
                width="100%" 
                height="400" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy">
        </iframe>
    </div>
</section>
@endsection