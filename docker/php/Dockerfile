FROM php:8.2-fpm

# Install minimalrequired PHP extensions
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev libicu-dev libonig-dev \
    && docker-php-ext-install \
        intl \
        zip \
        pdo \
        pdo_mysql \
        mbstring \
        opcache

# Install Composer (global)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html