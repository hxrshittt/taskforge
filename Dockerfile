FROM php:8.2-apache

# Enable mod_rewrite (safe)
RUN a2enmod rewrite

# Copy files
COPY . /var/www/html/

# Ensure index.php is default
RUN echo "DirectoryIndex index.php" >> /etc/apache2/apache2.conf

# Fix permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
