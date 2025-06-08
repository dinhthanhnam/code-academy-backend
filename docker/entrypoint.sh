#!/bin/bash

# if [ ! -d "vendor" ]; then
#   echo "No vendor/ folder found. Running composer install..."
#   composer install --no-progress --no-interaction --prefer-dist --no-dev || exit 1
# fi

php-fpm -D

RUN php artisan reverb:install
RUN php aritsan reverb:start &

nginx -g "daemon off;"