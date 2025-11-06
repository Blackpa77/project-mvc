FROM php:8.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip \
    && docker-php-ext-install pdo pdo_mysql mysqli \
    && a2enmod rewrite

# Copy aplikasi
COPY . /var/www/html/

# Gunakan folder public sebagai document root
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Set izin
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Gunakan port dari Railway (otomatis)
ARG PORT
ENV PORT=${PORT:-8080}
RUN sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf
EXPOSE ${PORT}

# Jalankan Apache
CMD ["apache2-foreground"]
