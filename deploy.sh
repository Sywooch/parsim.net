#!/bin/sh

cd "$1"
#update project
#git pull --rebase
git fetch origin
git reset --hard origin/master
composer install
php yii migrate