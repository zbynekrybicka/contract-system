docker compose -f docker-compose.dev.yml exec php php bin/console doctrine:migrations:migrate -n
