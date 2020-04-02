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
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>

    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>
    <div class="signUpCard">
      <h1>SignUp</h1>
      <span>or <a href="index.php">Login</a></span>
      <form action="signup.php" method="POST">
        <input name="name" type="text" placeholder="Enter your name">
        <input name="fatherLastName" type="text" placeholder="Enter your father Lastname">
        <input name="motherLastName" type="text" placeholder="Enter your mother Lastname">
        <input name="phone" type="text" placeholder="Enter your phone">
        <input name="email" type="text" placeholder="Enter your email">
        <input name="password" type="password" placeholder="Enter your Password">
        <input name="confirm_password" type="password" placeholder="Confirm Password">
        <input type="submit" value="Submit">
      </form>
    </div>
  </body>
</html>
