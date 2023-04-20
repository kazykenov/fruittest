# build stage
FROM yiisoftware/yii2-php:8.1-fpm-nginx as build-stage
WORKDIR /app
COPY ./backend/composer.lock ./backend/composer.json ./
RUN composer install