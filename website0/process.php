<?php
  include 'setup.php';

  session_start();

  if ($_SERVER["REQUEST_METHOD"] = "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $_SESSION['username'] = $_POST['username'];
  } 

  checkuser($user, $pass);
?>