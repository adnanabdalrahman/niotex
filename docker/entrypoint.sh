#!/bin/sh
set -e

cd /var/www/html

# Bind-mounted log folder may be owned by the host user
mkdir -p storage/logs
chown -R www-data:www-data storage bootstrap/cache

# Clear any config cache built on the host, so the container's env vars are used
php artisan config:clear >/dev/null 2>&1 || true

# Migrations run against the API's own MySQL database only (never sqlsrv).
# Only the "app" container sets RUN_MIGRATIONS=true.
if [ "$RUN_MIGRATIONS" = "true" ]; then
    php artisan migrate --database=mysql --force
fi

exec "$@"
