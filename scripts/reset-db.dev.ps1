# scripts/reset-db.ps1  (DEV ONLY!)
docker compose -f docker-compose.dev.yml exec php php bin/console doctrine:database:drop --force
docker compose -f docker-compose.dev.yml exec php php bin/console doctrine:database:create
scripts/migrate.ps1
scripts/create-user.ps1
