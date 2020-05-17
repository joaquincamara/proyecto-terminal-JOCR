<?php


  if (isset($_SESSION['user_id'])) {
   // production 
   // header('Location: https://proyecto-terminal-jocr.000webhostapp.com/');
   // Develop

   header('Location: /proyecto_termina_I/');

  }
  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
   // production 
  // header('Location: https://proyecto-terminal-jocr.000webhostapp.com/clientsManagement.php');
   // Develop

   header('Location: /proyecto_termina_I/clientsManagement.php');

    } else {
      $message = 'Sorry, those credentials do not match';
    }
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>
    
    <div class="appContainer">
      <div class="loginCard">
        <h1>Login</h1>
        <span>or <a href="signup.php">SignUp</a></span>
        <form action="index.php" method="POST">
          <input name="email" type="text" placeholder="Enter your email">
          <input name="password" type="password" placeholder="Enter your Password">
          <input type="submit" value="Submit">
        </form>
      </div>
    </div>
  </body>
</html>
