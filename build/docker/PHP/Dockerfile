FROM php:7.4-fpm

RUN apt-get update && apt-get install -y git zip curl vim && \
    curl -sS https://getcomposer.org/installer -o composer-setup.php && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && rm composer-setup.php && \
    docker-php-ext-install pdo_mysql && \
    groupadd -g 1000 afroze && useradd -r -u 1000 -g afroze afroze && usermod -aG www-data afroze && mkdir /home/afroze/ && chown -R afroze:afroze /home/afroze

WORKDIR /var/www/workhours
