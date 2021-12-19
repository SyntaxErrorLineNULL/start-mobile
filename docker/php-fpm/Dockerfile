FROM php:8.0-fpm-alpine3.13

#install mysql
RUN docker-php-ext-install pdo pdo_mysql

#RUN apk add --no-cache postgresql-dev fcgi \
#    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
#    && docker-php-ext-install pdo_pgsql

RUN docker-php-ext-install bcmath fileinfo