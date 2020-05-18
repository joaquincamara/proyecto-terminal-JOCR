<?php

  require 'database.php';

  $message = '';
  $id = $_GET['id'];
  $specialisToEditRecord = $conn ->prepare('SELECT * FROM users WHERE id=:id');
  $specialisToEditRecord->bindParam(':id', $id,PDO::PARAM_INT);
  $specialisToEditRecord->execute();

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

  <?php if(!empty($specialistRecords)): ?>

  <div class="dashboardContainer">
    <div class="tableContainer">
      <table id="clients-table">
        <thead>
          <tr>
            <th scope="col">Especialista</th>
          </tr>
        </thead>
        <tbody>
        <?php 
            while($row = $specialistRecords->fetch(PDO::FETCH_ASSOC))
              {
          ?>
                <tr>
                  <td>  
                    <?php echo $row['name']; ?> <?php echo $row['fatherLastName']; ?> 
                    <?php echo $row['motherLastName']; ?> 
                    <a href="deleteSpecialist.php?id=<?php echo $row['id']; ?>">Borrar</a> 
                    <a href="editSpecialist.php?id=<?php echo $row['id']; ?>">Editar</a>
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
    <?php if(!empty($specialisToEditRecord)): ?>
    <?php 
            while($specialisToResult = $specialisToEditRecord->fetch(PDO::FETCH_ASSOC))
              {
          ?>
      <form >
        <input type="hidden" name="txtId" value="<?php echo $specialisToResult['id'] ?>">
        <input value="<?php echo $specialisToResult['name'] ?>" id="name"  name="txtName" type="text" placeholder="Nombre" required>
        <input value="<?php echo $specialisToResult['fatherLastName'] ?>" id="fatherLastName" name="txtFatherLastName" type="text" placeholder="Apellido paterno" required>
        <input value="<?php echo $specialisToResult['motherLastName'] ?>" id="motherLastName" name="txtMotherLastName" type="text" placeholder="Apellido materno" required>
        <input value="<?php echo $specialisToResult['phone'] ?>" id="phone" name="txtPhone" type="text" placeholder="Teléfono" required>
        <input value="<?php echo $specialisToResult['email'] ?>" pattern="^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$"  id="email" name="txtEmail" type="text" placeholder="Correo electrónico" required>
        <input type="submit" value="Enviar correo para editar constraseña">
        <input type="submit" value="Guardar especialista">
      </form>

    <?php 
              } 
        ?>
    <?php endif; ?>

    <?php
      $idToEdit = $_GET['txtId'];
      $nameToEdit = $_GET['txtName'];
      $fatherLastNameToEdit = $_GET['txtFatherLastName'];
      $motherLastNameToEdit = $_GET['txtMotherLastName'];
      $phoneToEdit = $_GET['txtPhone'];
      $emailToEdit = $_GET['txtEmail'];

      if($nameToEdit != null) {
      $editSpecialist = $conn->prepare('UPDATE users SET name=:name, fatherLastName=:fatherLastName, motherLastName=:motherLastName, phone=:phone, email=:email  WHERE id=:id');
      $editSpecialist->bindParam(':id', $idToEdit,PDO::PARAM_INT);
      $editSpecialist->bindParam(':name', $nameToEdit);
      $editSpecialist->bindParam(':fatherLastName', $fatherLastNameToEdit);
      $editSpecialist->bindParam(':motherLastName', $motherLastNameToEdit);
      $editSpecialist->bindParam(':phone', $phoneToEdit);
      $editSpecialist->bindParam(':email', $emailToEdit);
      if ($editSpecialist->execute()) {
      // header('Location: /proyecto_termina_I/specialistManagement.php');
         header('Location: https://proyecto-terminal-jocr.000webhostapp.com/specialistManagement.php');
      }
      } 
    ?>
    </div>
  </div>

  <script src="validateForms.js"></script>
</body>
</html>