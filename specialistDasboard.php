<?php 

  require 'database.php';
  $message = '';

  if (!empty($_POST['completeName']) && !empty($_POST['email'])) {
    $sql = "INSERT INTO clients (completeName, email, phone, reasonForVisit, treatment, prescriptionDrug, startTreatmentDate, endTreatmentDate) VALUES (:completeName, :email, :phone, :reasonForVisit, :treatment, :prescriptionDrug, :startTreatmentDate, :endTreatmentDate)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':completeName', $_POST['completeName']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':phone', $_POST['phone']);
    $stmt->bindParam(':reasonForVisit', $_POST['reasonForVisit']);
    $stmt->bindParam(':treatment', $_POST['treatment']);
    $stmt->bindParam(':prescriptionDrug', $_POST['prescriptionDrug']);
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
    <link rel="stylesheet" href="./normalize.css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>
<body>
<?php require 'partials/header.php' ?>

<?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

<?php if(!empty($clients)): ?>

<div class="row">
  <div class="col-6">


<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Reason of visit</th>
    </tr>
  </thead>
  <tbody>
    <?php if ($clients) {
      echo "<tr><td>". $clients['completeName'] ."</td><td>". $clients['reasonForVisit'] ."</td><tr>";
      echo "</table>";
    } ?>
  </tbody>
</table>
  </div>
<?php endif; ?>

<div class="col-6">
 <form action="specialistDasboard.php" method="POST">
  <div class="form-group">
    <label for="completeName">Complete name</label>
    <input name="completeName" type="text" class="form-control" id="completeName" >
  </div>

  <div class="form-group">
    <label for="email">Email</label>
    <input name="email" type="text" class="form-control" id="email" >
  </div>

  <div class="form-group">
    <label for="phone">Phone</label>
    <input name="phone" type="text" class="form-control" id="phone" >
  </div>

  <div class="form-group">
    <label for="reasonForVisit">Reason for visit</label>
    <input name="reasonForVisit" type="text" class="form-control" id="reasonForVisit" >
  </div>


  <div class="form-group">
    <label for="treatment">Treatment</label>
    <textarea name="treatment" class="form-control" id="treatment" rows="3"></textarea>
  </div>

  <div class="form-group">
    <label for="prescriptionDrug">Prescription Drugs</label>
    <textarea name="prescriptionDrug" class="form-control" id="prescriptionDrug" rows="3"></textarea>
  </div>

  <div class="form-group">
    <label for="startTreatmentDate">Start treatment date</label>
    <input name="startTreatmentDate" type="text" class="form-control" id="startTreatmentDate" >
  </div>

  <div class="form-group">
    <label for="endTreatmentDate">End treatment date</label>
    <input name="endTreatmentDate" type="text" class="form-control" id="endTreatmentDate" >
  </div>

  <input type="submit" value="Submit">
</form>
 </div>

</div>
</body>
</html>