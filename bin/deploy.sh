#!/bin/bash
echo -e 'Loading the github deployment key'

pkill -f 'ssh-agent -s'
eval `ssh-agent -s`

#ssh-add ~/.ssh/github-3dtech
git pull origin $(git rev-parse --abbrev-ref HEAD)
#ssh-add ~/.ssh/github-3dtech
echo -e 'Download updates'
echo -e 'Installing Symfony dependencies'
cd /var/www/whely/whely/app/symfony
composer install
php bin/console doctrine:migrations:migrate --no-interaction
cd /var/www/whely/whely/app/integration/ && yarn run start
echo -e 'Installation of assets'
php bin/console assets:install public
echo -e 'Installation of Front dependencies'
cd /var/www/bmsconsulting-gn.com/app/integration/ && yarn run encore production

cd /var/www/whely/whely/app/symfony
echo -e 'Clear du cache'
php bin/console cache:clear
php bin/console cache:warmup

echo -e 'Updating permissions'
chmod -R +w var
umask 0
chown www-data: ../* -R

