FROM hiltonbanes/wintercms:latest

RUN echo "memory_limit=8G" > /usr/local/etc/php/conf.d/memory_limit.ini
RUN chmod -R 777 /var/www/html/storage
RUN docker-php-ext-install sockets
ENV ENABLE_CRON=true
CMD printenv > /etc/environment && apache2-foreground

EXPOSE 80    