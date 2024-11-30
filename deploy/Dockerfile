# Use the official PHP image with Apache
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libicu-dev \
    libpq-dev \
    libzip-dev \
    && docker-php-ext-install \
    intl \
    pdo \
    pdo_mysql \
    zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set environment variable to allow Composer plugins to run as root
ENV COMPOSER_ALLOW_SUPERUSER=1

# Set working directory
WORKDIR /var/www/html

# Copy the application code
COPY . .

# Install PHP dependencies including dev dependencies
RUN composer install

# Set DocumentRoot to the public directory
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /var/www/html/var

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]