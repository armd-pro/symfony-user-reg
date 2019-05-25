
# Symfony user registration example

* [Requirements](#requirements)
* [Instalation Instruction](#instalation-instruction)
* [Other](#other)
    * [Access to mysql shell](#access-to-mysql-shell)
    * [Access to mysql shell from outside](#access-to-mysql-shell-from-outside)
    * [Create database dump](#create-database-dump)
    * [Helper utils](#helper-utils)

### Requirements
* [docker](https://docs.docker.com/install/)
* [docker-compose](https://docs.docker.com/compose/install/)

### Instalation Instruction

#### Step 1: Clone repo
```bash
git clone https://github.com/armd-pro/symfony-user-reg.git
```

#### Step 2: Build
```bash
cd symfony-user-reg
docker-compose up --build -d
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

#### Access to mysql shell from outside
```bash
mysql -h 127.0.0.1 -P 3307 -uroot -p12345
```

#### Create database dump
```bash
docker exec -it symfony.mysql mysqldump -uroot -p12345 users > /path/to/users.db.sql
```

#### Helper utils
```bash
docker/stop.sh
docker/start.sh
docker/restart.sh
```