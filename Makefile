.PHONY: all

SHELL=/bin/bash -e

-include .env

build-project: run composer-install mig-up key-generate

run: ## Запустить проект
	@docker compose up -d

down:
	@docker compose down

composer-install:
	@docker compose exec -it app composer install

composer-update:
	@docker compose exec -it app composer update

mig-up:
	@docker compose exec -it app php artisan migrate

mig-down:
	@docker compose exec -it app php artisan migrate:rollback

mig-seed:
	@docker compose exec -it app php artisan db:seed

key-generate:
	@docker compose exec -it app php artisan key:generate