FROM php:8.3-fpm

### Librares
RUN apt-get update && \
    apt-get install -y  git \
            wget \
            zip \
            libzip-dev \
            libpq-dev \
            libicu-dev \
            libfreetype6-dev \
            libjpeg62-turbo-dev \
            libpng-dev \
            libpng16-16 \
            libonig-dev \
            #libmpdec-dev \
            libsodium-dev

### base extensions
RUN docker-php-ext-install \
    intl \
    exif \
    zip \
    iconv \
    pdo \
    pdo_mysql \
    mysqli \
    pcntl \
    bcmath \
    sockets

### Xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug
###

### Redis
RUN pecl install redis
RUN docker-php-ext-enable redis.so
###

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ADD php.ini /usr/local/etc/php/conf.d/10-app.ini

CMD ["php-fpm", "-F"]

WORKDIR /var/www