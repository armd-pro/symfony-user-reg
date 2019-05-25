FROM php:7.2-cli

RUN apt update
RUN apt install -y zlib1g-dev libzip-dev
RUN docker-php-ext-install zip

RUN curl -sL https://deb.nodesource.com/setup_10.x | -E bash -
RUN apt install -y nodejs

RUN docker-php-ext-install -j$(nproc) iconv mbstring mysqli pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/user-registration