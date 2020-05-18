<?php

  require 'database.php';

  $message = '';
  $id = $_GET['id'];
  $clinicToEditRecord = $conn ->prepare('SELECT * FROM clinic WHERE id=:id');
  $clinicToEditRecord->bindParam(':id', $id,PDO::PARAM_INT);
  $clinicToEditRecord->execute();

?>


<!DOCTYPE html>
<html lang="en">
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

  <?php if(!empty($clinics)): ?>

  <div class="dashboardContainer">
    <div class="tableContainer">
      <table id="clients-table">
        <thead>
          <tr>
            <th scope="col">Clínicas</th>
          </tr>
        </thead>
        <tbody>
        <?php 
            while($row = $clinicRecords->fetch(PDO::FETCH_ASSOC))
              {
          ?>
                <tr>
                  <td>  
                    <?php echo $row['name']; ?> 
                    <a href="deleteClinic.php?id=<?php echo $row['id']; ?>">Borrar</a>
                    <a href="editClinic.php?id=<?php echo $row['id']; ?>">Editar</a>
                    </td>
                </tr>
          <?php 
              } 
          ?>
        </tbody>
        </table>
    </div>
    <?php endif; ?>

    <div class="specialistRegistry">
    <?php if(!empty($clinicToEditRecord)): ?>
    <?php 
            while($clinicToResult = $clinicToEditRecord->fetch(PDO::FETCH_ASSOC))
              {
          ?>
      <form>
      <input type="hidden" name="id" value="<?php echo $clinicToResult['id'] ?>">
        <input value="<?php echo $clinicToResult['name'] ?>" id='name' name="name" type="text" placeholder="Nombre de la clínica" required>
        <input value="<?php echo $clinicToResult['address'] ?>" id='address' name="address" type="text" placeholder="Direccíon" required>
        <input value="<?php echo $clinicToResult['rfc'] ?>" id='rfc' name="rfc" type="text" placeholder="RFC" required>
        <input value="<?php echo $clinicToResult['phone'] ?>" id="phone" name="phone" type="text" placeholder="Teléfono" required>
        <input value="<?php echo $clinicToResult['email'] ?>" pattern="^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$"  id="email" name="email" type="text" placeholder="Correo electrónico" required>
        <input type="submit" value="Enviar correo para editar constraseña">
        <input type="submit" value="Guardar Clínica">
      </form>
      <?php 
              } 
        ?>
    <?php endif; ?>

    <?php
      $id = $_GET['id'];
      $name = $_GET['name'];
      $address = $_GET['address'];
      $rfc = $_GET['rfc'];
      $phone = $_GET['phone'];
      $email = $_GET['email'];

      if($name != null) {
      $editSpecialist = $conn->prepare('UPDATE clinic SET name=:name, address=:address, rfc=:rfc, phone=:phone, email=:email  WHERE id=:id');
      $editSpecialist->bindParam(':id', $id,PDO::PARAM_INT);
      $editSpecialist->bindParam(':name', $name);
      $editSpecialist->bindParam(':address', $address);
      $editSpecialist->bindParam(':rfc', $rfc);
      $editSpecialist->bindParam(':phone', $phone);
      $editSpecialist->bindParam(':email', $email);
      if ($editSpecialist->execute()) {
     //header('Location: /proyecto_termina_I/clinicsManagement.php');
        header('Location: https://proyecto-terminal-jocr.000webhostapp.com/clinicsManagement.php');
      }
      } 
    ?>
    </div>
  </div>

  <script src="validateForms.js"></script>
</body>
</html>