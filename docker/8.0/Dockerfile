FROM php:8.1.0-fpm

ENV TZ=Europe/Moscow

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update \
    && apt-get install -y --allow-downgrades --allow-remove-essential --no-install-recommends \
            libmemcached-dev \
            libzip-dev \
            libz-dev \
            libzip-dev \
            libpq-dev \
            libjpeg-dev \
            libpng-dev \
            libfreetype6-dev \
            libssl-dev \
            openssh-server \
            libmagickwand-dev \
            git \
            cron \
            nano \
            libxml2-dev \
            libreadline-dev \
            libgmp-dev \
            mariadb-client \
            unzip \
    && docker-php-ext-install soap \
    && docker-php-ext-install exif \
    && docker-php-ext-install pcntl \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install intl \
    && docker-php-ext-install gmp \
    && docker-php-ext-install sockets \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && docker-php-ext-install gd \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && echo "* * * * * www-data /usr/local/bin/php /var/www/artisan schedule:run >> /dev/null 2>&1"  >> /etc/cron.d/laravel-scheduler \
    && chmod 0644 /etc/cron.d/laravel-scheduler \
#####################################
# Aliases:
#####################################
# docker-compose exec php-fpm dep --> locally installed Deployer binaries
    && echo '#!/bin/bash\n/usr/local/bin/php /var/www/vendor/bin/dep "$@"' > /usr/bin/dep \
    && chmod +x /usr/bin/dep \
# docker-compose exec php-fpm art --> php artisan
    && echo '#!/bin/bash\n/usr/local/bin/php /var/www/artisan "$@"' > /usr/bin/art \
    && chmod +x /usr/bin/art \
# docker-compose exec php-fpm migrate --> php artisan migrate
    && echo '#!/bin/bash\n/usr/local/bin/php /var/www/artisan migrate "$@"' > /usr/bin/migrate \
    && chmod +x /usr/bin/migrate \
# docker-compose exec php-fpm fresh --> php artisan migrate:fresh --seed
    && echo '#!/bin/bash\n/usr/local/bin/php /var/www/artisan migrate:fresh --seed' > /usr/bin/fresh \
    && chmod +x /usr/bin/fresh \
# docker-compose exec php-fpm t --> run the tests for the project and generate testdox
    && echo '#!/bin/bash\n/usr/local/bin/php /var/www/artisan config:clear\n/var/www/vendor/bin/phpunit -d memory_limit=2G --stop-on-error --stop-on-failure --testdox-text=tests/report.txt "$@"' > /usr/bin/t \
    && chmod +x /usr/bin/t \
# docker-compose exec php-fpm d --> run the Laravel Dusk browser tests for the project
    && echo '#!/bin/bash\n/usr/local/bin/php /var/www/artisan config:clear\n/bin/bash\n/usr/local/bin/php /var/www/artisan dusk -d memory_limit=2G --stop-on-error --stop-on-failure --testdox-text=tests/report-dusk.txt "$@"' > /usr/bin/d \
    && chmod +x /usr/bin/d \
    && apt-get update \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \
    && . ~/.bashrc \
    && usermod -u 1000 www-data

WORKDIR /var/www/html

ADD php.ini /usr/local/etc/php/conf.d
#ADD www.conf /usr/local/etc/php-fpm.d/www.conf
#ADD zz-docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf


#COPY ./start-container.sh /usr/local/bin/
#RUN chmod +x /usr/local/bin/start-container.sh
#RUN ln -s /usr/local/bin/start-container.sh /
#ENTRYPOINT ["start-container.sh"]


EXPOSE 9000

# CMD ["php-fpm"]
CMD bash -c "composer install && php-fpm"
