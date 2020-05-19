<?php

  require 'database.php';
  
  $id = $_GET['id'];

  $messageDeleteClinic = '';

  $deleteClinic = $conn->prepare('DELETE FROM clinic WHERE id=:id');
  $deleteClinic->bindParam(':id', $id,PDO::PARAM_INT);
  //$deleteClinic->execute();
 // $results = $records->fetch(PDO::FETCH_ASSOC);
   
  if ($deleteClinic->execute()) {
//$messageDeleteClinic = 'Successfully deleted Clinic';
    header('Location: /proyecto_termina_I/clinicsManagement.php');
   //     header('Location: https://proyecto-terminal-jocr.000webhostapp.com/clinicsManagement.php');
  } else {
    $messageDeleteClinic = 'Tuvimos problemas borrando su clinica intente de nuevo';
  }

?>