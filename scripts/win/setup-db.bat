docker compose exec php php bin/console doctrine:migrations:migrate -n
docker compose exec php php bin/console app:create-user test@demo.cz password123 John Test Demo 420 727815483
copy frontend/.env.example frontend/.env.local