docker-compose down
docker-compose pull symfony
docker-compose up -d
docker exec cinema_symfony php bin/console doctrine:database:create
docker exec cinema_symfony php bin/console doctrine:schema:update --complete --force
docker exec cinema_symfony php bin/console doctrine:fixtures:load -n
docker exec cinema_symfony chmod -R o+w var
