FROM php:8.2-apache

# Install mysqli (REQUIRED)
RUN docker-php-ext-install mysqli

# Enable rewrite
RUN a2enmod rewrite

# Copy project
COPY . /var/www/html/

# Set index.php default
RUN echo "DirectoryIndex index.php" >> /etc/apache2/apache2.conf

# Permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
