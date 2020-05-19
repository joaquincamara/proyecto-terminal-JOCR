<?php 

  require 'database.php';
  $message = '';

  if (!empty($_POST['completeName']) && !empty($_POST['email'])) {
    $sql = "INSERT INTO clients (completeName, email, phone, reasonForVisit, treatment, prescriptionDrugs, startTreatmentDate, endTreatmentDate) VALUES (:completeName, :email, :phone, :reasonForVisit, :treatment, :prescriptionDrugs, :startTreatmentDate, :endTreatmentDate)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':completeName', $_POST['completeName']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':phone', $_POST['phone']);
    $stmt->bindParam(':reasonForVisit', $_POST['reasonForVisit']);
    $stmt->bindParam(':treatment', $_POST['treatment']);
    $stmt->bindParam(':prescriptionDrugs', $_POST['prescriptionDrugs']);
    $stmt->bindParam(':startTreatmentDate', $_POST['startTreatmentDate']);
    $stmt->bindParam(':endTreatmentDate', $_POST['endTreatmentDate']);
    header('Location: /proyecto_termina_I/clientsManagement.php');
    //  header('Location: https://proyecto-terminal-jocr.000webhostapp.com/clientsManagement.php');
    if (!$stmt->execute()) {
        $message = 'Sorry there must have been an issue creating your client';
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
                    <div>
                      <p><?php echo $row['completeName']; ?></p>
                    </div>
                    <div>
                    <a class="editTableButton" href="editClient.php?id=<?php echo $row['id']; ?>">Editar</a>
                      <a class="DeleteTableButton" href="deleteClient.php?id=<?php echo $row['id']; ?>">Borrar</a>
                    </div>
                  </td>
                </tr>
          <?php 
              } 
          ?>
        </tbody>
        </table>
        <div class="pagination">
         <a href="#">&laquo;</a>
          <a href="#" class="active"> 1</a>
          <a href="#" >2</a>
          <a href="#">3</a>
          <a href="#">4</a>
          <a href="#">5</a>
          <a href="#">6</a>
          <a href="#">&raquo;</a>
        </div>
    </div>
    <?php endif; ?>

    <div class="clientRegistryContainer">
      <form onsubmit="return clientRegistryValidations();" action="clientsManagement.php" method="POST">
        
        <div class="clientRegistryInputsSection">
          <div class="clientRegistryInputsSection-box1">
            <input required id="completeName" placeholder="Nombre completo" name="completeName" type="text" >
            <input required pattern="^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$" id="email" placeholder="Correo electrónico" name="email" type="text" id="email" >
            <input required id="phone" placeholder="Teléfono celular" name="phone" type="text" id="phone" >
          </div>
          <div class="clientRegistryInputsSection-box2">
            <input required id="reasonForVisit" placeholder="Razón de visita" name="reasonForVisit" type="text" >
            <input required id="startTreatmentDate" placeholder="Inicio de tratamiento" name="startTreatmentDate" type="text"  >
            <input required id="endTreatmentDate" placeholder="Fin de tratamiento" name="endTreatmentDate" type="text" >
          </div>
        </div>

        <div class="clientRegistryTextareaSection">
          <textarea required id="treatment" placeholder="Descripción de tratamiento" name="treatment"  rows="8"></textarea>
          <textarea required id="prescriptionDrugs" placeholder="Medicamentos" name="prescriptionDrugs"  rows="8"></textarea>
          <input  type="submit" value="Guardar cliente">
        </div>
      </form>
    </div>
  </div>
  <script src="validateForms.js"></script>
</body>
</html>