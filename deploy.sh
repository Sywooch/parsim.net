#!/bin/sh

cd "$1"
#update project
git pull --rebase
composer install
php yii migrate