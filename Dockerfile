FROM php:8.2-apache
WORKDIR /var/www/html
COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html
RUN a2enmod rewrite
CMD ["apache2-foreground"]
EXPOSE 80