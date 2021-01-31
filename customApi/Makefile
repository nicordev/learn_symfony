
.DEFAULT_GOAL := help
help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' Makefile | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

test: ## Run the test suite
	php bin/phpunit

install: ## Install packages
	composer install

start: ## Start the database and the Symfony web server
	docker-compose up --detach --remove-orphans --force-recreate
	symfony server:start -d # https://127.0.0.1:8001

browse: ## Browse the homepage
	symfony open:local

psql: ## Open psql in the database container
	docker exec -ti customapi_database_1 psql -U postgres -W

unit-test: ## Create a unit testing class
	symfony console make:unit-test

functional-test: ## Create a functional testing class
	symfony console make:functional-test

controller: ## Create a controller
	symfony console make:controller