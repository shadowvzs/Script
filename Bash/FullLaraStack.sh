#!/bin/sh
echo " --- Need ROOT !!! permission !!! --- ";

echo "------------------------------------";
echo " --- Install SSH Servr and bypass the ROOT access block --- ";
echo "------------------------------------";
apt-get install --yes --force-yes openssh-server
oldLine=$(grep "^PermitRootLogin" /etc/ssh/sshd_config)
newLine="PermitRootLogin yes"
service ssh restart
service sshd restart
sed -i "s/$oldLine/$newLine/g" /etc/ssh/sshd_config
echo "My Public Ip: ";
dig TXT +short o-o.myaddr.l.google.com @ns1.google.com | awk -F'\"' '{ print $2}'

echo "------------------------------------";
echo " --- LAMP Stack --- ";
echo "------------------------------------";
apt --yes --force-yes install tasksel
apt-get update
apt-get --yes --force-yes install apache2
tasksel install lamp-server
apt --yes --force-yes install apache2
apt --yes --force-yes install mysql-server
apt --yes --force-yes install php libapache2-mod-php php-mysql
apt --yes --force-yes install php-curl php-json php-cgi php-mbstring php-xml php-zip
apt --yes --force-yes install zip
service apache2 restart
echo "------------------------------------";
echo " --- Install Git --- ";
echo "------------------------------------";
chmod 777 -R /var/www/
cd /var/www/
echo '#Add here what you do not want upload: file/foler names' > .gitignore
apt-get --yes --force-yes install git-all
git init
git config --global user.name "shadowvzs"
git config --global user.email "shadowvzs@hotmal.com"
git remote add Laravel https://github.com/shadowvzs/Laravel.git
echo "You can configure the etc/php/apache2/php.ini fo enable/disable extensios"

echo "------------------------------------";
echo " --- Install Composer --- "
echo "------------------------------------";
cd
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
mv ./composer.phar /var/www/html/composer;

echo "------------------------------------";
echo " --- Install Laravel --- "
echo "------------------------------------";
cmd=$(grep -ci "/var/www/html/" /root/.bashrc);
if [ "$cmd" -eq "0" ]; then
    #path not was setted
	echo "export PATH=\"/var/www/html/vendor/bin:\$PATH\"" >> /root/.bashrc
	source /root/.bashrc
fi
cd /var/www/html/
./composer global require "laravel/installer"
