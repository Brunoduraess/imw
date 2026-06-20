#!/bin/bash
set -e

cd /var/www/html

mkdir -p \
    bootstrap/cache \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs

chgrp -R www-data storage bootstrap/cache
chmod -R g+rwX storage bootstrap/cache
find storage bootstrap/cache -type d -exec chmod g+s {} +

if [ -f "composer.json" ]; then
    if [ ! -f "vendor/autoload.php" ]; then
        echo "Vendor não encontrado. Rodando composer install..."
        composer install --no-interaction --prefer-dist --optimize-autoloader
    else
        echo "Vendor já existe. Pulando composer install."
    fi
fi

exec "$@"
