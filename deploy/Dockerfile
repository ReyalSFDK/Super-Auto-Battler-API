FROM php:8.2-cli

RUN apt-get update -y && apt-get install -y libmcrypt-dev git openssl zip unzip

RUN wget https://get.symfony.com/cli/installer -O - | bash

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
COPY . /app

RUN composer install

EXPOSE 8000

CMD ["php bin/console server:start 0.0.0.0:8000"]

