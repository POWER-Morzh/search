#!/bin/bash
# script to open site for installing extensions
echo "DO NOT FORGET TO RESET PERMISSIONS AFTER INSTALL"
chown -R -f www-data:www-data .
find . -type d -exec chmod 777 {} \;
find . -type f -exec chmod 777 {} \;
