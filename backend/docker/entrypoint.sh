#!/usr/bin/env bash
set -e

# JWT klíče perzistují ve volume /var/www/html/config/jwt (viz compose)
if [ ! -f config/jwt/private.pem ]; then
  mkdir -p config/jwt
  if [ -z "$JWT_PASSPHRASE" ]; then echo "Missing JWT_PASSPHRASE"; exit 1; fi
  openssl genrsa -aes256 -out config/jwt/private.pem -passout pass:"$JWT_PASSPHRASE" 4096
  openssl rsa -pubout -in config/jwt/private.pem -passin pass:"$JWT_PASSPHRASE" -out config/jwt/public.pem
fi

# migrace před startem (fail = zastaví start → „immutable“ chování)
php bin/console doctrine:migrations:migrate -n

exec "$@"
