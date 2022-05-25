FROM php:8.0-apache

RUN docker-php-ext-install pdo_mysql
RUN apt update -y && \
    apt upgrade -y && \
    apt install octave -y && \
    apt install liboctave-dev -y && \
    octave-cli --eval "pkg install -forge control"

WORKDIR /var/www/html/
RUN mkdir api
COPY ./client .
COPY ./api ./api

EXPOSE 80