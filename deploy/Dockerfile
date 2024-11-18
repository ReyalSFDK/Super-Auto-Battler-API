FROM php:8.2-cli
WORKDIR /usr/src/app

RUN apt-get update -y && apt-get install -y libmcrypt-dev git openssl zip unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . ./var/www/html
RUN composer install --no-scripts

# Copy application code
COPY . /usr/src/app/

# Set the default command to run Apache in the foreground
CMD ["apache2-foreground"]