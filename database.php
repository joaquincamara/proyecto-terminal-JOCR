<?php

// Production


$server = 'localhost';
$username = 'id12895322_proyectofinal';
$password = 'Joaquincr__123';
$database = 'id12895322_proyectoterminal';



// Develop
//$server = 'localhost:8889';
//$username = 'root';
//$password = 'root';
//$database = 'tarea';



try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);


  session_start();

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, name, email, fatherLastName, motherLastName, password, usertype FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $inicio = null;
    $clients = null;
    $specialists = null;
    $clinics = null;

    $clientRecords = $conn ->prepare('SELECT completeName, reasonForVisit, id FROM clients');
    $clientRecords->execute();
    $clientResults = $clientRecords->fetch(PDO::FETCH_ASSOC);


    $type = "specialist";
    $specialistRecords = $conn ->prepare('SELECT name, fatherLastName, motherLastName, id FROM users WHERE usertype = :usertype');
    $specialistRecords->bindParam(':usertype', $type);
    $specialistRecords->execute();
    $specialistResults = $specialistRecords->fetch(PDO::FETCH_ASSOC);

    $clinicRecords = $conn ->prepare('SELECT name, id FROM clinic');
    $clinicRecords->execute();
    $clinicResults = $clinicRecords->fetch(PDO::FETCH_ASSOC);


    if (count($results)> 0 && count($clientResults) > 0) {
      $inicio = $results;
      $clients = $clientResults;
      $specialists = $specialistResults;
      $clinics = $clinicResults;
    }
  }
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage()) ;
}

?>
