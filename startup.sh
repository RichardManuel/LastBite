#!/bin/bash
set -e

echo "🚀 Starting Laravel application deployment..."

# Navigate to Laravel directory
cd Whisper-of-Hope

# Set essential environment variables if missing
export APP_ENV=${APP_ENV:-production}
export APP_DEBUG=${APP_DEBUG:-true}
export LOG_CHANNEL=${LOG_CHANNEL:-stderr}
export SESSION_DRIVER=${SESSION_DRIVER:-database}
export CACHE_STORE=${CACHE_STORE:-database}

# Fix session and CSRF configuration for Railway
export SESSION_LIFETIME=${SESSION_LIFETIME:-7200}
export SESSION_EXPIRE_ON_CLOSE=${SESSION_EXPIRE_ON_CLOSE:-false}
export SESSION_ENCRYPT=${SESSION_ENCRYPT:-false}
export SESSION_PATH=${SESSION_PATH:-/}
export SESSION_DOMAIN=${SESSION_DOMAIN:-}
export SESSION_SECURE_COOKIE=${SESSION_SECURE_COOKIE:-true}
export SESSION_HTTP_ONLY=${SESSION_HTTP_ONLY:-true}
export SESSION_SAME_SITE=${SESSION_SAME_SITE:-lax}

# Force HTTPS URLs in production
export APP_URL=${APP_URL:-https://whisper-of-hope-production-be1c.up.railway.app}
export FORCE_HTTPS=${FORCE_HTTPS:-true}

# Additional debugging for production
export APP_DEBUG=${APP_DEBUG:-true}
export LOG_LEVEL=${LOG_LEVEL:-debug}
export SANCTUM_STATEFUL_DOMAINS=${SANCTUM_STATEFUL_DOMAINS:-localhost,127.0.0.1,whisper-of-hope-production-be1c.up.railway.app}

echo "📋 Current environment variables:"
echo "APP_ENV: $APP_ENV"
echo "APP_DEBUG: $APP_DEBUG"
echo "DB_CONNECTION: $DB_CONNECTION"
echo "LOG_CHANNEL: $LOG_CHANNEL"
echo "SESSION_DRIVER: $SESSION_DRIVER"
echo "SESSION_LIFETIME: $SESSION_LIFETIME"
echo "SESSION_SAME_SITE: $SESSION_SAME_SITE"

# Regenerate autoloader to ensure all classes are loaded properly after directory fixes
echo "🔄 Regenerating autoloader after directory structure fixes..."
composer dump-autoload --no-dev --optimize

# Generate application key if not exists
echo "🔑 Generating application key..."
php artisan key:generate --force --no-interaction

# Clear all caches first
echo "🧹 Clearing caches..."
php artisan config:clear || echo "Config clear failed"
php artisan cache:clear || echo "Cache clear failed"
php artisan route:clear || echo "Route clear failed"
php artisan view:clear || echo "View clear failed"

# Test database connection
echo "🗄 Testing database connection..."
php artisan db:show || echo "Warning: Database connection failed"

# Test if models are working
echo "🔍 Testing models..."
php artisan tinker --execute="App\Models\Story::count(); echo 'Stories model OK';" || echo "Warning: Story model issue"
php artisan tinker --execute="App\Models\Category::count(); echo 'Category model OK';" || echo "Warning: Category model issue"
php artisan tinker --execute="App\Models\Whisper::count(); echo 'Whisper model OK';" || echo "Warning: Whisper model issue"
php artisan tinker --execute="App\Models\Color::count(); echo 'Color model OK';" || echo "Warning: Color model issue"

# Test controller instantiation
echo "🎮 Testing controllers..."
php artisan tinker --execute="try { new App\Http\Controllers\User\WhisperController(); echo 'WhisperController OK'; } catch (Exception \$e) { echo 'WhisperController Error: ' . \$e->getMessage(); }" || echo "WhisperController test failed"

# Run migrations
echo "📊 Running database migrations..."
php artisan migrate:fresh --force

# Seed database
echo "🌱 Seeding database..."
php artisan db:seed --force

# Create storage symlink for file uploads
echo "🔗 Creating storage symlink..."
php artisan storage:link || echo "Storage link already exists or failed"

# Optimize for production only if not debugging
if [ "$APP_DEBUG" = "false" ]; then
    echo "⚡ Optimizing application..."
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
else
    echo "🔧 Skipping optimization (debug mode)"
fi

# Start the server
echo "🌐 Starting web server on port $PORT..."
php -S 0.0.0.0:$PORT -t public