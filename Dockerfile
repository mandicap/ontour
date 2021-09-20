FROM php:7.4-fpm-alpine

RUN apk update
RUN apk add oniguruma-dev

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Lumen dependencies
RUN docker-php-ext-install mbstring tokenizer mysqli pdo_mysql
