# Gunakan PHP sebagai base image
FROM php:8.2-apache

# Set working directory di dalam container
WORKDIR /var/www/html

# Install dependensi yang diperlukan untuk Laravel
RUN apt-get update && \
    apt-get install -y libzip-dev zip unzip && \
    docker-php-ext-configure zip --with-libzip && \
    docker-php-ext-install zip pdo_mysql

# Download dan install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy composer.json dan composer.lock ke dalam container
COPY composer.json composer.lock ./

# Install dependensi PHP menggunakan Composer
RUN composer install --no-scripts --no-autoloader

# Copy seluruh proyek Laravel ke dalam container
COPY . .

# Generate autoloader dan jalankan script Laravel lainnya
RUN composer dump-autoload && \
    php artisan optimize

# Set environment untuk Laravel
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
ENV APP_KEY=base64:E4pgWm0uMcpFuDpJpWqPL+Z4Uhw2IhBAqkuIXmk/XDE=

# Konfigurasi Apache
RUN sed -i -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf

# Expose port 8080
EXPOSE 8080

# CMD untuk menjalankan server Apache
CMD ["apache2-foreground"]
