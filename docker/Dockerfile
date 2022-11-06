#указываем основной образ для контейнера
FROM ubuntu:latest
ENV TZ=Europe/Moscow
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
#обновим
RUN apt-get update

#устанавливаем апач
RUN apt-get install -y apache2 apache2-utils curl gnupg wget
RUN a2enmod rewrite

#установим переменные окружения


#указываем зону для нашего образа


#устанавливаем php и расширения
RUN apt-get install -y git perl \
    php7.4  nano

RUN apt-get install -y \
    php-pdo php-pdo-mysql \
    php-mbstring php-tokenizer \
    php-xml php-simplexml php-zip \
    php-opcache php-iconv php-intl \
    php-json php-gd php-ctype php-oauth \
    php-apcu php-imagick php-xdebug \
    php-memcached php-ftp php-imap \
    php-curl iputils-ping

RUN apt-get update

#откроем 80 порт
EXPOSE 80

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

#добавим в контейнер конфигурационный файл php.ini
ADD ./docker/conf/php/php.ini /etc/php/7.4/apache2/php.ini

#добавим конфигурацию xdebug
ADD ./docker/conf/php/xdebug.ini /etc/php/7.4/mods-available/xdebug.ini

#добавим конфигурационный файл для apache
ADD ./docker/conf/apache/apache2.conf /etc/apache2/apache2.conf

#очистим папки
RUN rm -R /etc/apache2/sites-enabled/* /etc/apache2/sites-available/* /var/www/*

#укажем директорию /var/www как рабочую
WORKDIR /var/www

#запускаем процесс apache2
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]