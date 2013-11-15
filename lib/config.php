<?php

//access data for the database
$GLOBALS['db'] = array(
	'server' => 'localhost',
	'user' => 'root',
	'password' => '',
	'db' => 'eve_seller',
	'charset' => 'utf8',
);

$GLOBALS['config']['charset'] = 'UTF-8';

//enable/disable debug
$GLOBALS['config']['debug'] = true;
$GLOBALS['config']['debugSmarty'] = false;

//paths
$GLOBALS['config']['dir_ws'] = 'http://localhost/eve_seller';
$GLOBALS['config']['dir_ws_index'] = 'http://localhost/eve_seller/index.php';

$GLOBALS['config']['migrations_dir'] = 'eve_seller/db_migrations/files';
$GLOBALS['config']['dir_ws_migrations'] = 'http://localhost/eve_seller/db_migrations';

//autoload for Pheal
//require_once(__DIR__.'/Pheal/Pheal.php');
//spl_autoload_register("Pheal::classload");
//PhealConfig::getInstance()->api_base = 'https://api.eveonline.com/';
//PhealConfig::getInstance()->http_ssl_verifypeer = false;
