#!/bin/bash

php artisan view:clear
php artisan config:clear
php artisan cache:clear
php artisan route:clear
#php artisan horizon:terminate
php artisan opcache:clear
