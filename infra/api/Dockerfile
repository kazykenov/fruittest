# production stage
# todo: can use an image with no composer (and many other extensions) installed
FROM yiisoftware/yii2-php:8.1-fpm-nginx as production-stage
WORKDIR /app
COPY --from=vendor-shared /app/vendor ./vendor
COPY ./infra/api/app.conf /etc/nginx/conf.d/default.conf
COPY ./backend/common ./common
COPY ./backend/api ./api