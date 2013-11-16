Eve-Seller
==========

Eve Seller is a small page for Eve Online to keep track of all your selling activities.
All selling acitivities are separated for your own orders and orders you have placed for your corporation.


Installation
------------

Simply upload all files on your server.
Import db_migrations/invTypes.sql, db_migrations/invGroups.sql and db_migrations/invCategories.sql in your database.
Now go to http://your.domain/db_migrations/migrations.php and run all migrations from top to bottom.
During the migrations an admin user with the following login data is created:

username: Admin
password: Admin123!

**Always** change the admin password right after the installation and migration!
