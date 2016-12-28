#!/bin/bash
docker-compose down
docker-compose up -d
docker exec -it symfony_symfony_1 bash
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --complete --force
php bin/console doctrine:fixtures:load -n
exit
