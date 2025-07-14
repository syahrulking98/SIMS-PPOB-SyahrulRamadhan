FROM php:8.2-cli

RUN apt-get update && apt-get install -y unzip zip curl && \
    docker-php-ext-install pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN chmod -R 777 writable

ENV CI_ENVIRONMENT=production

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
