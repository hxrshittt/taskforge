FROM php:8.2-apache

# Enable rewrite
RUN a2enmod rewrite

# Copy files
COPY . /var/www/html/

# Fix permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Fix Apache directory permissions (THIS IS THE REAL FIX)
RUN echo "<Directory /var/www/html>
    Options Indexes FollowSymLinks
    AllowOverride All
    Require all granted
</Directory>" > /etc/apache2/conf-available/custom.conf

RUN a2enconf custom

EXPOSE 80
