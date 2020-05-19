<?php

  require 'database.php';
  
  $id = $_GET['id'];

  $messageDeleteMeet = '';

  $deleteClinic = $conn->prepare('DELETE FROM meets WHERE id=:id');
  $deleteClinic->bindParam(':id', $id,PDO::PARAM_INT);
  //$deleteClinic->execute();
 // $results = $records->fetch(PDO::FETCH_ASSOC);
   
  if ($deleteClinic->execute()) {
  //  $messageDeleteMeet = 'Successfully deleted Clinic';
    header('Location: /proyecto_termina_I/calendarView.php');
   //     header('Location: https://proyecto-terminal-jocr.000webhostapp.com/calendarView.php');
  } else {
    $messageDeleteMeet = 'Tuvimos problemas borrando su cita intente de nuevo';
  }

?>