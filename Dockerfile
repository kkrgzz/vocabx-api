FROM php:8.2-fpm

ARG user
ARG uid

RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    unzip \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libwebp-dev \
    libxpm-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    git \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip opcache

# Install Composer by copying from the official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create a non-root user matching your host's user for file permissions
RUN useradd -G www-data,root -u $uid -d /home/$user $user \
    && mkdir -p /home/$user/.composer \
    && chown -R $user:$user /home/$user

WORKDIR /var/www

# Copy application files
COPY . .

# Install PHP dependencies via Composer
RUN composer install

# Adjust permissions for storage and cache directories
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Switch to the non-root user
USER $user

EXPOSE 9000
CMD ["php-fpm"]