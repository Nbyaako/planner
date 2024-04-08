FROM php:8.2-fpm-alpine

RUN apk add --no-cache bash bash-completion

COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

RUN apk add postgresql16-dev \
    && docker-php-ext-configure pgsql --with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo_pgsql

WORKDIR /var/www/application

CMD ["php-fpm"]