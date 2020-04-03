<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO clinic (email, password, name, address, rfc, phone) VALUES (:email, :password, :name, :address, :rfc, :phone)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':address', $_POST['address']);
    $stmt->bindParam(':rfc', $_POST['rfc']);
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
            while($row = $clinicRecords->fetch(PDO::FETCH_ASSOC))
              {
                echo "<tr>";
                echo "<td>".$row['name']."</td>";
                echo "</tr>";
              }
           ?>
        </tbody>
        </table>
    </div>
    <?php endif; ?>

    <div class="specialistRegistry">
      <h1>Clinics registry</h1>
      <form action="clinicsAdminDasboard.php" method="POST">
        <input name="name" type="text" placeholder="Clinic name">
        <input name="address" type="text" placeholder="Clinic address">
        <input name="rfc" type="text" placeholder="RFC">
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