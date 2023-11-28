<?php
  include 'setup.php';

  session_start();

  if ($_SERVER["REQUEST_METHOD"] = "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $_SESSION['username'] = $_POST['username'];
    if (isset($_POST['email'])) {
      $email = $_POST['email'];
    }
  }

  if (isset($email)) {
    adduser($user, $pass, $email);
  } else {
    adduser($user, $pass);
  }
?>