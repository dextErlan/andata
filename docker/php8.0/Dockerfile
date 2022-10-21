FROM php:8.0-fpm-alpine

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN apk update && apk --no-cache --virtual add \
		bash \
		grep \
		nano \
	&& rm /var/cache/apk/* \
	&& chmod +x /usr/local/bin/install-php-extensions \
	&& sync \
	&& install-php-extensions \
		@composer \
		amqp \
		apcu \
		bcmath \
		exif \
		gd \
		imagick \
		intl \
		mcrypt \
		memcache \
		memcached \
		opcache \
		pdo_mysql \
		pcntl \
		sockets \
		zip

# install xdebug
RUN install-php-extensions xdebug

COPY php.ini /usr/local/etc/php/php.ini
COPY xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Expose port 9000 and start php-fpm server
EXPOSE 9000

CMD ["php-fpm", "-R"]