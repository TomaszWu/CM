FROM php:8.1-cli

RUN set -eux \
   && apt-get update \
   && apt-get install -y libzip-dev zlib1g-dev \
   && docker-php-ext-install zip

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd
WORKDIR /var/www/html

COPY . .

COPY docker/php.ini /usr/local/etc/php/

WORKDIR /var/www/html

ENTRYPOINT [ "php" ]
