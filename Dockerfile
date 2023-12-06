# Utiliza una imagen base con PHP y Apache
FROM php:7.4-apache

# Instalar extensiones y dependencias necesarias
RUN docker-php-ext-install pdo_mysql

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Copiar archivos de la aplicación al contenedor
COPY ./www/app /var/www/html/

# Expone el puerto 80 para el servidor web
EXPOSE 80

# Inicia el servidor Apache
CMD ["apache2-foreground"]
