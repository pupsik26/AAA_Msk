FROM php:8.1-fpm-alpine

RUN apk update && apk upgrade

RUN apk add icu-dev

# Install the PHP pdo_mysql extention
RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www