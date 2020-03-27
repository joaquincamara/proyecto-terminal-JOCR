<?php
  session_start();

  session_unset();

  session_destroy();

  header('Location: /DPW2_U1_A3_JOCR/');
?>
