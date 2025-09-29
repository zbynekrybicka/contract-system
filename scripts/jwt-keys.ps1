# scripts/jwt-keys.ps1  (použití: scripts/jwt-keys.ps1 -Pass "heslo123")
param([Parameter(Mandatory=$true)][string]$Pass)
docker compose -f docker-compose.dev.yml exec php sh -lc "mkdir -p config/jwt; if [ ! -f config/jwt/private.pem ]; then openssl genrsa -aes256 -out config/jwt/private.pem -passout pass:$Pass 4096 && openssl rsa -pubout -in config/jwt/private.pem -passin pass:$Pass -out config/jwt/public.pem; fi"
