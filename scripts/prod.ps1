param([string]$JwtPass="heslo123")
docker compose up -d --build
docker compose exec php sh -lc "mkdir -p config/jwt; if [ ! -f config/jwt/private.pem ]; then openssl genrsa -aes256 -out config/jwt/private.pem -passout pass:$JwtPass 4096 && openssl rsa -pubout -in config/jwt/private.pem -passin pass:$JwtPass -out config/jwt/public.pem; fi"
docker compose exec php php bin/console doctrine:migrations:migrate -n
docker compose -f docker-compose.dev.yml exec php php bin/console app:create-user test@demo.cz heslo123
copy frontend/.env.example frontend/.env.local