param([string]$Email="test@demo.cz",[string]$Pass="heslo123")
docker compose -f docker-compose.dev.yml exec php php bin/console app:create-user $Email $Pass
