<?php

  require 'database.php';

  $message = '';

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

    if ($stmt->execute()) {
      $message = 'Successfully created new specialist';
    } else {
      $message = 'Sorry there must have been an issue creating the account';
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
                  <td>  <?php echo $row['name']; ?> <?php echo $row['fatherLastName']; ?> <?php echo $row['motherLastName']; ?> <a href="deleteSpecialist.php?id=<?php echo $row['id']; ?>">Borrar</a></td>
                </tr>
          <?php 
              } 
          ?>
        </tbody>
        </table>
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