<?php 

  require 'database.php'

?>

<header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
  <ul class="nav">
    <?php if(!empty($inicio)): ?>
      <li class="nav-item">
        <a href="./courses.php" class="nav-link active" href="#">Mis Cursos</a>
      </li>
      <li class="nav-item">
        <a href="./player.php" class="nav-link" href="#">Reproductor</a>
      </li>
      <li class="nav-item">
        <a href="logout.php" class="nav-link">Logout</a>
      </li>
    <?php endif; ?>
      <li  class="nav-item">
        <a href="index.php" class="nav-link">Login</a>
      </li>
      <li  class="nav-item">
        <a href="signup.php" class="nav-link">SignUp</a>
      </li>
  </ul>
  </div>
</nav>
</header>
