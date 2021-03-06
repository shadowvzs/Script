#!/bin/sh
YOUR_NAME="shadowvzs"
YOUR_MAIL="shadowvzs@hotmail.com"
YOUR_REPO="https://github.com/shadowvzs/Laravel.git"
BINPATH="/var/www/html/vendor/bin"

clear
echo " --- Need ROOT !!! permission !!! --- ";

echo "------------------------------------";
echo " --- Install SSH Servr and bypass the ROOT access block --- ";
echo "------------------------------------";
wget "http://shadowvzs.uw.hu/script/Create.sh"
chmod 777 -R /root
apt-get install --yes --force-yes openssh-server
oldLine=$(grep "^PermitRootLogin" /etc/ssh/sshd_config)
newLine="PermitRootLogin yes"
sed -i "s/$oldLine/$newLine/g" /etc/ssh/sshd_config
#/etc/init.d/ssh start
echo "My Public Ip: ";
dig TXT +short o-o.myaddr.l.google.com @ns1.google.com | awk -F'\"' '{ print $2}'
sleep 1
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
#service apache2 restart
sleep 1
echo "------------------------------------";
echo " --- Install Git --- ";
echo "------------------------------------";
chmod 777 -R /var/www/
cd /var/www/
echo '#Add here what you do not want upload: file/foler names' > .gitignore
apt-get --yes --force-yes install git-all
git init
git config --global user.name "$YOUR_NAME"
git config --global user.email "$YOUR_MAIL"
git remote add Laravel $YOUR_REPO
echo "You can configure the etc/php/apache2/php.ini fo enable/disable extensions if you need"
sleep 1
echo "------------------------------------";
echo " --- Install Composer --- "
echo "------------------------------------";
cd
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
mv ./composer.phar /usr/local/bin/composer;
cd /usr/local/bin/
chmod -x ./composer
chmod 777 ./composer

echo "------------------------------------";
echo " --- Install Laravel --- "
echo "------------------------------------";
cd /var/www/html/
composer require "laravel/installer"
cmd=$(grep -ci "$BINPATH" /root/.bashrc);
if [ "$cmd" -eq "0" ]; then
	echo "export PATH=\"$BINPATH:\$PATH\"" >> /root/.bashrc
	#source /root/.bashrc
fi
cmd=$(grep -ci "$BINPATH" /root/.profile);
if [ "$cmd" -eq "0" ]; then
	echo "export PATH=\"$BINPATH:\$PATH\"" >> /root/.profile
	#source /root/.profile
fi
echo "------------------------------------";
echo " --- Restart --- "
echo "------------------------------------";
chmod 755 -R /root
chmod 777 -R /root/.config
sleep 5
reboot