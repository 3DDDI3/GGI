FROM php:8.2-fpm-alpine

RUN apk add --no-cache linux-headers \
  libtool \
  autoconf \
  gcc \
  g++ \
  make 

RUN apk update && apk add --no-cache \
  libpng-dev \
  libjpeg-turbo-dev \
  libwebp-dev \
  libzip-dev \
  freetype-dev \
  && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
  && docker-php-ext-install gd

RUN docker-php-ext-install \
  pdo \
  pdo_mysql \
  sockets \
  zip

RUN docker-php-ext-configure pcntl --enable-pcntl \
  && docker-php-ext-install \
  pcntl 

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www/laravel