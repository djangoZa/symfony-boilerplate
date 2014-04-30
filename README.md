Introduction
============
This repository is intended to serve as the base for our PHP projects.

Prerequisites
=============
- Vagrant 1.3.3
- VirtualBox 4.2.18
- Git 1.7.11.3

Installation
============

###Clone Symfony Boilerplate
```bash
mkdir ~/workspace
cd ~/workspace
git clone https://github.com/djangoZa/symfony-boilerplate.git
```

###Provision Boilerplate
```bash
cd ~/workspace/symfony-boilerplate
APPLICATION_ENV='development' vagrant up --provision
```

Documentation
=============

###Vagrant
https://docs.vagrantup.com/v2/