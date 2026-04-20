# 1. Gunakan mesin PHP versi 8.3
FROM php:8.3-cli

# 2. Install alat bantu sistem dan ekstensi MySQL
RUN apt-get update -y && apt-get install -y git unzip \
    && docker-php-ext-install pdo pdo_mysql

# 3. Install Composer (Manajer paket PHP)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 4. Tentukan folder kerja di dalam server
WORKDIR /app

# 5. Pindahkan semua kode dari GitHub ke dalam folder kerja server
COPY . /app

# 6. Install semua dependensi Laravel
RUN composer install --no-dev --optimize-autoloader

# 7. Nyalakan server saat kontainer dijalankan
CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
