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
      $message = 'Successfully created new user. Go to Login to start the magic!!!';
      mail($_POST['email'],'Registro en S.I.C.E.',$message);

    } else {
      $message = 'Sorry there must have been an issue creating your account';
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

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>
    <div class="appContainer">
      <div class="signUpCard">
        <h1>SignUp</h1>
        <span>o <a href="index.php">Login</a></span>
        <form onsubmit="return formSignInValidations();" action="signup.php" method="POST">
          <input id="name"  name="name" type="text" placeholder="Nombre" required>
          <input id="fatherLastName" name="fatherLastName" type="text" placeholder="Apellido paterno" required>
          <input id="motherLastName" name="motherLastName" type="text" placeholder="Apellido materno" required>
          <input id="phone" name="phone" type="text" placeholder="Teléfono" required>
          <input pattern="^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$"  id="email" name="email" type="text" placeholder="Correo electrónico" required>
          <input id="password" name="password" type="password" placeholder="Constraseña" required>
          <input id="confirm_password" name="confirm_password" type="password" placeholder="Confirmar constraseña"required>
          <input type="submit" value="Registrar">
        </form>
      </div>
    </div>

    <script src="validateForms.js"></script>
  </body>
</html>
