#!/bin/sh

/etc/init.d/php8.1-fpm start

crontab /etc/cron.d/web-schedule
/etc/init.d/cron start

cd /var/www/html/web && php artisan migrate
#cd /var/www/html/web && php artisan queue:listen --tries=3 >/dev/null 2>&1 &

# Load this to get nvm environment, other wise pm2 will gets error
#export NVM_DIR="3/.nvm"
#[ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh"  # This loads nvm
#[ -s "$NVM_DIR/bash_completion" ] && \. "$NVM_DIR/bash_completion"  # This loads nvm bash_completion

# PM2 start
#cd /var/www/html/admin && yarn dev --log=/var/www/html/api/storage/logs/web.log
#cd /var/www/html/admin && pm2 start --log=/var/www/html/api/storage/logs/web.log

# Start nginx foreground
nginx -g 'daemon off;'
