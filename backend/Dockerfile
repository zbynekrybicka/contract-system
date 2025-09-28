FROM php:8.2-apache
RUN apt-get update && apt-get install -y --no-install-recommends \
    git unzip libicu-dev libzip-dev libxml2-dev libsodium-dev \
 && docker-php-ext-install pdo_mysql intl zip opcache sodium \
 && a2enmod rewrite
# DocumentRoot -> /public + povolit .htaccess
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf \
 && printf "<Directory /var/www/html/public>\nAllowOverride All\nRequire all granted\n</Directory>\n" > /etc/apache2/conf-available/symfony.conf \
 && a2enconf symfony
WORKDIR /var/www/html
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer