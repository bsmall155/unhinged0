<?php
  include 'processadmin.php';

  if ($_SERVER["REQUEST_METHOD"] = "POST") {
    $email = $_POST['email'];
  }

  admindeletemail($email);

  header("Location: pages/adminchuser.php");
?>