FROM armdpro/php:7.2-cli

ENV APT_KEY_DONT_WARN_ON_DANGEROUS_USAGE=DontWarn

RUN curl -sL https://deb.nodesource.com/setup_10.x | bash -
RUN apt-get install -y nodejs

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www
