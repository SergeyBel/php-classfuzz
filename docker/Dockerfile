FROM ubuntu:latest

ENV TZ=Europe/London

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && \
    echo $TZ > /etc/timezone && \
    apt-get update && apt-get install -qqy software-properties-common && \
    add-apt-repository ppa:ondrej/php && \
    apt-get update && apt-get install -qqy \
	  php8.0-cli \
	  php8.0-fpm \
	  php8.0-mbstring \
      php8.0-xdebug

ADD $PWD/php/ /etc/php

WORKDIR /app

ENTRYPOINT bash
