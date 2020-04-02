<?php
  session_start();

  session_unset();

  session_destroy();

  header('Location: /proyecto_termina_I/');
?>
