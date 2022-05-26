<?php
$email = 'xfrandofer@stuba.sk';
$host = "db";
$port = "3306";
$db = "mysql_db";
$user = "root";
$password = "root";
$charset = "utf8";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";
$options = [
  \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
  \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
  \PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
  $conn = new PDO($dsn, $user, $password, $options);
} catch (Exception $e) {
   echo json_encode($e->getMessage());
}