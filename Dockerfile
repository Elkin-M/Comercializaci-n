FROM php:8.2-cli

# Establece el directorio de trabajo
WORKDIR /app

# Copia todo el código al contenedor
COPY . /app

# Instala extensiones necesarias (pgsql, pdo, etc.)
RUN docker-php-ext-install pdo pdo_pgsql

# Exponer puerto dinámico
CMD ["php", "-S", "0.0.0.0:10000", "-t", "."]
