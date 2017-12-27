#!/bin/sh
 
#echo "Commit git!"
#git add .
#git commit -a -m "#"
#git push

echo "connect to remote srv via ssh"
ssh -p 9999 pavel@parsim.net -t "sh /srv/www/dev.parsim.net/deploy.sh; bash"

