test:
	docker-compose exec classfuzz vendor/bin/phpunit .

fix:
	docker-compose exec classfuzz vendor/bin/php-cs-fixer fix .

static:
	docker-compose exec classfuzz vendor/bin/phpstan analyze src -c phpstan.neon

example:
	docker-compose exec classfuzz php app.php fuzzing --dir=examples/Simple
