FROM php:8.2-fpm
RUN apt-get update && apt-get install -y \
      apt-utils \
      libpq-dev \
      libpng-dev \
      libzip-dev \
      zip unzip \
      git && \
      docker-php-ext-install pdo_pgsql && \
      docker-php-ext-install bcmath && \
      docker-php-ext-install gd && \
      docker-php-ext-install zip && \
      docker-php-ext-install sockets && \
      apt-get clean && \
      rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
# COPY ./_docker/app/php.ini /usr/local/etc/php/conf.d/php.ini
# Install composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin
WORKDIR /var/www
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www
VOLUME /var/www
# Copy existing application directory contents
COPY . /var/www
# Copy existing application directory permissions
COPY --chown=www:www . /var/www
RUN chmod 777 /var/www
RUN chmod 777 /home/www
RUN chown www:www /var/www
# Change current user to www
RUN usermod -u 1000 www
USER www