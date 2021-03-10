PHP_BIN_CONSOLE = php bin/console

start:
	docker-compose up -d --force-recreate

stop:
	docker-compose down

cache-clear:
	$(PHP_BIN_CONSOLE) cache:clear

database: database-drop database-create database-update

database-drop:
	$(PHP_BIN_CONSOLE) doctrine:database:drop --force --if-exists

database-create:
	$(PHP_BIN_CONSOLE) doctrine:database:create

database-update:
	$(PHP_BIN_CONSOLE) doctrine:schema:update --force

database-migration:
	$(PHP_BIN_CONSOLE) make:migration

database-migrate:
	$(PHP_BIN_CONSOLE) doctrine:migrations:migrate --no-interaction

database-bash:
	docker-compose exec database bash

database-psql:
	docker-compose exec database psql --username=postgres --dbname=learn_symfony_easy_admin
