#!/bin/bash

# Exit immediately if a command exits with a non-zero status.
set -e

echo "Starting deployment process..."

# Create a temporary .env file from the environment variables provided by Railway.
# This is necessary for artisan commands that rely on a physical .env file.
echo "Creating .env file from environment variables..."
printenv > .env

# Check if Composer dependencies exist, otherwise install them
if [ ! -d "vendor" ]; then
    echo "Installing Composer dependencies..."
    composer install --no-dev --optimize-autoloader
else
    echo "Composer dependencies already installed."
fi

# Run database migrations with the --force flag
echo "Running database migrations..."
php artisan migrate --force

# Clear and cache application configuration
echo "Clearing and caching configuration..."
php artisan config:clear
php artisan config:cache

# Optimize the application
echo "Optimizing application..."
php artisan optimize

# Start the Laravel application server on the port provided by Railway
echo "Starting Laravel application..."
php artisan serve --host=0.0.0.0 --port=$PORT

