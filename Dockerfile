# Use PHP 8.1 FPM image
FROM php:8.1-fpm as php

# Set environment variables for OPcache
ENV PHP_OPCACHE_ENABLE=1
ENV PHP_OPCACHE_ENABLE_CLI=0
ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS=1
ENV PHP_OPCACHE_REVALIDATE_FREQ=1

# Update and install dependencies
RUN usermod -u 1000 www-data && \
    apt-get update -y && \
    apt-get install -y --no-install-recommends \
        unzip \
        git \
        zip \
        libpq-dev \
        libcurl4-gnutls-dev \
        nginx \
        libzip-dev \
        libonig-dev \
        unixodbc unixodbc-dev && \
    curl https://public.dhe.ibm.com/software/ibmi/products/odbc/debs/dists/1.1.0/ibmi-acs-1.1.0.list | tee /etc/apt/sources.list.d/ibmi-acs-1.1.0.list && \
    apt-get update && \
    apt-get install -y ibm-iaccess && \
    docker-php-ext-install pdo pdo_mysql bcmath curl opcache zip mbstring && \
    docker-php-ext-enable opcache pdo_mysql mbstring && \
    docker-php-ext-configure pdo_odbc --with-pdo-odbc=unixODBC,/usr && \
    docker-php-ext-install pdo_odbc && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Set the working directory
WORKDIR /var/www

# Copy project files and configurations
COPY --chown=www-data:www-data . .
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini
COPY ./docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf

# Copy Composer from the official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Adjust permissions
RUN chmod -R 755 /var/www/storage && \
    chmod -R 755 /var/www/bootstrap

# Set the entrypoint
ENTRYPOINT [ "docker/entrypoint.sh" ]
