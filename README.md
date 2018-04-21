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

### Testing

```ini
dm-php bin/console doctrine:migrations:migrate --em=testing
dm-phpunit --stop-on-failure
```