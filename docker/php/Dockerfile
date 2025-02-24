FROM composer:2 AS composer
FROM php:8.4-fpm

USER root
COPY --from=composer /usr/bin/composer /usr/bin/composer

ENV COMPOSER_MEMORY_LIMIT=-1

RUN apt-get update \
    && apt-get install -y \
        autoconf \
        git \
        zip \
        unzip \
        libpq-dev \
        libpng-dev \
        libzip-dev \
        zlib1g-dev \
        libssl-dev \
        net-tools \
    && useradd -m onfly

RUN rm /etc/ssl/openssl.cnf

RUN docker-php-ext-install \
    gd \
    pdo \
    pdo_mysql \
    zip

RUN pecl install \
    pcov

RUN docker-php-ext-enable \
    pcov

WORKDIR /teste-onfly

RUN chown -R onfly:onfly /teste-onfly
USER onfly