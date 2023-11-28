<?php
  include 'setup.php';

  session_start();

  if ($_SERVER["REQUEST_METHOD"] = "POST") {
    if ($_POST['email'] !=  '') {
      $email = $_POST['email'];
      usermakemail($email, $_SESSION['username']);
    }
  } 

  header("Location: pages/profile.php");
?>