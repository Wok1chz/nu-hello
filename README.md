## Установка проекта
Быстро установить проект можно 2 способами: прописав все команды Docker вручную либо с помощью Makefile

0. Начало
```
cp .env.example .env
cp docker-compose.example.yaml docker-compose.yaml
```

На проде в .env файле указать api токен (X_API_KEY)

1. powershell/bash
```
docker compose up -d

docker compose exec -it app composer install

docker compose exec -it app php artisan migrate:refresh --seed

docker compose exec -it app php artisan passport:install
```

## TO-DO

TODO: Выставление ролей
