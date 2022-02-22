#!/bin/sh
# Create the .env file if it does not exist.
echo "---Created .env file ---"
if [[ ! -f "./.env" ]] && [[ -f "./.env.example" ]];
then
cp ./.env.example ./.env
fi

echo "---Starting services using docker-compose---"
docker-compose up -d --build --remove-orphans --force-recreate

#echo "---Install Magento 2 by composer---"
#docker-compose exec app composer config -g http-basic.repo.magento.com f49c61ceecb5a7b352635873d63dc64a 5bee572a385af2c9b084a7e367e39180
#docker-compose exec app composer -n create-project --repository-url=https://repo.magento.com/ magento/project-community-edition=2.4.0 /var/www/src

echo "---Installing dependencies---"
#hard code api keys for easier wake up
docker-compose exec app composer config -g http-basic.repo.magento.com f49c61ceecb5a7b352635873d63dc64a 5bee572a385af2c9b084a7e367e39180
docker-compose exec app composer install --ignore-platform-reqs --no-interaction --working-dir=/var/www/src

echo "---Directory permission---"
docker-compose exec app chown -R :www-data .
docker-compose exec -w /var/www/src app chmod u+x bin/magento

echo "---Creating admin user---"
docker-compose exec -w /var/www/src app bin/magento setup:install \
--base-url=http://localhost \
--db-host=mysql \
--db-name=magento \
--db-user=root \
--db-password=secret \
--admin-user="admin" \
--admin-password="admin123" \
--admin-email="demo@user.com" \
--admin-firstname="Demo" \
--admin-lastname="User" \
--language=en_US \
--currency=USD \
--timezone=America/Chicago \
--elasticsearch-host=escontainer \
--elasticsearch-port=9200
