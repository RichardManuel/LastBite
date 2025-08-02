#!/bin/bash
set -e

echo "🚀 Starting Laravel application deployment..."

# Set essential environment variables
export APP_ENV=${APP_ENV:-production}
export APP_DEBUG=${APP_DEBUG:-false}
export LOG_CHANNEL=${LOG_CHANNEL:-stderr}

# Generate application key
echo "🔑 Generating application key..."
php artisan key:generate --force

# Clear caches
echo "🧹 Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Run migrations
echo "📊 Running database migrations..."
php artisan migrate --force

# Seed database (if needed)
echo "🌱 Seeding database..."
php artisan db:seed --force

# Create storage symlink
echo "🔗 Creating storage symlink..."
php artisan storage:link

# Start server
echo "🌐 Starting web server..."
php -S 0.0.0.0:$PORT -t public
