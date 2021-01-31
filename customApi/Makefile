test:
	php bin/phpunit

install:
	composer install

start:
	docker-compose up --detach --remove-orphans --force-recreate

psql:
	docker exec -ti customapi_database_1 psql -U postgres -W