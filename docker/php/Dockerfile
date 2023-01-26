FROM php:8.1.0-fpm

RUN pecl install -o -f redis \
&&  rm -rf /tmp/pear \
&&  docker-php-ext-enable redis

RUN docker-php-ext-install exif \
&&  docker-php-ext-enable exif

#memcached
RUN apt-get update && apt-get install -y libmemcached-dev zlib1g-dev \
	&& pecl install memcached-3.1.4 \
	&& docker-php-ext-enable memcached

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        zlib1g-dev libzip-dev sendmail \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install sockets \

#    Чистим временные файлы
    && docker-php-source delete \
    && apt-get autoremove --purge -y && apt-get autoclean -y && apt-get clean -y

RUN echo "sendmail_path=/usr/sbin/sendmail -t -i" >> /usr/local/etc/php/conf.d/sendmail.ini
RUN sed -i '/#!\/bin\/sh/aservice sendmail restart' /usr/local/bin/docker-php-entrypoint
#RUN sed -i '/#!\/bin\/sh/aecho "$(hostname -i)\t$(hostname) $(hostname).localhost" >> /etc/hosts' /usr/local/bin/docker-php-entrypoin

# And clean up the image
RUN rm -rf /var/lib/apt/lists/*

# Указываем рабочую директорию для PHP
WORKDIR /var/www

# Copy crontab file to the cron.d directory
#COPY ./crontab /etc/cron.d

# Запускаем контейнер
# Вариант без крона
CMD ["php-fpm"]
# С работающим кроном
#CMD bash -c "cron && php-fpm"