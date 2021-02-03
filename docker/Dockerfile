FROM autodoc/environment-php:7.3
LABEL maintainer="dcorrea@autodoc.com.br;dlemos@autodoc.com.br"

USER root

# # Install selected extensions and other stuff
# RUN yes | pecl install xdebug 

COPY php.ini /usr/local/etc/php/
COPY default.conf /etc/apache2/sites-enabled/
COPY xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
USER php