FROM php:8.3-fpm

WORKDIR /var/www

RUN set -eux; \
    apt-get update; \
    apt-get upgrade -y; \
    apt-get install -y --no-install-recommends \
            curl \
            libpq-dev; \
    rm -rf /var/lib/apt/lists/*

s
RUN set -eux; \
    docker-php-ext-install pgsql; \
    docker-php-ext-install pdo_pgsql


RUN set -eux; \
    pecl install xdebug; \
    pecl install redis

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY /_docker/app/conf.d /usr/local/etc/php/conf.d/

# Install nodejs
RUN curl -fsSL https://deb.nodesource.com/setup_current.x | bash - \
  && apt-get install -y nodejs

RUN apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
