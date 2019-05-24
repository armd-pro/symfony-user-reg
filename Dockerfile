FROM php:7.2-cli

RUN docker-php-ext-install -j$(nproc) iconv mbstring mysqli pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/user-registration