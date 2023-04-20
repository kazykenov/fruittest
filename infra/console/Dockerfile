# production stage
FROM php:8.1-cli as production-stage
WORKDIR /app
RUN docker-php-ext-install pdo_mysql
ENV PATH="$PATH:/app/console"
COPY --from=vendor-shared /app/vendor ./vendor
COPY ./backend/common ./common
COPY ./backend/console ./console
USER 1000