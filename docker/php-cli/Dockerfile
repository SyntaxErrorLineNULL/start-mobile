FROM php:8.0-cli-alpine3.12

RUN apk add --no-cache autoconf g++ make

#install mysql
RUN docker-php-ext-install pdo pdo_mysql

#install PG
#RUN apk add --no-cache postgresql-dev bash coreutils \
#    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
#    && docker-php-ext-install pdo_pgsql opcache

RUN apk add --no-cache unzip

RUN docker-php-ext-install bcmath fileinfo

ENV COMPOSER_ALLOW_SUPERUSER 1

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer --quiet --1 \
    && composer global require hirak/prestissimo --no-plugins --no-scripts \
    && rm -rf /root/.composer/cache

WORKDIR /app