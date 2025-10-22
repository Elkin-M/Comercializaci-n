# Imagen base de PHP con Apache
FROM php:8.2-apache

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libmariadb-dev-compat \
    libmariadb-dev \
    --no-install-recommends \
    && rm -rf /var/lib/apt/lists/*

# Habilitar las extensiones PDO para ambas bases de datos
# Quitamos mysqli y pgsql nativo; dejamos PDO para ambos
RUN docker-php-ext-install pdo pdo_pgsql pdo_mysql 

# Copiar el código al contenedor
COPY . /var/www/html/

# ... el resto del archivo se mantiene igual.

# Exponer el puerto dinámico de Render
EXPOSE 80

# Ajustar DocumentRoot si usas subcarpeta (ej: public)
# RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Iniciar Apache
CMD ["apache2-foreground"]