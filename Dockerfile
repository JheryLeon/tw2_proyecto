FROM php:8.4-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    libxml2-dev \
    unzip \
    git \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    zip \
    intl \
    mbstring \
    xml

# Enable Apache mod_rewrite
RUN a2enmod rewrite headers

# Create required directories
RUN mkdir -p /var/www/html/tmp /var/www/html/logs /var/www/html/webroot

# Copy application (without vendor)
COPY --chown=www-data:www-data . /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install dependencies
RUN composer install --no-interaction --no-dev

# Create entrypoint script that fixes permissions on startup
RUN echo '#!/bin/bash\n\
mkdir -p /var/www/html/tmp /var/www/html/logs /var/www/html/webroot\n\
find /var/www/html/tmp -type d -exec chmod 777 {} \; 2>/dev/null || true\n\
find /var/www/html/logs -type d -exec chmod 777 {} \; 2>/dev/null || true\n\
exec "$@"' > /entrypoint.sh && chmod +x /entrypoint.sh

# Expose port
EXPOSE 8085

# Use entrypoint
ENTRYPOINT ["/entrypoint.sh"]

# Start Apache
CMD ["apache2-foreground"]