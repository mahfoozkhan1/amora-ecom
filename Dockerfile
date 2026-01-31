FROM php:8.2-apache

# Install system dependencies for PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*

# Install and enable PostgreSQL extensions for PHP
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pgsql pdo_pgsql

# Enable Apache rewrite module (if you use clean URLs later)
RUN a2enmod rewrite

# Copy your project files
WORKDIR /var/www/html
COPY . /var/www/html/

# Set permissions (Apache runs as www-data)
RUN chown -R www-data:www-data /var/www/html

# Expose port (Render uses $PORT env var internally)
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
