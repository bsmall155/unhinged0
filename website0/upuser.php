<?php
  include 'setup.php';

  $newuser = null;
  $newpass = null;

  session_start();
  $_SESSION['chguser'] = $_SESSION['username'];
  echo $_SESSION['chguser'];

  if ($_SERVER["REQUEST_METHOD"] = "POST") {
    if (isset($_POST['username'])) {
      $newuser = $_POST['username'];
    }
    if (isset($_POST['password'])) {
      $newpass = $_POST['password'];
    }
  }

  userupdateuser($newuser, $newpass);
  if (($newuser == null) && ($newpass == null)) {
    header("Location: pages/profile.php");
  }
?>