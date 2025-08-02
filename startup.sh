#!/bin/bash

# Exit immediately if a command exits with a non-zero status.
set -e

echo "Starting deployment process..."

# Create a temporary .env file with specific environment variables from Railway.
# This is necessary for artisan commands that rely on a physical .env file,
# and it prevents parsing errors from non-standard environment variables.
echo "Creating a filtered .env file..."
touch .env
while IFS='=' read -r name value; do
    # Only include variables relevant to a Laravel application.
    if [[ "$name" =~ ^(APP|DB|RAILWAY|PORT|REDIS|MAIL)_ ]]; then
        # Write the key-value pair to the .env file.
        # This handles values that may contain spaces or other special characters.
        printf "%s=%s\n" "$name" "$value" >> .env
    fi
done < <(printenv)


# Check if Composer dependencies exist, otherwise install them
if [ ! -d "vendor" ]; then
    echo "Installing Composer dependencies..."
    composer install --no-dev --optimize-autoloader
else
    echo "Composer dependencies already installed."
fi

# Run database migrations with the --force flag
echo "Running database migrations..."
php artisan migrate:fresh --seed --force

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

