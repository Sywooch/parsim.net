#!/bin/sh
 
echo "Commit git!"
git add .
git commit -a -m "#"
git push

echo "connect to remote srv via ssh"
PRJ_PATH="/srv/www/dev.parsim.net"

spawn ssh -p 9999 pavel@parsim.net -t "sh $PRJ_PATH/deploy.sh $PRJ_PATH "
expect "pavel@parsim.net's password:"    
send "Ehdym_99\r"       
interact 

#ssh -p 9999 pavel@parsim.net -t "sh $PRJ_PATH/deploy.sh $PRJ_PATH "

