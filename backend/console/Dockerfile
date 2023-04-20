FROM php:8.1-cli

RUN docker-php-ext-install pdo_mysql

ENV PATH="$PATH:/app"

USER 1000
WORKDIR /app