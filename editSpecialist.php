<?php

  require 'database.php';

  $message = '';
  $id = $_GET['id'];
  $specialisToEditRecord = $conn ->prepare('SELECT * FROM users WHERE id=:id');
  $specialisToEditRecord->bindParam(':id', $id,PDO::PARAM_INT);
  $specialisToEditRecord->execute();

  if (!empty($_POST)) {

    $nameToEdit = $_POST['txtName'];
    $fatherLastNameToEdit = $_POST['txtFatherLastName'];
    $motherLastNameToEdit = $_POST['txtMotherLastName'];
    $phoneToEdit = $_POST['txtPhone'];
    $emailToEdit = $_POST['txtEmail'];

    if($nameToEdit != null) {
    $editSpecialist = $conn->prepare('UPDATE users SET name=:name, fatherLastName=:fatherLastName, motherLastName=:motherLastName, phone=:phone, email=:email  WHERE id=:id');
    $editSpecialist->bindParam(':id', $id,PDO::PARAM_INT);
    $editSpecialist->bindParam(':name', $nameToEdit);
    $editSpecialist->bindParam(':fatherLastName', $fatherLastNameToEdit);
    $editSpecialist->bindParam(':motherLastName', $motherLastNameToEdit);
    $editSpecialist->bindParam(':phone', $phoneToEdit);
    $editSpecialist->bindParam(':email', $emailToEdit);
    if ($editSpecialist->execute()) {
     header('Location: /proyecto_termina_I/specialistManagement.php');
    //   header('Location: https://proyecto-terminal-jocr.000webhostapp.com/specialistManagement.php');
    }
    } 
  }

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
                    <div>
                      <p><?php echo $row['name']; ?> <?php echo $row['fatherLastName']; ?> <?php echo $row['motherLastName']; ?> </p>
                    </div>  
                    <div>
                      <a class="editTableButton" href="editSpecialist.php?id=<?php echo $row['id']; ?>">Editar</a>
                      <a class="DeleteTableButton" href="deleteSpecialist.php?id=<?php echo $row['id']; ?>">Borrar</a>                     
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

    <div class="specialistRegistry">
    <?php if(!empty($specialisToEditRecord)): ?>
    <?php 
            while($specialisToResult = $specialisToEditRecord->fetch(PDO::FETCH_ASSOC))
              {
          ?>
      <form method="POST">
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

    </div>
  </div>

  <script src="validateForms.js"></script>
</body>
</html>