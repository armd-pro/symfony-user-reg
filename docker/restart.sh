#!/usr/bin/env bash

cd $(dirname $0)

echo "Stoping containers"
./stop.sh

echo -e "\nStarting containers"
./start.sh