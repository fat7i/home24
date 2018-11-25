<?php
/**
 * DO NOT judge this file,
 * i made it to make your life easier :)
 *
 */
require_once "config.php";
require_once __DIR__ . "/../helpers/functions.php";


$server = config('db.server');
$dbName = config('db.dbname');
$dbUser = config('db.dbuser');
$dbPassword = config('db.dbpassword');


$pdo = new PDO('mysql:host='.$server.';dbname='. $dbName, $dbUser, $dbPassword);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = file_get_contents(__DIR__."/database_dump.sql");

$pdo->query($sql);

echo "Database Schema Created Successfully!";

