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

    if(empty($_POST['g-recaptcha-response']))
 {
  $captcha_error = 'Captcha is required';
 }
 else
 {
  $secret_key = '6Ldv2bcUAAAAAFXUKdLW_qljFd9FpxNguf06DHhp';

  $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']);

  $response_data = json_decode($response);

  if(!$response_data->success)
  {
   $captcha_error = 'Captcha verification failed';
  }
 }

    if ($stmt->execute()) {
      $message = 'Successfully created new user. Go to Login to start the magic!!!';
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
  
    <link rel="stylesheet" href="assets/css/style.css">


  </head>
  <body>

    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>SignUp</h1>
    <span>or <a href="login.php">Login</a></span>

    <form action="signup.php" method="POST">
    <select class="selectCourse">
        <option value="volvo">Selecciona un curso</option>
        <option value="saab">Curso intensivo de Javascript</option>
      </select>
      <input name="name" type="text" placeholder="Enter your name">
      <input name="fatherLastName" type="text" placeholder="Enter your father Lastname">
      <input name="motherLastName" type="text" placeholder="Enter your mother Lastname">
      <input name="phone" type="text" placeholder="Enter your phone">
      <input name="email" type="text" placeholder="Enter your email">
      <input name="password" type="password" placeholder="Enter your Password">
      <input name="confirm_password" type="password" placeholder="Confirm Password">
      <div class="g-recaptcha" data-sitekey="6LfevOMUAAAAANm2Xc18RmuPsULMY1-CLTW0whN9"></div>
      <input type="submit" value="Submit">
    </form>

  </body>
</html>
