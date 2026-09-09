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

# Install PHP dependencies without platform mismatch errors
RUN composer install --ignore-platform-reqs --no-dev --optimize-autoloader --no-interaction

# Install frontend dependencies and build Vite production assets
RUN npm install && npm run build

# Configure permissions for storage and bootstrap cache
RUN chmod -R 777 storage bootstrap/cache

EXPOSE 8000

CMD sh -c "php artisan storage:link || true && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}"
