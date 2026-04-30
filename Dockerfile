FROM php:8.2-apache

# Enable rewrite
RUN a2enmod rewrite

# Set Apache root to /dashboard
ENV APACHE_DOCUMENT_ROOT /var/www/html/dashboard

# Update Apache config to use new root
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# Copy files
COPY . /var/www/html/

# Permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
