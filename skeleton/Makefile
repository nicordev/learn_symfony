PHP_BIN_CONSOLE = php bin/console
HOST = '127.0.0.1:8002'

.DEFAULT_GOAL := help
help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' Makefile | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

##
## Containers
## ----------
##

install: build start composer-install database ## Install the application

reset: clean kill install

build:
	docker-compose pull --ignore-pull-failures
	docker-compose build --pull

kill:
	docker-compose kill
	docker-compose down --volumes --remove-orphans

clean:
	$(APPLICATION) rm -rf var vendor

start: ## Start all containers
	docker-compose up --detach --remove-orphans --force-recreate

start-specific-file: ## Start all containers
	docker-compose -f $(file) up --detach --remove-orphans --force-recreate

stop: ## Stop all containers
	docker-compose down --remove-orphans

##
## Symfony
## -------
##

symfony:
	wget https://get.symfony.com/cli/installer -O - | bash

serve: start
	symfony serve

pbc: ## Execute php bin/console. make pbc cmd="debug:router"
	$(PHP_BIN_CONSOLE) $(cmd)

entity: ## Execute php bin/console make:entity
	$(PHP_BIN_CONSOLE) make:entity

cc:
	rm -rf var/cache
	$(PHP_BIN_CONSOLE) cache:clear

##
## Composer
## -------
##

composer-install: composer.phar ## Run composer install
	composer install

composer-update: composer.phar ## Run composer update
	composer update

composer.phar:
	php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
	php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
	php composer-setup.php
	php -r "unlink('composer-setup.php');"

##
## Database
## --------
##

database: .env database-drop database-create database-update load-fixtures ## Reset the database and load fixtures

load-fixtures: ## Load the fixtures
	$(PHP_BIN_CONSOLE) doctrine:fixtures:load --no-interaction
	$(PHP_BIN_CONSOLE) doctrine:fixtures:load --no-interaction --env=test

migration: ## Create a migration file
	$(PHP_BIN_CONSOLE) make:migration

migrate: ## Execute database migrations
	$(PHP_BIN_CONSOLE) doctrine:migrations:migrate --no-interaction

database-update: ## Run doctrine:schema:update --force to update the database
	$(PHP_BIN_CONSOLE) doctrine:schema:update --force --env=dev
	$(PHP_BIN_CONSOLE) doctrine:schema:update --force --env=test

database-create: ## Create the database
	$(PHP_BIN_CONSOLE) doctrine:database:create --env=dev
	$(PHP_BIN_CONSOLE) doctrine:database:create --env=test

database-drop: ## Remove the database
	$(PHP_BIN_CONSOLE) doctrine:database:drop --env=dev --if-exists --force
	$(PHP_BIN_CONSOLE) doctrine:database:drop --env=test --if-exists --force

database-bash: ## Open a bash prompt in the database container
	docker exec -ti skeleton_database bash

encode-password:
	$(PHP_BIN_CONSOLE) security:encode-password $(password)
