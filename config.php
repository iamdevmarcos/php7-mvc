<?php

require 'vendor/autoload.php';
require 'environment.php';

$config = array();
if(ENVIRONMENT == 'development') {
	define("BASE_URL", "http://localhost/mvc/");
	$config['dbname'] = 'loja01';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
} else {
	define("BASE_URL", "https://www.meusite.com.br/");
	$config['dbname'] = 'DB_NAME';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'USER';
	$config['dbpass'] = 'PASS';
}

global $db;
try {
	$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass'], array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
	echo "ERRO: ".$e->getMessage();
	exit;
}