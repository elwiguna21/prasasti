<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once BASEPATH.'dotenv/autoloader.php';
$dotenv = new Dotenv\Dotenv(FCPATH);
$dotenv->load();

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => getenv('DB_HOSTNAME'),
	'username' => getenv('DB_USERNAME'),
	'password' => getenv('DB_PASSWORD'),
	'database' => getenv('DB_DATABASENAME'),
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
