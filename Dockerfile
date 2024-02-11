FROM php:8.1-cli-alpine

RUN apk --no-cache add \
    zip \
    unzip \
    curl \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN docker-php-ext-install pdo_mysql gd zip

ENV APP_HOME /app
ENV COMPOSER_ALLOW_SUPERUSER 1

WORKDIR $APP_HOME
COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN mkdir -p storage/framework/sessions \
    && mkdir -p storage/framework/views \
    && mkdir -p storage/framework/cache \
    && mkdir -p storage/logs \
    && chmod -R 775 storage

# Expose port 8080
EXPOSE 8080

# Atur perintah default untuk menjalankan server PHP built-in
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
