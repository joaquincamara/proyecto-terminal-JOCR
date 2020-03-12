<?php

$server = 'localhost';
$username = 'id12754084_joaquincamara';
$password = 'Joaquincr1';
$database = 'id12754084_users';

try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}

?>
