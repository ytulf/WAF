echo "" > /etc/apt/sources.list
add-apt-repository "deb [arch=amd64] https://deb.debian.org/$(. /etc/os-release; echo "$ID") $(lsb_release -cs) main contrib non-free"
add-apt-repository "deb [arch=amd64] https://deb.debian.org/$(. /etc/os-release; echo "$ID") $(lsb_release -cs)-updates main contrib non-free"
add-apt-repository "deb [arch=amd64] https://security.debian.org/$(. /etc/os-release; echo "$ID") $(lsb_release -cs)/updates main contrib non-free"

sed -i "s/#\ //" /etc/apt/sources.list

### Mise à jour du système
apt update -y && apt upgrade -y

apt install dnsmasq -y
echo "
#  add (range of IP address to lease and term of lease)
dhcp-range=192.168.0.200,192.168.0.250,1h

#  add (define default gateway)
dhcp-option=option:router,192.168.0.1 " > /etc/dnsmasq.conf

echo "192.168.0.100  https.projet.waf" >> /etc/hosts
/etc/init.d/dnsmasq restart

apt install apache2 unzip -y

cd /var/www/html
scp keijix@192.168.0.10://Users/Desktop/site.zip
unzip site.zip
rm -Rf site.zip
mv site waf
cp /etc/apache2/sites-available/default /etc/apache2/sites-available/waf
apt install php7.0 -y
a2enmod php && /etc/init.d/apache2 restart
