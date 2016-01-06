#!/bin/bash

if [ `php -i | grep "docker-php-ext-sockets.ini" | wc -l` != "1" ]; then
  echo "Adding socket module"
  docker-php-ext-install sockets
fi

echo "Running Server: http://localhost:8000"
php -S 0.0.0.0:8000 -t /php/
