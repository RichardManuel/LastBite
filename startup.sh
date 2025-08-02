#!/bin/bash

# Exit immediately if a command exits with a non-zero status.
set -e

echo "Starting deployment process..."

# Check if Composer dependencies exist, otherwise install them
if [ ! -d "vendor" ]; then
    echo "Installing Composer dependencies..."
    composer install --no-dev --optimize-autoloader
else
    echo "Composer dependencies already installed."
fi

# Run database migrations
echo "Running database migrations..."
php artisan migrate --force

# Clear and cache application configuration
echo "Clearing and caching configuration..."
php artisan config:clear
php artisan config:cache

# Optimize the application
echo "Optimizing application..."
php artisan optimize

# Start the Laravel application server
echo "Starting Laravel application..."
php artisan serve --host=0.0.0.0 --port=$PORT
