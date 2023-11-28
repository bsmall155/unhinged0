<?php
  include "processadmin.php";

  if ($_SERVER["REQUEST_METHOD"] = "POST") {
    $newusername = $_POST['newuser'];
    $newpassword = $_POST['newpass'];
  }

  adminadduser($newusername, $newpassword);
?>