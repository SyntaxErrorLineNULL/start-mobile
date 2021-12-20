init: down up
up:
	docker-compose -f docker-compose.yml up -d
down:
	docker-compose -f docker-compose.yml down -v --remove-orphans


#init: down build up api-composer-install init-db
#up:
#	docker-compose -f docker-compose.yaml up -d
#down:
#	docker-compose -f docker-compose.yaml down -v --remove-orphans
#build:
#	docker-compose -f docker-compose.yaml build --pull
#api-composer-install:
#	docker-compose -f docker-compose.yaml run --rm php-cli composer install
#api-composer-update:
#	docker-compose -f docker-compose.yaml run --rm php-cli composer update
#init-db:
#	docker-compose -f docker-compose.yaml run --rm php-cli bin/console doctrine:schema:drop --force && \
#   docker-compose -f docker-compose.yaml run --rm php-cli bin/console doctrine:schema:create
#clear-cache:
#	docker-compose -f docker-compose.yaml run --rm php-cli bin/console doctrine:cache:clear-metadata && \
#	docker-compose -f docker-compose.yaml run --rm php-cli bin/console doctrine:cache:clear-query
#load-fixture:
#	docker-compose -f docker-compose.yaml run --rm php-cli bin/console doctrine:fixtures:load