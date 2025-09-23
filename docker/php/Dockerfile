FROM php:8.3-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies and minimal PHP extensions
RUN apt-get update && apt-get install -y \
    git  \
    unzip  \
    curl  \
    libzip-dev  \
    libicu-dev  \
    libonig-dev \
    && docker-php-ext-install \
        intl \
        zip \
        pdo \
        pdo_mysql \
        mbstring \
        opcache

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configure PHP for development (optional, adjust for production)
RUN echo "display_errors=1" >> /usr/local/etc/php/conf.d/docker-php.ini \
    && echo "error_reporting=E_ALL" >> /usr/local/etc/php/conf.d/docker-php.ini

# Copy only Composer files first (leverage cache)
COPY composer.json composer.lock ./

# Create a dummy vendor directory for caching
RUN mkdir -p vendor

# Copy the rest of the application
COPY . .

# Copy the entrypoint script to automatically install dependencies if needed
COPY docker/php/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Expose port for Symfony built-in server
EXPOSE 8000

# Entry point to auto-install dependencies if vendor is empty
ENTRYPOINT ["entrypoint.sh"]

# Default command to run Symfony built-in server
CMD ["sh", "-c", "echo 'Symfony app running at http://localhost:8000'; php -S 0.0.0.0:8000 -t public"]
# the following command might not work on Linux: php -S localhost:8000 -t public