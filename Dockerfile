# Usa una imagen base de PHP
FROM php:8.1-fpm

# Instala dependencias necesarias para Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establece el directorio de trabajo
WORKDIR /app

# Copia los archivos del proyecto
COPY . .

# Instala las dependencias de Composer
RUN composer install

# Expone el puerto que usará la aplicación
EXPOSE 10000

# Comando para ejecutar el servidor PHP de Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
