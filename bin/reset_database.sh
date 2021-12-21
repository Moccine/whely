#!/bin/bash

# shellcheck disable=SC2164
cd app/symfony

ls

# make sure we are up to date
php bin/console cache:clear

# reset catalog

php bin/console d:d:d --force
php bin/console d:d:c
php bin/console d:s:u -f
php bin/console doctrine:fixtures:load
php bin/console bms:services:slug:update

cd ../..