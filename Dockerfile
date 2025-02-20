FROM hiltonbanes/wintercms:latest

# Set PHP memory limit early to avoid rebuilds
RUN echo "memory_limit=8G" > /usr/local/etc/php/conf.d/memory_limit.ini

# Install required extensions
RUN apt-get update && apt-get install -y libevent-dev \
    && docker-php-ext-install sockets \
    && apt-get clean

# Set correct permissions (only on required directories)
RUN chmod -R 777 /var/www/html/storage 

# Enable cron jobs if needed
ENV ENABLE_CRON=true

CMD printenv > /etc/environment && apache2-foreground

EXPOSE 80
