#!/bin/bash
/opt/plesk/php/8.0/bin/php /usr/lib64/plesk-9.0/composer.phar install --optimize-autoloader --no-dev
/opt/plesk/php/8.0/bin/php artisan env:decrypt production --replace
/opt/plesk/php/8.0/bin/php artisan optimize:clear
/opt/plesk/php/8.0/bin/php artisan ziggy:generate
/opt/plesk/php/8.0/bin/php artisan config:cache
/opt/plesk/php/8.0/bin/php artisan route:cache
/opt/plesk/php/8.0/bin/php artisan view:cache
/bin/yarn install
/bin/yarn prod
