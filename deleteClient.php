<?php

  require 'database.php';
  
  $id = $_GET['id'];
  $messagedeleteClient = '';
  print_r($id);
  $deleteClient = $conn->prepare('DELETE FROM clients WHERE id=:id');
  $deleteClient->bindParam(':id', $id,PDO::PARAM_INT);
  $deleteClient->execute();
 // $results = $records->fetch(PDO::FETCH_ASSOC);
   
  if ($deleteClient->execute()) {
    $messagedeleteClient = 'Successfully deleted client';
    header('Location: /proyecto_termina_I/clientsManagement.php');
    // header('Location: https://proyecto-terminal-jocr.000webhostapp.com/clientsManagement.php');
  } else {
    $messagedeleteClient = 'Sorry there must have been an issue creating your client';
  }

  print_r($messagedeleteClient);

?>