FROM yiisoftware/yii2-php:8.1-fpm-nginx

FROM node:lts-alpine as build-stage
WORKDIR /app
COPY ./vue/package*.json ./
RUN npm install
COPY ./vue .
RUN npm run build

# production stage
FROM nginx:stable-alpine as production-stage
COPY ./startup.sh /app/
RUN chmod a+x /app/startup.sh
COPY ./default.conf /etc/nginx/conf.d/default.conf
COPY --from=build-stage /app/dist /usr/share/nginx/html

# Change document root for Apache
#RUN sed -i -e 's|/app/web|/app/api/web|g' /etc/apache2/sites-available/000-default.conf
#RUN adduser php
#USER www-data
#COPY --chown=php:php ./app.conf /etc/nginx/conf.d/default
COPY ./app.conf /etc/nginx/conf.d/default.conf