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
    <title>S.I.C.E.</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">

  </head>
<body>
  <?php require 'partials/header.php' ?>

  <?php if(!empty($message)): ?>
    <p> <?= $message ?></p>
  <?php endif; ?>

  <?php if(!empty($clinics)): ?>

  <div class="dashboardContainer">
    <div class="tableContainer">
      <table id="clients-table">
        <thead>
          <tr>
            <th scope="col">Clínicas</th>
          </tr>
        </thead>
        <tbody>
        <?php 
            while($row = $clinicRecords->fetch(PDO::FETCH_ASSOC))
              {
          ?>
                <tr>
                  <td>  <?php echo $row['name']; ?> <a href="deleteClinic.php?id=<?php echo $row['id']; ?>">Borrar</a></td>
                </tr>
          <?php 
              } 
          ?>
        </tbody>
        </table>
    </div>
    <?php endif; ?>

    <div class="specialistRegistry">
      <form onsubmit="return clinicFunctionValidation();" action="clinicsManagement.php" method="POST" required>
        <input id='name' name="name" type="text" placeholder="Nombre de la clínica" required>
        <input id='address' name="address" type="text" placeholder="Direccíon" required>
        <input id='rfc' name="rfc" type="text" placeholder="RFC" required>
        <input id="phone" name="phone" type="text" placeholder="Teléfono" required>
          <input pattern="^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$"  id="email" name="email" type="text" placeholder="Correo electrónico" required>
          <input id="password" name="password" type="password" placeholder="Constraseña" required>
          <input id="confirm_password" name="confirm_password" type="password" placeholder="Confirmar constraseña"required>
        <input type="submit" value="Guardar Clínica">
      </form>
    </div>
  </div>

  <script src="validateForms.js"></script>
</body>
</html>