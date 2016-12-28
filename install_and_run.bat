docker-compose down
docker-compose up -d
docker exec polytechcinemaserver_symfony_1 php bin/console doctrine:database:create
docker exec polytechcinemaserver_symfony_1 php bin/console doctrine:schema:update --complete --force
docker exec polytechcinemaserver_symfony_1 php bin/console doctrine:fixtures:load -n
