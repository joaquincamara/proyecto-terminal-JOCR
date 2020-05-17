<html>
<head>   
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php require 'partials/header.php' ?>
<?php

include 'controllers/calendar.php';
 
$calendar = new Calendar();
 
echo $calendar->show();
?>
</body>
</html> 