start:
	php artisan serve --host 0.0.0.0

setup:
	composer install
	cp -n .env.example .env || true
	php artisan key:gen --ansi
	php artisan migrate
	npm install

test:
	php artisan test

test-coverage:
	composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml

deploy:
	git push heroku main

lint:
	composer exec -v phpcs

migrate-refresh:
	php artisan migrate:refresh --seed