<?
//Настройки подключения к БД
$db_host = 'localhost';
$db_db   = 'beejee';
$db_user = 'mysql';
$db_pass = 'mysql';
$db_charset = 'utf8';
$db_opt = [
	PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	PDO::ATTR_EMULATE_PREPARES   => false,
];