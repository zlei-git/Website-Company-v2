FROM php:8.4-cli-alpine

# Install system dependencies and PHP extensions required for Laravel 12
RUN apk add --no-cache \
    nodejs \
    npm \
    git \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    zip \
    unzip \
    sqlite-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql pdo_sqlite zip bcmath

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy application files
COPY . .

# Set up production environment configuration
RUN cp -n .env.example .env

# Install PHP dependencies without platform mismatch errors
RUN composer install --ignore-platform-reqs --optimize-autoloader --no-interaction

# Generate application key
RUN php artisan key:generate --force

# Install frontend dependencies and build Vite production assets
RUN npm install && npm run build

# Prepare database, storage, and cache directory permissions
RUN mkdir -p database && \
    touch database/database.sqlite && \
    chmod -R 777 database storage bootstrap/cache

EXPOSE 8000

CMD sh -c "mkdir -p database && touch database/database.sqlite && chmod -R 777 database storage bootstrap/cache && php artisan migrate --force && (php artisan db:seed --force || true) && php artisan storage:link || true && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}"
