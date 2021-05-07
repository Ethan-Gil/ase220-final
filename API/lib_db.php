<?php

// Local XAMPP Database
$host = '127.0.0.1';
$db = 'shelter_website';
$user = 'root';
$pass = '';
$charset = 'utf8';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	PDO::ATTR_EMULATE_PREPARES => false,
];


// Remote Heroku Database
// $host = 'us-cdbr-east-03.cleardb.com';
// $db = 'heroku_4a2511169c1c192';
// $user = 'b5be0be5437a3d';
// $pass = 'f0358669';
// $charset = 'utf8';
// $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
// $opt = [
// 	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
// 	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
// 	PDO::ATTR_EMULATE_PREPARES => false,
// ];

$pdo = new PDO($dsn, $user, $pass, $opt);


