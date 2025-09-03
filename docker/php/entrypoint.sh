#!/bin/sh

# If the vendor directory is empty or missing autoload.php, install dependencies
if [ ! -d "vendor" ] || [ ! -f "vendor/autoload.php" ]; then
  echo "Installing dependencies..."
  composer install
fi

# Execute the command passed to the container
exec "$@"
