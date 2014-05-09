#!/usr/bin/env bash

#UPDATE APT REPO
apt-get update
apt-get dist-upgrade

#INSTALL SERVICES
apt-get install -y apache2 php5 php-pear php5-curl php5-mysql php-apc

#LINK VAGRANT WWW TO APACHE WWW
ln -fs /vagrant/project/web /var/www/symfony-boilerplate

#ENABLE APACHE MOD REWRITE
a2enmod rewrite

#CREATE SYMFONY VIRTUAL HOST AND ENABLE
cp /vagrant/VirtualHost /etc/apache2/sites-available/symfony-boilerplate
a2ensite symfony-boilerplate

#RESTART APACHE
service apache2 restart