FROM php:7.4-fpm

ARG user
ARG uid

# Install system dependencies
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git curl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

WORKDIR /var/www

USER $user
