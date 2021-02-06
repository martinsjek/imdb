FROM nginx:stable
#General bringing up  to date and prerequisites
RUN apt-get update && apt-get upgrade -y && apt-get install -y wget lsb-release vim unzip && rm -f /etc/localtime && ln -s /usr/share/zoneinfo/Europe/Riga /etc/localtime \
#add up to date php PPA, and retrieve latest stable php with required extensions that are not bundled with it
&& wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg \
&& echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php.list \
&& apt-get update && apt-get install -y \
php-fpm \
php-mbstring \
php-imagick \
php-zip \
php-xml \
php-curl \
php-intl \
php-pgsql \
php-mysql \
php-xdebug \
php-gd \
#add www-data group to nginx user so that nginx has access to php-fpm pool
&& usermod -aG www-data nginx \
# Installing composer and its prerequisites globally
&& php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && php composer-setup.php &&  php -r "unlink('composer-setup.php');" && mv composer.phar /usr/local/bin/composer \
# Installing node and npm and its prerequisites
&& apt-get install -y build-essential \
&& apt-get install -y cron \
&& curl -sL https://deb.nodesource.com/setup_lts.x | bash - \
    && apt-get install -y nodejs \
# Installing git (required for some composer actions)
&& apt-get install -y git
#COPY php.ini-development /etc/php/7.4/fpm/php.ini

COPY crontab /etc/cron.d/crontab

RUN chmod 0644 /etc/cron.d/crontab

RUN crontab /etc/cron.d/crontab

COPY startup.sh ./
RUN chmod a+x startup.sh

WORKDIR /var/www/html

EXPOSE 8000

CMD /startup.sh

