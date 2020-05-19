<?php 
    require 'database.php'; 
    include 'calendar.php';
    $message = '';

    $id = $_GET['id'];
    $meetToEditRecord = $conn ->prepare('SELECT * FROM meets WHERE id=:id');
    $meetToEditRecord->bindParam(':id', $id,PDO::PARAM_INT);
    $meetToEditRecord->execute();

    if (!empty($_POST)) {

      $personToScheduleDate = $_POST['personToScheduleDate'];
      $scheduleTime = $_POST['scheduleTime'];
      $email = $_POST['email'];
      $scheduleDate = $_POST['scheduleDate'];
      $specifications = $_POST['specifications'];

      if ($personToScheduleDate != null) {
        $meetToEdit = "UPDATE meets SET personToScheduleDate=:personToScheduleDate, scheduleTime=:scheduleTime, email=:email, scheduleDate=:scheduleDate, specifications=:specifications WHERE id=:id";
        $meetToEdit = $conn->prepare($meetToEdit);
        $meetToEdit->bindParam(':id', $id,PDO::PARAM_INT);
        $meetToEdit->bindParam(':personToScheduleDate', $_POST['personToScheduleDate']);
        $meetToEdit->bindParam(':scheduleTime', $_POST['scheduleTime']);
        $meetToEdit->bindParam(':email', $_POST['email']);
        $meetToEdit->bindParam(':scheduleDate', $_POST['scheduleDate']);
        $meetToEdit->bindParam(':specifications', $_POST['specifications']);

        if ($meetToEdit->execute()) {
         header('Location: /proyecto_termina_I/calendarView.php');
        //  header('Location: https://proyecto-terminal-jocr.000webhostapp.com/calendarView.php');
          }
      }

   }

?>
<!DOCTYPE html>
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
      <div class="scheduleCreator">
      <?php if(!empty($meetToEditRecord)): ?>
        <?php 
            while($meetToResult = $meetToEditRecord->fetch(PDO::FETCH_ASSOC))
              {
        ?>
        <form method="POST">
          <div class="clientRegistryTextareaSection">
          <input type="hidden" name="id" value="<?php echo $meetToResult['id'] ?>">
            <input value="<?php echo $meetToResult['personToScheduleDate'] ?>"  required id="personToScheduleDate" placeholder="Agendar cita con:" name="personToScheduleDate" type="text" >
            <input value="<?php echo $meetToResult['scheduleTime'] ?>" required id="scheduleTime" placeholder="Horario de cita" name="scheduleTime" type="text"  >
            <input value="<?php echo $meetToResult['email'] ?>" required pattern="^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$" id="email" placeholder="Correo electrónico" name="email" type="text" >
            <input value="<?php echo $meetToResult['scheduleDate'] ?>" required id="scheduleDate" placeholder="Fecha de cita" name="scheduleDate" type="text" >
            <textarea required id="specifications" placeholder="Especificaciones" name="specifications"  rows="4"><?php echo $meetToResult['specifications'] ?></textarea>  
            <input  type="submit" value="Guardar y enviar cita">
          </div>
        </form>
        <?php 
              } 
        ?>
    <?php endif; ?>
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
        $calendar = new Calendar();
        echo $calendar->show();
      ?>
    </div>
  </div>
</body>
</html> 