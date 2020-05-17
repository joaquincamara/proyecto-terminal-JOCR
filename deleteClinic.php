<?php

  require 'database.php';
  
  $id = $_GET['id'];
  print_r(id);
  $messageDeleteClinic = '';
  print_r($id);
  $deleteClinic = $conn->prepare('DELETE FROM clinic WHERE id=:id');
  $deleteClinic->bindParam(':id', $id,PDO::PARAM_INT);
  $deleteClinic->execute();
 // $results = $records->fetch(PDO::FETCH_ASSOC);
   
  if ($deleteClinic->execute()) {
    $messageDeleteClinic = 'Successfully deleted Clinic';
    header('Location: /proyecto_termina_I/clinicsManagement.php');
  } else {
    $messageDeleteClinic = 'Sorry there must have been an issue creating your client';
  }

?>