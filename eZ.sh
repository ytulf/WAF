### eZ server monitor
echo "
########################################################
### Installation de eZ avec le script install_eZ.sh  ###
###                    par Thomas SAVIO              ###
########################################################
"

### Installation de eZ

apt-get install apache2 php5 unzip -y

cd /var/www/html
wget https://www.ezservermonitor.com/esm-web/downloads/version/2.5
unzip /var/www/html/2.5

mv /var/www/html/eZServerMonitor-2.5 /var/www/html/ez
chown www-data:www-data -Rf /var/www/html/ez/

ip -4 -o addr sh | grep 'inet adr:' | cut -d: -f2 | awk '{ print $1}' > ip.txt
read -p "
Aller maintenant sur http://`cat ip.txt`/ez, une fois fait appuyer sur n'importe quel touche pour retourner sur l'hôte" pause
rm -rf ip.txt
