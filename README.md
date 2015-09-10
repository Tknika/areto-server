# areto-server

**Areto** is an open source automation software designed for conference rooms. We use it to control projectors, lights, audio system, TV screens, etc...

**Areto-Server** talks to different devices (projectors, extron, light controller, etc) and translates this information to the web frontend. It was initially designed in 2009 to work with a Flash UI and recently in 2015 modified to work with the new **areto-ui** HTML5 interface.

## Installation

*Note: this installation guide was tested on a Debian 8.0 Jessie*

Dependencies installation:

```sh
# Install required system packages
apt-get install git mysql-server php5 php5-mysql php-pear php5-curl php5-xmlrpc php5-xsl
# Install required php pear packages
pear install Net_Socket
```

Create database and import the dump:

```sh
mysql -u root -p -e "create database areto;"
mysql -u root -p areto < areto.sql
```

Configure database access in the file `dao/DaoAccess.php`:

```php
$strHost = 'localhost'
$strUser = 'root'
$strPassword = 'mypassword'
$strDatabase = 'areto'
```

## Starting the service

You can just run the command:

```sh
communication/hariak/hasi.php
```

<!--
DELETE THIS SECTION ONCE TESTED

## Required PHP packages
```
libapache2-mod-php5               server-side, HTML-embedded scripting languag
php-pear                          PEAR - PHP Extension and Application Reposit
php5                              server-side, HTML-embedded scripting languag
php5-cli                          command-line interpreter for the php5 script
php5-common                       Common files for packages built from the php
php5-curl                         CURL module for php5
php5-gd                           GD module for php5
php5-mcrypt                       MCrypt module for php5
php5-mysql                        MySQL module for php5
php5-snmp                         SNMP module for php5
php5-xmlrpc                       XML-RPC module for php5
php5-xsl                          XSL module for php5

Installed packages, channel pear.php.net:
=========================================
Package          
Archive_Tar      
Console_Getopt  
Net_Socket      
PEAR            
Structures_Graph
```
-->
