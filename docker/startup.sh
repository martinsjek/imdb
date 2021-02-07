#!/bin/bash
#Startup multiple processes
service php7.4-fpm start
service cron start
cd /var/www/html && /usr/bin/php artisan movies:top
cd /var/www/html && /usr/bin/php artisan migrate
cd /var/www/html && /usr/bin/php artisan serve --host=0.0.0.0 --port=8000
nginx -g "daemon off;"

