# Set master image
FROM php:7.4.14-fpm-alpine

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Install Additional dependencies
RUN apk update
RUN apk add --no-cache build-base shadow vim curl autoconf php php-fpm php-common \
	php-pdo php-pdo_mysql php-mbstring php-xml php-openssl php-json php-phar \
	php-zip php-gd php-dom php-session php-zlib php-pcntl php-curl

# Add and enable PHP-PDO Extensions
RUN docker-php-ext-install pcntl mysqli pdo pdo_mysql

# Install redis extension
RUN yes "" | pecl install -o -f redis \
	&&  rm -rf /tmp/pear \
	&&  docker-php-ext-enable redis

# Install PHP Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Remove Cache
RUN rm -rf /var/cache/apk/*

# Install PHP Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Remove Cache
RUN rm -rf /var/cache/apk/*

# Add UID '1000' to www-data
RUN usermod -u 1000 www-data

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www/html

# Change current user to www
USER www-data

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
