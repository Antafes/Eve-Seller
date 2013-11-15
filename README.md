Eve-Seller
==========

Eve Seller is a small page for Eve Online to keep track of all your selling activities.
All selling acitivities are separated for your own orders and orders you have placed for your corporation.


Installation
------------

Simply upload all files on your server.
Import the MySQL dump inside db_migrations/files/cru11-mysql5-innoDB-v1.zip into your database.
Now go to http://your.comain/db_migrations/migrations.php and run all migrations from top to bottom.
During the migrations an admin user with the following login data is created:

username: Admin
password: Admin123!

*Always* change the admin password right after the installation and migration!