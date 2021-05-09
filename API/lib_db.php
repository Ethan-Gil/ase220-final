<?php

// Local XAMPP Database
// $host = '127.0.0.1';
// $db = 'shelter_website';
// $user = 'root';
// $pass = '';
// $charset = 'utf8';
// $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
// $opt = [
// 	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
// 	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
// 	PDO::ATTR_EMULATE_PREPARES => false,
// ];

// mysql://bb02fa357f9713:980bacc3@us-cdbr-east-03.cleardb.com/heroku_9051e5a2bcb25e8?reconnect=true

// Remote Heroku Database
$host = 'us-cdbr-east-03.cleardb.com';
$db = 'heroku_9051e5a2bcb25e8';
$user = 'bb02fa357f9713';
$pass = '980bacc3';
$charset = 'utf8';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	PDO::ATTR_EMULATE_PREPARES => false,
];

$pdo = new PDO($dsn, $user, $pass, $opt);


