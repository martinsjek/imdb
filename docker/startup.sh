#!/bin/bash
#Startup multiple processes
service php7.4-fpm start
service cron start
nginx -g "daemon off;"
/usr/bin/php artisan serve --host=0.0.0.0 --port=8000