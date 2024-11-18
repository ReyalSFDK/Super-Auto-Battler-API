FROM php:8.2-cli

RUN apt-get update -y && apt-get install -y libmcrypt-dev git openssl zip unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html
COPY . .

RUN composer install --no-scripts

RUN chown -R www-data:www-data /var/www/html/var /var/www/html/public

EXPOSE 80

CMD ["apache2-foreground"]
