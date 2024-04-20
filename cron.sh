#!/bin/bash

# stash current changes
git stash

# Perform git fetch
git fetch --all

# reset branch to master
git reset --hard origin/master

# Install PHP dependencies with composer
composer install --no-interaction

# Install Node.js dependencies
npm install

# Build the project
npm run build
