# Imagen base con PHP y Apache
FROM php:8.2-apache

# Configurar directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos del proyecto al contenedor
COPY . .

# Instalar extensiones necesarias para Laravel
RUN apt-get update && apt-get install -y \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo_mysql

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Copiar script de inicio
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Configurar permisos para storage y cache
RUN chmod -R 755 storage bootstrap/cache
RUN chmod -R 755 public

# Exponer el puerto 8000
EXPOSE 8000

# Usar entrypoint personalizado
ENTRYPOINT ["/entrypoint.sh"]
