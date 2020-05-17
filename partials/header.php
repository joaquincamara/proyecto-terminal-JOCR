<?php 

  require 'database.php'

?>

<header>
  <ul  class="nabvar" >
    <?php if(!empty($inicio)): ?>
      <li class='navbarItem' >
        <a href="clientsManagement.php" >Resigtro de clientes</a>
      </li>

      <li class='navbarItem' >
        <a href="calendarView.php" >Calendario de citas</a>
      </li>

      <?php if(!empty($inicio['usertype'] == 'superAdmin')): ?>
        <li class='navbarItem' >
          <a href="  specialistManagement.php" >Resgistro de especialistas</a>
        </li>
        <li class='navbarItem' >
          <a href="clinicsManagement.php" >Registro de clinicas</a>
        </li>
      <?php endif; ?>

      <li class='navbarItem' >
        <a href="logout.php" >Logout</a>
      </li>
    <?php else: ?>
      <li class='navbarItem' >
        <a href="index.php">Login</a>
      </li>
      <li class='navbarItem' >
        <a href="signup.php">SignUp</a>
      </li>
    <?php endif; ?>
  </ul>
</header>
