#!/bin/bash
set -e

# Ensure storage & cache
mkdir -p storage/framework/views storage/framework/cache storage/framework/sessions storage/app/public/uploads
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Storage link
if [ ! -L public/storage ]; then
    php artisan storage:link
fi

# Clear caches
php artisan config:clear
php artisan route:clear

# Copy default images (only if not present)
#if [ -d /var/www/docker/default-images ]; then
#    cp -n /var/www/docker/default-images/* storage/app/public/uploads
#fi

# Wait for DB
echo "Waiting for database..."

until php -r "
try {
  new PDO(
    'mysql:host=' . getenv('DB_HOST') . ';port=3306',
    getenv('DB_USERNAME'),
    getenv('DB_PASSWORD'),
    [PDO::ATTR_TIMEOUT => 2]
  );
  exit(0);
} catch (Exception \$e) {
  exit(1);
}
" 2>/dev/null; do
  echo "DB not ready..."
  sleep 2
done

echo "DB ready. Migrating..."

# Migrate (safe)
php artisan migrate --force

# Seed only if users table empty
USER_COUNT=$(php artisan tinker --execute="
echo \Schema::hasTable('users') ? \App\Models\User::count() : 0;
")
if [ "$USER_COUNT" -eq 0 ]; then
    echo "Users table empty → seeding demo data"
    php artisan db:seed --force --class=DatabaseSeeder
else
    echo "Users exist → skipping seed"
fi

# Start main process
exec "$@"
