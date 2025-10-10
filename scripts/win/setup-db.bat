docker compose exec php php bin/console doctrine:migrations:migrate -n
docker compose exec php php bin/console app:create-user superadmin password123
copy frontend/.env.example frontend/.env.local