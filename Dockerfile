# Gunakan Apache bawaan PHP
FROM php:8.2-apache

# Copy semua file ke dalam /var/www/html
COPY . /var/www/html

# Aktifkan mod_rewrite untuk routing
RUN a2enmod rewrite

# Pastikan port environment digunakan
ENV PORT=7860
EXPOSE 7860

# Jalankan Apache di foreground
CMD ["apache2-foreground"]
