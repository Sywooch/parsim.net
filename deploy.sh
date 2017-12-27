#!/bin/sh

git pull --rebase
composer install
php yii migrate