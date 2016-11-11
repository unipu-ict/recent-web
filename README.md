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

### Mobile application
Mobile app is used by employees to record their arrival and departure form work. To record their arrival or departure, employee places his smartphone on record device, and trough installed RecENT mobile app and NFC sensor, he/she makes his checkout. 

### Record device
Record device is placed on entrace of building or area where your employees work, so they can easly make a checkout. Record device is made of Raspberry Pi and NFC reader, and it requires a constant network connection for running.

** For more info visit ** [RecENT webapge](http://recent.cekomat.com)

======================= 
=======================
About Symfony
======================= 
Welcome to the Symfony Standard Edition - a fully-functional Symfony
application that you can use as the skeleton for your new applications.

For details on how to download and get started with Symfony, see the
[Installation][1] chapter of the Symfony Documentation.

What's inside?
--------------

The Symfony Standard Edition is configured with the following defaults:

  * An AppBundle you can use to start coding;

  * Twig as the only configured template engine;

  * Doctrine ORM/DBAL;

  * Swiftmailer;

  * Annotations enabled for everything.

It comes pre-configured with the following bundles:

  * **FrameworkBundle** - The core Symfony framework bundle

  * [**SensioFrameworkExtraBundle**][6] - Adds several enhancements, including
    template and routing annotation capability

  * [**DoctrineBundle**][7] - Adds support for the Doctrine ORM

  * [**TwigBundle**][8] - Adds support for the Twig templating engine

  * [**SecurityBundle**][9] - Adds security by integrating Symfony's security
    component

  * [**SwiftmailerBundle**][10] - Adds support for Swiftmailer, a library for
    sending emails

  * [**MonologBundle**][11] - Adds support for Monolog, a logging library

  * **WebProfilerBundle** (in dev/test env) - Adds profiling functionality and
    the web debug toolbar

  * **SensioDistributionBundle** (in dev/test env) - Adds functionality for
    configuring and working with Symfony distributions

  * [**SensioGeneratorBundle**][13] (in dev/test env) - Adds code generation
    capabilities

  * **DebugBundle** (in dev/test env) - Adds Debug and VarDumper component
    integration

All libraries and bundles included in the Symfony Standard Edition are
released under the MIT or BSD license.

Enjoy!

[1]:  https://symfony.com/doc/3.0/book/installation.html
[6]:  https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/index.html
[7]:  https://symfony.com/doc/3.0/book/doctrine.html
[8]:  https://symfony.com/doc/3.0/book/templating.html
[9]:  https://symfony.com/doc/3.0/book/security.html
[10]: https://symfony.com/doc/3.0/cookbook/email.html
[11]: https://symfony.com/doc/3.0/cookbook/logging/monolog.html
[13]: https://symfony.com/doc/3.0/bundles/SensioGeneratorBundle/index.html
