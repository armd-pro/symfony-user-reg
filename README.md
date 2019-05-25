
# Symfony user registration example

### Requirements
* [docker](https://docs.docker.com/install/)
* [docker-compose](https://docs.docker.com/compose/install/)

### Instalation Instruction

#### Step 1: Clone repo
```bash
git clone https://github.com/armd-pro/symfony-user-reg.git project-name
```

#### Step 2: Build
```bash
cd project-name
docker-compose up --build
```

#### Step 3: Composer requirements
```bash
docker exec symfony.php-cli composer install
```

#### Step 4: JavaScript requirements
```bash
docker exec symfony.php-cli npm install
```

#### Step 5: Database migration
```bash
docker exec symfony.php-cli php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration
```

#### Step 6: Open in browser
* site url: http://localhost:8082/register
* phpmyadmin: http://localhost:8085


## Other

#### Access to mysql shell
```bash
docker exec -it symfony.mysql mysql -uroot -p12345 users
```

#### Create database dump
```bash
docker exec -it symfony.mysql mysqldump -uroot -p12345 users > /path/to/users.db.sql
```