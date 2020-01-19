FROM php:7.4.1-fpm

LABEL maintainer="Endru Reza <lotusb13@gmail.com>"

RUN apt-get update \
    && apt-get upgrade \
    && apt-get install cron -y \
    && docker-php-ext-install mysqli pdo pdo_mysql

ADD crontab /etc/cron.d/cron

RUN chmod 0644 /etc/cron.d/cron

RUN touch /var/log/cron.log

CMD printenv > /etc/environment && echo "cron starting..." && (cron) && : > /var/log/cron.log && tail -f /var/log/cron.log

