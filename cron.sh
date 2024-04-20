#!/bin/bash

# Perform git pull
git pull

# Install PHP dependencies with composer
composer install --no-interaction

# Install Node.js dependencies
npm install

# Build the project
npm run build
