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
    <title>SignUp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">

  </head>
<body>
  <?php require 'partials/header.php' ?>

  <?php if(!empty($message)): ?>
    <p> <?= $message ?></p>
  <?php endif; ?>

  <?php if(!empty($clients)): ?>

  <div class="dashboardContainer">
    <div class="tableContainer">
      <table id="clients-table">
        <thead>
          <tr>
            <th scope="col">Specialists</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            while($row = $specialistRecords->fetch(PDO::FETCH_ASSOC))
              {
                echo "<tr>";
                echo "<td>".$row['name']." ".$row['fatherLastName']." ".$row['motherLastName']."</td>";
                echo "</tr>";
              }
           ?>
        </tbody>
        </table>
    </div>
    <?php endif; ?>

    <div class="specialistRegistry">
      <h1>Specialist registry</h1>
      <form action="superAdminDashboard.php" method="POST">
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
  </div>
</body>
</html>