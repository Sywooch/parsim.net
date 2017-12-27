#!/bin/sh


git pull --rebase
composer install
yii migrate