<?php
  include 'setup.php';

  session_start();
  $user = $_SESSION['username'];

  if ($_SERVER["REQUEST_METHOD"] = "POST") {
    deletelikes($user);
    foreach ($likesarray as $value) {
      if (isset($_POST[$value])) {
        createlike($user, $value);
      }
    }
  } 

  header("Location: pages/testpage.php");
?>