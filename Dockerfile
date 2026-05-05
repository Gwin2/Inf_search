FROM php:8.2-apache

RUN docker-php-ext-install mysqli

WORKDIR /var/www/html

COPY . /var/www/html/
COPY docker/entrypoint.sh /usr/local/bin/labs-entrypoint

RUN chmod +x /usr/local/bin/labs-entrypoint

EXPOSE 80

ENTRYPOINT ["labs-entrypoint"]
CMD ["apache2-foreground"]
