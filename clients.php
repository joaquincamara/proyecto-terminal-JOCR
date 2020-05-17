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

    if ($stmt->execute()) {
        $message = 'Successfully created new client';
      } else {
        $message = 'Sorry there must have been an issue creating your client';
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
            <th scope="col">Clients</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            while($row = $clientRecords->fetch(PDO::FETCH_ASSOC))
              {
          ?>
                <tr>
                  <td>  <?php echo $row['completeName']; ?> <a href="deleteClient.php?id=<?php echo $row['id']; ?>">DELETE</a></td>
                </tr>
          <?php 
              } 
          ?>
        </tbody>
        </table>
    </div>
    <?php endif; ?>

    <div class="clientRegistryContainer">
      <form action="specialistDasboard.php" method="POST">
        
        <div class="clientRegistryInputsSection">
          <div class="clientRegistryInputsSection-box1">
            <input placeholder="Complete name" name="completeName" type="text" id="completeName" >
            <input placeholder="Email" name="email" type="text" id="email" >
            <input placeholder="Phone" name="phone" type="text" id="phone" >
          </div>
          <div class="clientRegistryInputsSection-box2">
            <input placeholder="Reason for visit" name="reasonForVisit" type="text" id="reasonForVisit" >
            <input placeholder="Start treatment date" name="startTreatmentDate" type="text" id="startTreatmentDate" >
            <input placeholder="End treatment date" name="endTreatmentDate" type="text" id="endTreatmentDate" >
          </div>
        </div>

        <div class="clientRegistryTextareaSection">
          <textarea placeholder="Treatment" name="treatment" id="treatment" rows="8"></textarea>
          <textarea placeholder="Prescription Drugs" name="prescriptionDrugs" id="prescriptionDrugs" rows="8"></textarea>
          <input type="submit" value="Submit">
        </div>
      </form>
    </div>
  </div>
</body>
</html>