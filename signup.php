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
      mail('joaquin.camara.rivera@gmail.com','prueba undam',$message);
    } else {
      $message = 'Sorry there must have been an issue creating your account';
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SignUp</title>
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
        <span>or <a href="index.php">Login</a></span>
        <form onsubmit="return formSignInValidations();" action="signup.php" method="POST" required>
          <input id="name"  name="name" type="text" placeholder="Ingresa un nombre" required>
          <input id="fatherLastName" name="fatherLastName" type="text" placeholder="Ingresa el primer apellido" required>
          <input id="motherLastName" name="motherLastName" type="text" placeholder="Ingresa el segundo apellido" required>
          <input id="phone" name="phone" type="text" placeholder="Enter your phone" required>
          <input pattern="^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$" title="Ingresa un correo valido." id="email" name="email" type="text" placeholder="Ingresa un corrreo electronico" required>
          <input id="password" name="password" type="password" placeholder="Ingresa una constraseña" required>
          <input id="confirm_password" name="confirm_password" type="password" placeholder="Ingresa una constraseña"required>
          <input type="submit" value="Registrar">
        </form>
      </div>
    </div>

    <script src="validateForms.js"></script>
  </body>
</html>
