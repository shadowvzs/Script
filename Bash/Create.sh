#!/bin/sh
LPATH="/var/www/html"
echo -n "Please type you laravel project name (ex. MyProject):"
printf "\n"
read ProjectName
PPATH=$LPATH"/"$ProjectName"/"
clear
echo "------------------------------------";
echo " --- Create $ProjectName --- "
echo "------------------------------------";
cd $LPATH
laravel new $ProjectName
conf="<VirtualHost *:80>
    ServerName localhost

    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/html/$ProjectName/public

    <Directory /var/www/html/$ProjectName>
        AllowOverride All
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>"
echo "$conf" > /etc/apache2/sites-available/laravel.conf
chmod 
a2dissite 000-default.conf
a2ensite laravel.conf
a2enmod rewrite
service apache2 restart
chmod 777 -R $PPATH
echo "------------------------------------";
echo " --- Do not forget change MySQL related info --- "
echo "------------------------------------";
