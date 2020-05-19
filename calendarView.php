<?php require 'database.php'; ?>
<html>
<head>   
<meta charset="utf-8">
    <title>S.I.C.E.</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
<?php require 'partials/header.php' ?>
  <div class="calendarAndScheduleContainer">
    <div class="scheduleCreatorAndTableContainer">
      <div class="clientRegistryContainer">
        <form  method="POST">
          <div class="clientRegistryInputsSection">
            <div class="clientRegistryInputsSection-box1">
              <input required id="completeName" placeholder="Nombre completo" name="completeName" type="text" >
              <input required id="startTreatmentDate" placeholder="Inicio de tratamiento" name="startTreatmentDate" type="text"  >
            </div>
            <div class="clientRegistryInputsSection-box2">
            <input required pattern="^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$" id="email" placeholder="Correo electrónico" name="email" type="text" id="email" >
              <input required id="endTreatmentDate" placeholder="Fin de tratamiento" name="endTreatmentDate" type="text" >
            </div>
          </div>
          <div class="clientRegistryTextareaSection">
          <textarea required id="prescriptionDrugs" placeholder="Medicamentos" name="prescriptionDrugs"  rows="8"></textarea>  
            <input required type="submit" value="Guardar cliente">
          </div>
        </form>
      </div>

    </div>

    <div class="calendarContainer">
      <?php
        include 'calendar.php';
        $calendar = new Calendar();
        echo $calendar->show();
      ?>
    </div>
  </div>
</body>
</html> 