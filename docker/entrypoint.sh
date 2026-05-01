#!/bin/bash
set -e

cd /var/www/html

if [ -f "composer.json" ]; then
    if [ ! -f "vendor/autoload.php" ]; then
        echo "Vendor não encontrado. Rodando composer install..."
        composer install --no-interaction --prefer-dist --optimize-autoloader
    else
        echo "Vendor já existe. Pulando composer install."
    fi
fi

exec "$@"
