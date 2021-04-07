<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbName = "fixture";

try {
   $connection = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
   $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
   echo "Failed to connect to database " . $e->getMessage();
}
