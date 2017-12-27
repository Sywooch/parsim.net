#!/bin/sh
 
echo "Commit git!"
git add .
git commit -a -m "#"
git push

echo "connect to remote srv via ssh"
ssh -P 9999 pavel@parsim.net
cd /srv/www/dev/parsim.net

