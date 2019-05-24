```bash
docker exec -d symfony.php-cli php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration
```