#указываем основной образ для контейнера
FROM php:8.3-apache
#устанавливаем Московское время
ENV TZ=Europe/Moscow
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN a2enmod rewrite

RUN apt-get update && apt-get install -y \
        apt-utils \
        vim \
        rsync \
        curl \
        openssl \
        openssh-server \
        git \
        zlib1g-dev \
        libicu-dev \
        libzip-dev \
        g++ \
        zip \
        unzip \
        gnupg \
        gnupg2 \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

#добавим в контейнер конфигурационный файл php.ini
ADD ./docker/conf/php/php.ini /etc/php/8.3/apache2/php.ini
#добавим конфигурацию xdebug
ADD ./docker/conf/php/xdebug.ini /etc/php/8.3/mods-available/xdebug.ini
#добавим конфигурацию apache
ADD ./docker/conf/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 443


