#!/bin/bash
# script to close site after installing extensions
echo "That's better! Secure Again!"
chown -R -f www-data:www-data .
find . -type d -exec chmod 755 {} \;
find . -type f -exec chmod 644 {} \;
#find . -name 'index.php' -exec chmod 440 {} \;
#chmod -R 440 ./configuration.php
