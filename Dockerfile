# Gunakan Apache bawaan PHP
FROM php:8.2-apache

# Copy semua file ke dalam /var/www/html
COPY . /var/www/html

# Aktifkan mod_rewrite untuk routing
RUN a2enmod rewrite

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf


# Pastikan port environment digunakan
ENV PORT=7860
EXPOSE 7860

# Jalankan Apache di foreground
CMD ["apache2-foreground"]
