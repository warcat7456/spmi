# Set default values for build arguments
ARG user=www
ARG uid=1000
ARG base_image=arm64v8/php:8.0-fpm

# Use the base image specified in the build argument
FROM ${base_image}

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Re-declare the arguments after the FROM command because they are cleared by default
ARG user
ARG uid

# Create system user to run Composer and Artisan Commands
# Note that the variables must be enclosed in braces
RUN useradd -G www-data,root -u ${uid} -d /home/${user} ${user} \
    && mkdir -p /home/${user}/.composer \
    && chown -R ${user}:${user} /home/${user}

# Set working directory
WORKDIR /var/www

# Switch to the user
USER ${user}
