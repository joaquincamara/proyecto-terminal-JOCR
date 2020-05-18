<?php require 'database.php'; ?>
<html>
<head>   
<meta charset="utf-8">
    <title>S.I.C.E.</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
<?php require 'partials/header.php' ?>

<?php
include 'calendar.php';
 
$calendar = new Calendar();
 
echo $calendar->show();
?>
</body>
</html> 