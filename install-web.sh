#!/bin/bash
# Update package lists
sudo apt-get update -y

# Install Apache
sudo apt-get install apache2 -y

# Install PHP and modules
sudo apt-get install php libapache2-mod-php php-mysql -y

# Install MySQL Server
sudo apt-get install mysql-server -y

# Clone your GitHub website files
sudo apt-get install git -y
sudo git clone https://github.com/mafromla/The-Wheel-of-Time-Blog/

# Restart Apache to load site
sudo systemctl restart apache2
