<?php

  require 'database.php';
  
  $id = $_GET['id'];
  print_r(id);
  $messageDeleteSpecialist = '';
  print_r($id);
  $deleteSpecialist = $conn->prepare('DELETE FROM users WHERE id=:id');
  $deleteSpecialist->bindParam(':id', $id,PDO::PARAM_INT);
  $deleteSpecialist->execute();
 // $results = $records->fetch(PDO::FETCH_ASSOC);
   
  if ($deleteSpecialist->execute()) {
    $messageDeleteSpecialist = 'Successfully deleted Clinic';
    header('Location: /proyecto_termina_I/specialistManagement.php');
  } else {
    $messageDeleteSpecialist = 'Sorry there must have been an issue creating your client';
  }

?>