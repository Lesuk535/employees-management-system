docker-up:
	docker-compose up -d

docker-up-build:
	docker-compose up --build -d

docker-restart:
	docker-compose down --remove-orphans && docker-compose up -d

docker-down:
	docker-compose down --remove-orphans

composer-install:
	docker container exec -it employees-management-system-php-cli composer install

composer-update:
	docker container exec -it employees-management-system-php-cli composer update

composer-require-dev:
	docker container exec -it employees-management-system-php-cli composer require --dev ${p}

composer-command:
	docker container exec -it employees-management-system-php-cli composer ${c}

yarn-install:
	docker-compose exec node yarn install

yarn-add:
	docker-compose exec node yarn add ${p}

yarn-run-dev:
	docker-compose exec node yarn run dev

composer-require:
	docker container exec -it employees-management-system-php-cli composer require ${p}

assets-install:
	docker-compose exec node yarn install

artisan-publish:
	docker container exec employees-management-system-php-cli php artisan vendor:publish --provider="${p}"

artisan-migrate:
	docker container exec employees-management-system-php-cli php artisan migrate

artisan-any:
	docker container exec employees-management-system-php-cli php artisan ${c}

artisan-make:
	docker container exec employees-management-system-php-cli php artisan make:${m} ${n}

chmod:
	sudo chmod -R 777 ${p}

cache-clear:
	docker container exec employees-management-system-php-cli php artisan cache:clear && docker container exec employees-management-system-php-cli php artisan view:clear && docker container exec employees-management-system-php-cli php artisan route:clear
