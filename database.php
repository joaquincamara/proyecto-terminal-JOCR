<?php

// Production
/*

$server = 'localhost';
$username = 'id12754084_joaquincamara';
$password = 'Joaquincr1';
$database = 'id12754084_users';
*/

// Develop
$server = 'localhost:8889';
$username = 'root';
$password = 'root';
$database = 'tarea';



try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);


  session_start();

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, name, email, fatherLastName, motherLastName, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $inicio = null;

    if (count($results) > 0) {
      $inicio = $results;
    }
  }
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}

?>
