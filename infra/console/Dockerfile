# build stage
FROM yiisoftware/yii2-php:8.1-fpm-nginx as build-stage
WORKDIR /app
COPY ./backend/composer.lock ./backend/composer.json ./
RUN composer install

# production stage
FROM php:8.1-cli as production-stage
WORKDIR /app
RUN docker-php-ext-install pdo_mysql
ENV PATH="$PATH:/app/console"
COPY --from=build-stage /app/vendor ./vendor
COPY ./backend/common ./common
COPY ./backend/console ./console
USER 1000