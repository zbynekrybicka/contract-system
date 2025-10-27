docker compose up -d --build
docker compose exec php sh -lc "mkdir -p config/jwt; if [ ! -f config/jwt/private.pem ]; then openssl genrsa -aes256 -out config/jwt/private.pem -passout pass:pass123 4096 && openssl rsa -pubout -in config/jwt/private.pem -passin pass:pass123 -out config/jwt/public.pem; fi"
docker compose exec php chmod 644 /var/www/html/config/jwt/private.pem
docker compose exec php chmod 644 /var/www/html/config/jwt/public.pem
docker compose exec php composer install
