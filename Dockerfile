# BASE LAYER ============================================================================================================
FROM php:7.4-fpm-alpine as base
RUN  apk update && apk upgrade &&  apk add $PHPIZE_DEPS && apk add oniguruma-dev && apk add zlib-dev libpng-dev
RUN set -ex \
    && apk --no-cache add \
    postgresql-dev \
    && docker-php-ext-install sockets pdo_pgsql pdo_mysql mbstring exif pcntl bcmath gd \
    &&  pecl install -o -f redis &&  rm -rf /tmp/pear &&  docker-php-ext-enable redis

ENV APP_HOME=/var/www/html

# DEVELOPMENT LAYER =====================================================================================================
FROM base as dev
WORKDIR $APP_HOME
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# CI LAYER ==============================================================================================================
FROM dev as ci
WORKDIR $APP_HOME
COPY . .
RUN composer install \
    && cp .env.example .env \
    && php artisan key:generate

# PRODUCTION DEPS =======================================================================================================
FROM ci as prod
WORKDIR $APP_HOME
# REMOVING EXTRA FILES
RUN pecl uninstall xdebug
RUN composer install --no-dev


# SHIPMENT LAYER ========================================================================================================
FROM base as finish
WORKDIR $APP_HOME
COPY --from=prod --chown=www-data ${APP_HOME} ${APP_HOME}
