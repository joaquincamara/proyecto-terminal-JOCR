<?php

  require 'database.php';

  $message = '';
  $onEdit = false;

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO users (email, password, name, fatherLastName, motherLastName, phone) VALUES (:email, :password, :name, :fatherLastName, :motherLastName, :phone)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':fatherLastName', $_POST['fatherLastName']);
    $stmt->bindParam(':motherLastName', $_POST['motherLastName']);
    $stmt->bindParam(':phone', $_POST['phone']);
    header('Location: /proyecto_termina_I/specialistManagement.php');
    //   header('Location: https://proyecto-terminal-jocr.000webhostapp.com/specialistManagement.php');
    if (!$stmt->execute()) {
      $message = 'Lo sentimos, tuvimos problemas al crear al especialista';
    }
  }


function editSpecialist() {
  $onEdit = true;
  if ($onEdit == true) {

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
      <form onsubmit="return formSignInValidations();" action="specialistManagement.php" method="POST">
      <input id="name"  name="name" type="text" placeholder="Nombre" required>
          <input id="fatherLastName" name="fatherLastName" type="text" placeholder="Apellido paterno" required>
          <input id="motherLastName" name="motherLastName" type="text" placeholder="Apellido materno" required>
          <input id="phone" name="phone" type="text" placeholder="Teléfono" required>
          <input pattern="^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$"  id="email" name="email" type="text" placeholder="Correo electrónico" required>
          <input id="password" name="password" type="password" placeholder="Constraseña" required>
          <input id="confirm_password" name="confirm_password" type="password" placeholder="Confirmar constraseña"required>
          <input type="submit" value="Guardar especialista">
      </form>
    </div>
  </div>

  <script src="validateForms.js"></script>
</body>
</html>