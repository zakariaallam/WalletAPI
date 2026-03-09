FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libpq-dev \
    procps \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mysqli zip opcache

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer    

WORKDIR /var/www/html

EXPOSE 9000

CMD [ "php-fpm" ]