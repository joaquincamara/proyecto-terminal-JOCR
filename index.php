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

  //header('Location: https://proyecto-terminal-jocr.000webhostapp.com/clientsManagement.php');


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
        <span>o <a href="signup.php">SignUp</a></span>
        <form onsubmit="return loginValitadion();" action="index.php" method="POST">
          <input id="email"  name="email" type="text" placeholder="Correo electrónico" pattern="^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$" required>
          <input id="password" name="password" type="password" placeholder="Constraseña" required>
          <input type="submit" value="Ingresar">
        </form>
      </div>
    </div>

    <script src="validateForms.js"></script>
  </body>
</html>