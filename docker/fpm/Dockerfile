FROM php:7.1-fpm

COPY app /var/www/html

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
	git \
	zip \
	unzip \
	libxml2-dev \
	libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
	libpq-dev \
    && docker-php-ext-configure gd \
	--with-freetype-dir=/usr/src/php/ext/ \
	--with-jpeg-dir=/usr/src/php/ext/ \
	--with-png-dir=/usr/src/php/ext/ \
    && docker-php-ext-install -j$(nproc) gd \
	pdo_pgsql

RUN curl -s http://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

EXPOSE 9000

CMD ["php-fpm"]
