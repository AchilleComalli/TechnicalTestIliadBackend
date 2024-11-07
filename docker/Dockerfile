FROM php:7.4-apache


# Install PHP extensions
RUN apt-get update && apt-get install -y libsodium-dev libicu-dev libpng-dev libjpeg-dev libfreetype6-dev zip git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install intl pdo pdo_mysql gd sodium mysqli

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN a2enmod rewrite

# Copy the composer.json and composer.lock files to the container
COPY composer.json composer.lock .env spark preload.php builds index.php .htaccess /var/www/html/

WORKDIR /var/www/html

# Run composer install to install the dependencies
RUN composer install --no-interaction --prefer-dist


RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

EXPOSE 80

# Set Apache to run in the foreground
CMD ["apache2-foreground"]
