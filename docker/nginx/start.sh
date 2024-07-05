#!/usr/bin/env bash

rm -rf /etc/nginx
cp -R /app/config/nginx /etc
service nginx restart

rm -rf /etc/php81
cp -R /app/config/php81 /etc/php81
service php-fpm83 restart

clear

echo -e "
          \u001b[32mIlias server started successfully!
    \u001b[37mEnd-points available in: \u001b[36m\u001b[4mhttp://your.dev.api.com\u001b[0m
     \u001b[30mUse \u001b[1m./docker/connect.sh\u001b[0m \u001b[30mto access the container
";

echo -e "
\u001b[37m---------------| \u001b[1mAccess and error logs:\u001b[0m \u001b[37m|----------------
";

tail -fq /var/log/nginx/access.log /var/log/nginx/error.log