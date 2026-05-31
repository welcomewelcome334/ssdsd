#!/bin/bash

echo "Starting PHP server for LOST SIBLING TO WILLOW AND WILLIAM..."
echo

php -S localhost:8000

if [ $? -ne 0 ]; then
    echo
    echo "Error: PHP not found or not in PATH."
    echo "Please install PHP and make sure it's in your system PATH."
    echo "Download PHP from: https://www.php.net/downloads"
    read -p "Press Enter to continue..."
fi
