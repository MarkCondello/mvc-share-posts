FROM php:7.4-apache
# Install node
RUN curl -sL https://deb.nodesource.com/setup_10.x | bash
RUN apt-get install --yes nodejs
# Enable apache rewrite
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
# INSTALL NANO if I need to edit files in bash
RUN apt-get install nano
# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN mkdir -p /var/www/html
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli
RUN apt-get update && apt-get upgrade -y
RUN a2enmod rewrite