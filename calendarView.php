<?php require 'database.php'; 
    $message = '';

    if (!empty($_POST['personToScheduleDate']) && !empty($_POST['email'])) {
      $sql = "INSERT INTO meets (personToScheduleDate, scheduleTime, email, scheduleDate, specifications) VALUES (:personToScheduleDate, :scheduleTime, :email, :scheduleDate, :specifications)";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':personToScheduleDate', $_POST['personToScheduleDate']);
      $stmt->bindParam(':scheduleTime', $_POST['scheduleTime']);
      $stmt->bindParam(':email', $_POST['email']);
      $stmt->bindParam(':scheduleDate', $_POST['scheduleDate']);
      $stmt->bindParam(':specifications', $_POST['specifications']);
     header('Location: /proyecto_termina_I/calendarView.php');
      //  header('Location: https://proyecto-terminal-jocr.000webhostapp.com/calendarView.php');
      if (!$stmt->execute()) {
          $message = 'Lo sentimos tuvimos problemas creado tu cita';
        }
   }
?>
<html>
<head>   
<meta charset="utf-8">
    <title>S.I.C.E.</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
<?php require 'partials/header.php' ?>
<?php if(!empty($message)): ?>
    <p> <?= $message ?></p>
  <?php endif; ?>

  <div class="calendarAndScheduleContainer">

    <div class="scheduleCreatorAndTableContainer">
      <div class="scheduleCreator">
        <form  action="calendarView.php"  method="POST">
          <div class="clientRegistryTextareaSection">
            <input required id="personToScheduleDate" placeholder="Agendar cita con:" name="personToScheduleDate" type="text" >
            <input required id="scheduleTime" placeholder="Horario de cita" name="scheduleTime" type="text"  >
            <input required pattern="^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$" id="email" placeholder="Correo electrónico" name="email" type="text" >
            <input required id="scheduleDate" placeholder="Fecha de cita" name="scheduleDate" type="text" >
            <textarea required id="specifications" placeholder="Especificaciones" name="specifications"  rows="4"></textarea>  
            <input  type="submit" value="Guardar y enviar cita">
          </div>
        </form>
      </div>

      <?php if(!empty($meets)): ?>
      <div class="meetsTableContainer">
      <table id="clients-table">
        <thead>
          <tr>
            <th scope="col">Citas</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            while($row = $meetsRecords->fetch(PDO::FETCH_ASSOC))
              {
          ?>
                <tr>
                  <td>
                    <div>
                      <p><?php echo $row['personToScheduleDate']; ?></p>
                      <p>Fecha: <?php echo $row['scheduleDate']; ?></p>
                    </div>
                    <div>
                    <a class="editTableButton" href="editMeet.php?id=<?php echo $row['id']; ?>">Editar</a>
                      <a class="DeleteTableButton" href="deleteMeet.php?id=<?php echo $row['id']; ?>">Borrar</a>
                    </div>
                  </td>
                </tr>
          <?php 
              } 
          ?>
        </tbody>
        </table>
        <div class="pagination">
         <a href="#">&laquo;</a>
          <a href="#" class="active"> 1</a>
          <a href="#" >2</a>
          <a href="#">3</a>
          <a href="#">4</a>
          <a href="#">5</a>
          <a href="#">6</a>
          <a href="#">&raquo;</a>
        </div>
    </div>
    <?php endif; ?>
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