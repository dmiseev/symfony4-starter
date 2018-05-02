### Alias

```ini
alias dm-composer="docker-compose exec php-fpm composer"
alias dm-php="docker-compose exec php-fpm php"
alias dm-phpunit="docker-compose exec php-fpm vendor/bin/simple-phpunit"
```

### Init

```ini
dm-composer install
dm-php bin/console doctrine:migrations:migrate
dm-php bin/console doctrine:fixtures:load
```

### SSH (JWT)
mkdir -p config/jwt
openssl genrsa -out config/jwt/private.pem -aes256 4096
openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem

### Testing

Need exec docker-entrypoint-initdb.d/entrypoint.sh in database container.

```ini
dm-php bin/console doctrine:migrations:migrate --em=testing
dm-phpunit --stop-on-failure
```