### Setup

#### Requirements

- Web server running PHP = 5.6.x (tested with PHP version 5.6.3)
- MySql server = 5.6.x (tested with MySQL version 5.6.21)
- MySql client or PHPMyAdmin
- MySql User with required permissions to create/insert users, databases, tables, data and grant permissions.

#### Installation

- Copy all files from source to your web server.
- Execute the script 'db/plantShop_complete.sql' in order to create database and required tables.
(this script creates a database named plantShop and a user called gardener identified by password plants4home).
- Copy file \_mySql.php.sample and rename it to \_mySql.php
- Launch browser http://{your host}/index.php or http://{your host}/admin.php

#### Login as customer

Grant Plant
Username: grant.plant@no-host
Password: gp

Peter Mueller
Username: peter.mueller@no-host
Password: pm

#### Login as admin

Username: admin@no-host
Password: admin