FROM php:8.2-apache

# Install dependencies & ekstensi
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql mysqli \
    && a2enmod rewrite

# Copy aplikasi
COPY . /var/www/html/
WORKDIR /var/www/html

# Set document root ke folder public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
 && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Set permissions (agar www-data bisa baca/tulis jika butuh)
RUN chown -R www-data:www-data /var/www/html \
 && chmod -R 755 /var/www/html

# Gunakan port dinamis dari Railway
ARG PORT
ENV PORT=${PORT:-8080}

# Ganti konfigurasi Apache agar listen di port ${PORT}
RUN sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf \
 && sed -i "s/:80/:${PORT}/" /etc/apache2/sites-available/000-default.conf || true \
 && echo "ServerName localhost" >> /etc/apache2/apache2.conf

EXPOSE ${PORT}

# Jalankan Apache di foreground
CMD ["apache2-foreground"]
