<?php
  session_start();

  if (!(isset($_SESSION['username']))) {
    if ($_SESSION['username'] != 'admin') {
      header("Location: home.php");
    }
  } 
?>