docker compose -f docker-compose.dev.yml up -d
docker compose -f docker-compose.dev.yml exec php composer install
