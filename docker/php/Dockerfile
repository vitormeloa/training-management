FROM php:8.3-fpm-alpine

RUN apk --no-cache add \
    build-base \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    zip \
    vim \
    unzip \
    git \
    curl \
    icu-dev \
    oniguruma-dev \
    libxml2-dev \
    mysql-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql intl mbstring xml bcmath opcache

WORKDIR /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./backend/composer.json ./backend/composer.lock ./

RUN composer install --no-scripts --no-autoloader

COPY ./backend .

RUN composer dump-autoload --optimize

COPY ./docker/php/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 775 /var/www/html && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80

ENTRYPOINT ["entrypoint.sh"]
CMD ["php-fpm"]
