<?php
  include 'setup.php';

  if ($_SERVER["REQUEST_METHOD"] = "POST") {
    $email = $_POST['email'];
  }

  userdeletemail($email);

  header("Location: pages/profile.php");
?>