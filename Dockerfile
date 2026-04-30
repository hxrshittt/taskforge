FROM php:8.2-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy project files to Apache root
COPY . /var/www/html/

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html

# Allow .htaccess override
RUN echo "<Directory /var/www/html>
    AllowOverride All
    Require all granted
</Directory>" > /etc/apache2/conf-available/override.conf

RUN a2enconf override

EXPOSE 80
