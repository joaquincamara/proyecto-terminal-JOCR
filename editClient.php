<?php 

  require 'database.php';
  $message = '';
  $id = $_GET['id'];
  $clientToEditRecord = $conn ->prepare('SELECT * FROM clients WHERE id=:id');
  $clientToEditRecord->bindParam(':id', $id,PDO::PARAM_INT);
  $clientToEditRecord->execute();
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

  <?php if(!empty($clients)): ?>

  <div class="dashboardContainer">
    <div class="tableContainer">
      <table id="clients-table">
        <thead>
          <tr>
            <th scope="col">Clientes</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            while($row = $clientRecords->fetch(PDO::FETCH_ASSOC))
              {
          ?>
                <tr>
                  <td>  
                    <?php echo $row['completeName']; ?> 
                    <a href="deleteClient.php?id=<?php echo $row['id']; ?>">Borrar</a>
                    <a href="editClient.php?id=<?php echo $row['id']; ?>">Editar</a>
                  </td>
                </tr>
          <?php 
              } 
          ?>
        </tbody>
        </table>
    </div>
    <?php endif; ?>

    <div class="clientRegistryContainer">

    <?php if(!empty($clientToEditRecord)): ?>
    <?php 
            while($clientToResult = $clientToEditRecord->fetch(PDO::FETCH_ASSOC))
              {
          ?>
      <form onsubmit="return clientRegistryValidations();" action="editClient.php">
        <div class="clientRegistryInputsSection">

          <div class="clientRegistryInputsSection-box1">
          <input type="hidden" name="id" value="<?php echo $clientToResult['id'] ?>"'>
            <input value="<?php echo $clientToResult['completeName'] ?>" required id="completeName" placeholder="Nombre completo" name="completeName" type="text" >
            <input value="<?php echo $clientToResult['email'] ?>" required pattern="^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$" id="email" placeholder="Correo electrónico" name="email" type="text" id="email" >
            <input value="<?php echo $clientToResult['phone'] ?>" required id="phone" placeholder="Teléfono celular" name="phone" type="text" id="phone" >
          </div>

          <div class="clientRegistryInputsSection-box2">
            <input value="<?php echo $clientToResult['reasonForVisit'] ?>" required id="reasonForVisit" placeholder="Razón de visita" name="reasonForVisit" type="text" >
            <input value="<?php echo $clientToResult['startTreatmentDate'] ?>" required id="startTreatmentDate" placeholder="Inicio de tratamiento" name="startTreatmentDate" type="text"  >
            <input value="<?php echo $clientToResult['endTreatmentDate'] ?>" required id="endTreatmentDate" placeholder="Fin de tratamiento" name="endTreatmentDate" type="text" >
          </div>
        </div>

        <div class="clientRegistryTextareaSection">
          <textarea required id="treatment" placeholder="Descripción de tratamiento" name="treatment"  rows="8"><?php echo $clientToResult['treatment'] ?></textarea>
          <textarea required id="prescriptionDrugs" placeholder="Medicamentos" name="prescriptionDrugs"  rows="8"><?php echo $clientToResult['prescriptionDrugs'] ?></textarea>
          <input required type="submit" value="Guardar cliente">
        </div>
      </form>

      <?php 
              } 
        ?>
    <?php endif; ?>

    <?php
      $id = $_GET['id'];
      $completeName = $_GET['completeName'];
      $email = $_GET['email'];
      $phone = $_GET['phone'];
      $reasonForVisit = $_GET['reasonForVisit'];
      $startTreatmentDate = $_GET['startTreatmentDate'];
      $endTreatmentDate = $_GET['endTreatmentDate'];
      $treatment = $_GET['treatment'];
      $prescriptionDrugs = $_GET['prescriptionDrugs'];
    print_r($icompleteNamed);
      if(!empty($completeName)) {
        $editClient = $conn->prepare('UPDATE clients SET completeName=:completeName, email=:email, phone=:phone, reasonForVisit=:reasonForVisit, startTreatmentDate=:startTreatmentDate, endTreatmentDate=:endTreatmentDate, treatment=:treatment, prescriptionDrugs=:prescriptionDrugs WHERE id=:id');
        $editClient->bindParam(':id', $id,PDO::PARAM_INT);
        $editClient->bindParam(':completeName', $completeName);
        $editClient->bindParam(':email', $email);
        $editClient->bindParam(':phone', $phone);
        $editClient->bindParam(':reasonForVisit', $reasonForVisit);
        $editClient->bindParam(':startTreatmentDate', $startTreatmentDate);
        $editClient->bindParam(':endTreatmentDate', $endTreatmentDate);
        $editClient->bindParam(':treatment', $treatment);
        $editClient->bindParam(':prescriptionDrugs', $prescriptionDrugs);
      
        if ($editClient->execute()) {
          header('Location: /proyecto_termina_I/clientsManagement.php');
          // header('Location: https://proyecto-terminal-jocr.000webhostapp.com/specialistManagement.php');
        }
      }
    ?>
    </div>
  </div>
  <script src="validateForms.js"></script>
</body>
</html>