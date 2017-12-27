#!/bin/sh

cd /srv/www/dev.parsim.net/
#update project
git pull --rebase
composer install
php yii migrate