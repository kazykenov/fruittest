FROM yiisoftware/yii2-php:8.1-fpm-nginx

# Change document root for Apache
#RUN sed -i -e 's|/app/web|/app/api/web|g' /etc/apache2/sites-available/000-default.conf
#RUN adduser php
#USER www-data
#COPY --chown=php:php ./app.conf /etc/nginx/conf.d/default
COPY ./app.conf /etc/nginx/conf.d/default.conf