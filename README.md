 # ABS

*Access and Benefits Sharing  is an online research permit system for :

*Biological resources
*Genetic Resources
*DNA / RNA extracts
*Bio Chemical resources
*Derivatives
*Progeny
*Traditional Knowledge
*Digital Sequence Information and associated information


## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

Things you need to install the software and how to install them

```
Web Server : Apache2/Nginx
Database Server : Mysql , Postgres , MS-SQL
```

### Installing

__Create mysql database__
 Import abs.tar.gz using php myadmin
 Edit  app/config/database.php  and app/config/databases.php , edit database host , user name and password.
 
 Copy ABS Master Project to a location e.g   /var/www/html/abs
 
 __In Apache , add virtual host for the front-end and shown below . This virtual host will serve the ABS frontend web portal.__
 
 ```
<VirtualHost  127.0.0.2:80>
	ServerAdmin webmaster@localhost
        ServerName    abs.net
        ServerAlias   abs.net
        DocumentRoot /var/www/html/abs/public/

       <Directory  /var/www/html/abs/public/ >
          Options Indexes FollowSymLinks MultiViews
          AllowOverride All
          Order allow,deny
          allow from all
        </Directory>
       
        RewriteEngine on

</VirtualHost>
```

__In Apache , add another virtual host for the back-end and shown below . This virtual host will serve the ABS administrative back-end portal.__

```
<VirtualHost  127.0.0.3:80>
	ServerAdmin webmaster@localhost
        ServerName   admin.abs.net
        ServerAlias    admin.abs.net
        DocumentRoot /var/www/html/abs/public/

       <Directory  /var/www/html/abs/public/ >
          Options Indexes FollowSymLinks MultiViews
          AllowOverride All
          Order allow,deny
          allow from all
        </Directory>
       
        RewriteEngine on

</VirtualHost>
```

__Edit  hosts file and map your virtual domains to the selected localhost IP Address as shown below__

In Linux :  In terminal 
```
#sudo nano /etc/hosts
```
In Windows : From Notepad, open the following file: 
```
c:\Windows\System32\Drivers\etc\hosts.
```

__Paste the following in the hosts file and save.__
```
127.0.0.2      abs.net
127.0.0.3      admin.abs.net
```

Restart  the web server service and visit the virtual domain in  your favourite browser.
  
## Built With

* [CodeIgniter](http://codeigniter.com/) - The web framework used

## Contributing

Please read [CONTRIBUTING.md] 

 
## Authors

* **Erastus Kariuki** - *Initial work* - [ekariz](https://github.com/ekariz)
* **Paul Oldham** - *Initial work* - [poldham](https://github.com/poldham)


## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

 




