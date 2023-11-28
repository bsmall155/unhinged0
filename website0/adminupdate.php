<?php
  include 'processadmin.php';

  $newuser = null;
  $newpass = null;

  if ($_SERVER["REQUEST_METHOD"] = "POST") {
    if (isset($_POST['user'])) {
      $newuser = $_POST['user'];
    }
    if (isset($_POST['pass'])) {
      $newpass = $_POST['pass'];
    }
  }

  adminupdateuser($newuser, $newpass);

  if (($newuser == null) && ($newpass == null)) {
    header("Location: pages/adminchuser.php");
  }
?>