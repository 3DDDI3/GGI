FROM php:8.2-fpm-alpine

RUN apk add --no-cache linux-headers \
  libtool \
  autoconf \
  gcc \
  g++ \
  make 

RUN apk add --no-cache \
  freetype \
  libjpeg-turbo \
  libpng \
  freetype-dev \
  libjpeg-turbo-dev \
  libpng-dev \
  && docker-php-ext-configure gd \
  --with-freetype=/usr/include/ \
  # --with-png=/usr/include/ \ # No longer necessary as of 7.4; https://github.com/docker-library/php/pull/910#issuecomment-559383597
  --with-jpeg=/usr/include/ \
  && docker-php-ext-install -j$(nproc) gd \
  && docker-php-ext-enable gd \
  && apk del --no-cache \
  freetype-dev \
  libjpeg-turbo-dev \
  libpng-dev \
  && rm -rf /tmp/*

RUN docker-php-ext-install \
  pdo \
  pdo_mysql \
  sockets  

RUN docker-php-ext-configure pcntl --enable-pcntl \
  && docker-php-ext-install \
  pcntl 

WORKDIR /var/www/laravel