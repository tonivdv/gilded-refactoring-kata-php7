FROM php:7.4.2-cli-alpine3.11

ARG DOCKER_HOST_ADDR

ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS="1" \
    PHP_OPCACHE_MAX_ACCELERATED_FILES="10007" \
    PHP_OPCACHE_MEMORY_CONSUMPTION="192" \
    COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/tmp \
    PHP_XDEBUG_REMOTE_HOST=${DOCKER_HOST_ADDR:-localhost}


RUN apk add --no-cache $PHPIZE_DEPS  \
        && pecl install xdebug-beta \
        && docker-php-ext-enable xdebug \
        && docker-php-ext-install opcache \
        && rm -rf /tmp/* /var/cache/apk/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

COPY etc/build/php/conf.d/opcache.ini $PHP_INI_DIR/conf.d/opcache.ini