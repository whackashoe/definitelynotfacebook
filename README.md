definitelynotfacebook
=====================

A service to contact others via pgp. You are able to read your messages by entering in your public key, and able to send messages to others by entering in their public key and an encrypted message.

Non trusting design, everything must be encrypted as everything is public. 

Very open to pull requests and feature requests! Happy hacking. 

how to install?
===

* `cd /var/www`
* `git clone https://github.com/whackashoe/definitelynotfacebook.git`
* `mysql -uroot -e "create database definitelynotfacebook;"
* `mysql -uroot definitelynotfacebook < misc/definitelynotfacebook.sql`
* `cp misc/definitelynotfacebook.conf /etc/apache2/sites-available`
* `a2ensite definitelynotfacebook`
* `echo '127.0.0.1 definitelynotfacebook.dev' >> /etc/hosts`

Modify `/src/dfn.php` to contain correct mysql username, password and database. 
