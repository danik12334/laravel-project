# Берём базовый образ с PHP и Apache
FROM php:8.2-apache

# Включаем mod_rewrite для .htaccess
RUN a2enmod rewrite headers expires mime

# Устанавливаем зависимости
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    && docker-php-ext-install pdo pdo_mysql exif

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer  | php -- --install-dir=/usr/local/bin --filename=composer

# Копируем исходники
COPY . /var/www/html/

# Устанавливаем зависимости
WORKDIR /var/www/html
RUN composer install --no-dev --optimize-autoloader

# Настраиваем права
RUN chown -R www-data:www-data /var/www/html

# Копируем .env
ENV APP_KEY=base64:sVlFcUwT1H8cYi1b6i9W4Fko6oGTZObnRiwC7lA4/4g=
COPY .env.example .env
RUN php artisan key:generate

# Запускаем сервер
CMD ["apache2-foreground"]