FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    procps \
    pkg-config \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libicu-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zlib1g-dev \
    unzip

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install \
    mysqli \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip \
    intl

# Install Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug
COPY ./docker/php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Create devcontainer user
RUN groupadd --gid 1000 vscode \
    && useradd --uid 1000 --gid 1000 -m -s /bin/bash vscode

# Set working directory
WORKDIR /var/www/html

# Optimize PHP for production
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Configure PHP
RUN echo 'memory_limit = 256M' >> $PHP_INI_DIR/conf.d/docker-php-memory-limit.ini