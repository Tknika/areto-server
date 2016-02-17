# areto-server

**Areto** is an open source automation software designed for conference rooms. We use it to control projectors, lights, audio system, TV screens, etc...

**Areto-Server** talks to different devices (projectors, extron, light controller, etc) and translates this information to the web frontend. It was initially designed in 2009 to work with a Flash UI and recently in 2015 modified to work with the [new **areto-ui** HTML5 interface](https://github.com/Tknika/areto-ui).

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
mysql -u root -p areto < db/areto.sql
```

Create the file `dao/DaoAccess.php` from template:

```sh
cp dao/DaoAccess.php.dist dao/DaoAccess.php
```
Edit the file with your database configuration:

```php
$strHost = 'localhost'
$strUser = 'root'
$strPassword = 'mypassword'
$strDatabase = 'areto'
```

## Starting the service

<!--
You can just run the command:

```sh
communication/hariak/hasi.php
```
-->

To start areto-server, use the next script:

```sh
bin/areto-daemon.sh start
```
