#!/bin/bash
#Startup multiple processes
service php7.4-fpm start
service cron start

cd /var/www/html
cp ./.env.example ./.env
composer install
php artisan key:generate
php artisan movies:top
php artisan migrate
npm install
npm run prod
php artisan serve --host=0.0.0.0 --port=8000
nginx -g "daemon off;"

