#!/usr/bin/env bash

#UPDATE APT REPO
apt-get update
apt-get dist-upgrade

#INSTALL SERVICES
apt-get install -y apache2 php5 php-pear php5-curl

#LINK VAGRANT WWW TO APACHE WWW
ln -fs /vagrant/project/web /var/www/symfony-boilerplate

#ENABLE APACHE MOD REWRITE
a2enmod rewrite

#CREATE SYMFONY VIRTUAL HOST AND ENABLE
cp /vagrant/VirtualHost /etc/apache2/sites-available/symfony-boilerplate
a2ensite symfony-boilerplate

#INSTALL PHPUNIT
pear config-set auto_discover 1
pear install pear.phpunit.de/PHPUnit

#RESTART APACHE
service apache2 restart