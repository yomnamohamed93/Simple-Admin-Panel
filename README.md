# Simple-Admin-Panel
Admin panel using PHP 
---------------------------------------
1-create database named "companyDB".
2-import the database dump file "companyDB.sql" from the project root folder.
3-edit database configuration settings in "application/configs/application.ini" file. 
4- login with username: admin & password: iti.
---------
to create a virtual host:

$ sudo a2enmod rewrite
$ sudo gedit /etc/apache2/sites-available/ZFSite.conf

<VirtualHost *:80>
ServerName sitename.com
DocumentRoot /var/www/html/ZFSite/public
SetEnv APPLICATION_ENV "development"
<Directory /var/www/html/ZFSite>
DirectoryIndex index.php
AllowOverride All
</Directory>
</VirtualHost>

• Edit your /etc/hosts, add:

127.0.0.1 sitename.com

then: 
$sudo a2ensite site.conf
$sudo service apache2 reload


