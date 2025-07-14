FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    nginx supervisor zip unzip curl \
    libicu-dev libzip-dev libpng-dev libonig-dev libxml2-dev \
 && docker-php-ext-install pdo pdo_mysql intl zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

RUN composer install --no-dev --optimize-autoloader \
 && mkdir -p /var/www/html/writable/cache \
 && chmod -R 777 /var/www/html/writable

COPY default.conf /etc/nginx/conf.d/default.conf
COPY supervisord.conf /etc/supervisord.conf

EXPOSE 8080

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
