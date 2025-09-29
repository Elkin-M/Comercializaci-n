# Imagen base de PHP con Apache
FROM php:8.2-apache

# Instalar dependencias necesarias para PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Copiar el código al contenedor
COPY . /var/www/html/

# Exponer el puerto dinámico de Render
EXPOSE 80

# Ajustar DocumentRoot si usas subcarpeta (ej: public)
# RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Iniciar Apache
CMD ["apache2-foreground"]
