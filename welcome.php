<?php


  require 'database.php';


?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome to you WebApp</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
 
    <link rel="stylesheet" href="assets/css/style.css">

 
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($inicio)): ?>
      <br> Welcome. 
        <?= 
          $inicio['name'];
          print_r("\n");
         print_r($inicio['fatherLastName']);
         print_r("\n");
         print_r($inicio['motherLastName']);         
        ?>
        <br><?php 
         print_r('Cursos registrados: Curso intensivo de Javascript');?>
      <br>You are Successfully Logged In use the top nav to visit all our pages
      <a href="logout.php">
        Logout
      </a>
    <?php else: ?>
      <h1>Please Login or SignUp</h1>
    <?php endif; ?>
  </body>
</html>
