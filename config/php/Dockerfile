FROM php:7.0-fpm
MAINTAINER René Penner <rene@penner.name>

ENV PHP_EXTRA_CONFIGURE_ARGS --enable-fpm --with-fpm-user=www-data --with-fpm-group=www-data --enable-intl --enable-opcache

RUN apt-get update && \
    apt-get install -y \
        libpng12-dev \
        libjpeg-dev \
        libmcrypt-dev \
        libxml2-dev \
        freetype* \
        git \
        zlib1g-dev \
        libicu-dev \
        g++ \
        && \
    rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure \
    gd --with-png-dir=/usr --with-jpeg-dir=/usr \
    && \
    \
    docker-php-ext-install \
    gd \
    mbstring \
    mcrypt \
    mysqli \
    opcache \
    pdo \
    pdo_mysql \
    soap \
    zip \
    intl

# Install xdebug
RUN cd /tmp/ && git clone https://github.com/xdebug/xdebug.git \
    && cd xdebug && phpize && ./configure --enable-xdebug && make \
    && mkdir /usr/lib/php7/ && mv modules/xdebug.so /usr/lib/php7/xdebug.so \
    && touch /usr/local/etc/php/ext-xdebug.ini \
    && rm -r /tmp/xdebug \
    && apt-get purge -y --auto-remove