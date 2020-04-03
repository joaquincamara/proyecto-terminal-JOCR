<?php 

  require 'database.php'

?>

<header>
  <ul >
    <?php if(!empty($inicio)): ?>
      <li>
        <a href="specialistDasboard.php" >Client Dashboard</a>
      </li>

      <?php if(!empty($inicio['usertype'] == 'superAdmin')): ?>
        <li>
          <a href="superAdminDashboard.php" >Admin Dashboard</a>
        </li>
      <?php endif; ?>
      
      <li>
        <a href="logout.php" >Logout</a>
      </li>
    <?php else: ?>
      <li>
        <a href="index.php">Login</a>
      </li>
      <li>
        <a href="signup.php">SignUp</a>
      </li>
    <?php endif; ?>
  </ul>
</header>
