RecENT - app for keeping track of employees work hours.
========================
#### NOTE!
RecENT is made of web app (this git repository), mobile app and record device. To make this whole system work you have to get and install all components of RecENT system. In **RecENT basic info** section you will find more info. For more info contact admin of this github repository.  

##Used bundles

Application uses following bundles:

  * [FOSUserBundle](http://symfony.com/doc/current/bundles/FOSUserBundle/index.html);

  * [FOSRestBundle](http://symfony.com/doc/current/bundles/FOSRestBundle/index.html);

##Configuration

After cloning of project, create database in MySQL. Remember **database name**, and users **username** and **password** (with all database permissions). In terminal navigete to project folder, and run: 
```
composer install
```
Then update database shema with:
```
php bin/console doctrine:schema:update --force
```

#RecENT basic info
RecENT is application which is developed for companies and organizations that want to upgrade their way of managing employees work hours. 
RecENT contains from:
  *  Web application;
  *  Mobile application;
  *  Record device - Raspberry Pi with NFC reader;

### Web application 
Through web application, company administration and accounting can get periodic(e.g. monthly) reports and manage employees work hours. 
GitHub: https://github.com/m-petkovic/projekt

### Mobile application
Mobile app is used by employees to record their arrival and departure form work. To record their arrival or departure, employee places his smartphone on record device, and trough installed RecENT mobile app and NFC sensor, he/she makes his checkout. 
GitHub: https://github.com/m-petkovic/recentAndroid

### Record device
Record device is placed on entrace of building or area where your employees work, so they can easly make a checkout. Record device is made of Raspberry Pi and NFC reader, and it requires a constant network connection for running.
GitHub: https://github.com/akovace/NFC-RFID-PN532-python

** For more info visit ** [RecENT webapge](http://recent.cekomat.com)

======================= 
