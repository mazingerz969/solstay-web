#!/bin/sh
set -eu

cd /var/www/html

mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

php artisan storage:link --force >/dev/null 2>&1 || true
php artisan migrate --force --no-interaction
php artisan config:cache
php artisan route:cache

if [ "${RUN_SEEDER:-false}" = "true" ]; then
    php artisan db:seed --force --no-interaction
fi

exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
