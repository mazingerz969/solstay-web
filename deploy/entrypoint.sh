#!/bin/sh
set -eu

cd /var/www/html

php artisan storage:link --force >/dev/null 2>&1 || true
php artisan migrate --force --no-interaction
php artisan config:cache
php artisan route:cache
php artisan view:cache

if [ "${RUN_SEEDER:-false}" = "true" ]; then
    php artisan db:seed --force --no-interaction
fi

exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
