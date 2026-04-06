FROM php:8.4-apache

ENV APACHE_DOCUMENT_ROOT=/var/www/html/webroot

RUN apt-get update && apt-get install -y \
    libzip-dev libonig-dev libpng-dev libicu-dev zlib1g-dev \
    libxml2-dev ca-certificates git unzip curl \
    && docker-php-ext-install pdo pdo_mysql mysqli mbstring zip intl opcache xml \
    && a2enmod rewrite headers \
    && rm -rf /var/lib/apt/lists/*

RUN sed -ri -e "s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/sites-available/*.conf \
    && sed -ri -e "s!<Directory /var/www/html>!<Directory ${APACHE_DOCUMENT_ROOT}>!g" /etc/apache2/apache2.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY app_ef/composer.json app_ef/composer.lock /var/www/html/
RUN cd /var/www/html && composer install --no-dev --optimize-autoloader

COPY app_ef/ /var/www/html

RUN mkdir -p /var/www/html/tmp /var/www/html/logs && \
    chown -R www-data:www-data /var/www/html && \
    find /var/www/html -type d -exec chmod 755 {} \; && \
    find /var/www/html -type f -exec chmod 644 {} \; && \
    chmod -R u+w /var/www/html/tmp /var/www/html/logs

EXPOSE 80

CMD ["apache2-foreground"]