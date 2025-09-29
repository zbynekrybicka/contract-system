param([string]$Email="test@demo.cz",[string]$Pass="heslo123")
docker compose up -d --build
docker compose exec php php bin/console doctrine:migrations:migrate -n
docker compose exec php php bin/console app:create-user $Email $Pass