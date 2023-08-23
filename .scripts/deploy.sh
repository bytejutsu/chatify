#!/bin/bash
set -e

echo "Deployment started ..."

# Enter maintenance mode or return true
# if already is in maintenance mode
(php artisan down) || true

# Stash any local changes
git stash

# Pull the latest version of the app
git pull origin production

# Install composer dependencies
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Clear the old cache
php artisan clear-compiled

# Recreate cache
php artisan optimize

#necessary if you are using nvm
export NVM_DIR=~/.nvm
source ~/.nvm/nvm.sh

# Compile npm assets
npm run build

# Run database migrations
php artisan migrate --force

# Exit maintenance mode
php artisan up

echo "Deployment finished!"
