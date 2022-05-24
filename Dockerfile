FROM php:8.0-apache

RUN apt update -y && apt upgrade -y  
RUN docker-php-ext-install pdo_mysql

WORKDIR /usr/src/api
COPY ./api .

WORKDIR /var/www/html
COPY ./client .

EXPOSE 80
