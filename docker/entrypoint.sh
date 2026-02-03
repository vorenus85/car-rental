#!/bin/bash
# Entry point script for Laravel Docker container

# Ensure Laravel storage and cache folders exist
mkdir -p storage/framework/views storage/framework/cache storage/framework/sessions storage/app/public/uploads

# Set permissions for PHP (www-data)
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Laravel storage link létrehozása (csak ha még nem létezik)
if [ ! -L /var/www/html/public/storage ]; then
    php artisan storage:link
fi

# Laravel cache, config, route cache (opcionális)
php artisan config:clear
php artisan route:clear

# Copy default images (only if not already present)
if [ -d /var/www/docker/default-images ]; then
    cp -n /var/www/docker/default-images/* storage/app/public/uploads/
fi

# Run the main container command
exec "$@"
