# Imagen base de PHP con Apache
FROM php:8.2-apache

# 1. Instalar dependencias necesarias para TODAS las bases de datos (PostgreSQL y MySQL/MariaDB)
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libmariadb-dev-compat \
    libmariadb-dev \
    --no-install-recommends \
    && rm -rf /var/lib/apt/lists/*

# 2. Habilitar las extensiones de bases de datos
#    Añadir 'pgsql' (necesario para pg_connect()), además de las que ya tenías.
#    Instalamos: PDO, PDO Postgres, **Postgres nativo (pgsql)**, MySQLi, PDO MySQL
RUN docker-php-ext-install pdo pdo_pgsql pgsql mysqli pdo_mysql

# Copiar el código al contenedor
COPY . /var/www/html/

# Exponer el puerto dinámico de Render
EXPOSE 80

# Ajustar DocumentRoot si usas subcarpeta (ej: public)
# RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Iniciar Apache
CMD ["apache2-foreground"]