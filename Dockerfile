FROM php:8.2-apache

# 👇 THIS LINE FORCES CACHE BREAK
RUN apt-get update

# Install mysqli
RUN docker-php-ext-install mysqli

RUN a2enmod rewrite

COPY . /var/www/html/

RUN echo "DirectoryIndex index.php" >> /etc/apache2/apache2.conf

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
