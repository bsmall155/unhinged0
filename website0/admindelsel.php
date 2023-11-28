<?php 
  include 'processadmin.php';

  if ($_SERVER["REQUEST_METHOD"] = "POST") {
    if (isset($_POST['user'])) {
      $user = $_POST['user'];
      if (isset($_POST['act'])) {
        $act = $_POST['act'];
      }
    }
    if (isset($_POST['newuser'])){
      $newusername = $_POST['newuser'];
      $newpassword = $_POST['newpass'];
    }
  }

  delsel($act, $user);
?>