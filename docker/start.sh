#!/usr/bin/env bash

cd $(dirname $0)

docker start symfony.mysql symfony.phpmyadmin symfony.php-cli