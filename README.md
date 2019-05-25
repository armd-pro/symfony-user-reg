
## Step
### Install composer requirements
```bash
docker exec symfony.php-cli composer install
```

## Step
### Install JavaScript requirements
```bash
docker exec symfony.php-cli npm install
```


## Step
### Database migration
```bash
docker exec symfony.php-cli php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration
```