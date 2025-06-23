FROM php:8.4-fpm

WORKDIR /var/www

# Timezone
ENV TZ=Europe/Moscow
RUN apt-get update && apt-get install -yy tzdata
RUN cp /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Установка docker-php-extension-installer
ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Install "nano", "procps", "cron", "curl", "libpq-dev", "libjpeg-dev",
# "libpng-dev", "libfreetype6-dev", "libssl-dev", "libmcrypt-dev",
RUN set -eux; \
    apt-get update; \
    apt-get upgrade -y; \
    apt-get install -y --no-install-recommends \
            nano \
            procps \
            cron \
            supervisor \
            curl \
            libpq-dev \
            libz-dev \
            libpq-dev \
            libjpeg-dev \
            libpng-dev \
            libfreetype6-dev \
            libssl-dev \
            libwebp-dev \
            libxpm-dev \
            libmcrypt-dev \
            libonig-dev; \
    rm -rf /var/lib/apt/lists/*

RUN set -eux; \
    docker-php-ext-install pgsql; \
    docker-php-ext-install pdo_pgsql; \
    # Install the PHP gd library
    docker-php-ext-configure gd \
            --prefix=/usr \
            --with-jpeg \
            --with-webp \
            --with-xpm \
            --with-freetype; \
    docker-php-ext-install gd; \
    install-php-extensions redis; \
    install-php-extensions @composer; \
    install-php-extensions xdebug; \
    php -r 'var_dump(gd_info());'

# Install nodejs
RUN curl -fsSL https://deb.nodesource.com/setup_current.x | bash - \
  && apt-get install -y nodejs

# Add crontab file in the cron directory
COPY /.docker/app/cron/crontab.txt /etc/cron.d/crontab

# Give execution rights on the cron job
RUN chmod 0744 /etc/cron.d/crontab

# Apply cron job
RUN crontab /etc/cron.d/crontab

# Добавление кофиг файла supervisod
COPY /.docker/app/supervisor/supervisord.conf /etc/supervisor/supervisord.conf

# Добавление кофиг файлой воркеров
COPY /.docker/app/supervisor/conf.d /etc/supervisor/conf.d

# Добавление кастомных .ini файлов для php
COPY /.docker/app/conf.d /usr/local/etc/php/conf.d/

# Настройка php-fpm
COPY /.docker/app/php-fpm.d/www.conf /usr/local/etc/php-fpm.d

# Очистка мусора
RUN apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
