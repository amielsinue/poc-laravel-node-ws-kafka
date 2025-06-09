FROM php:7.4-cli

# Kafka PHP extension
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libssl-dev librdkafka-dev \
    && docker-php-ext-install zip \
    && pecl install rdkafka \
    && docker-php-ext-enable rdkafka

# Composer
COPY --from=composer:1.10.22 /usr/bin/composer /usr/bin/composer
RUN composer global require "laravel/installer:^1.3" && \
    composer create-project --prefer-dist laravel/laravel:5.4.* /var/www/html

WORKDIR /var/www/html

CMD php artisan serve --host=0.0.0.0 --port=8000