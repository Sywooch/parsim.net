#!/bin/sh

cd /srv/www/dev.parsim.net/
git pull --rebase
composer install
php yii migrate