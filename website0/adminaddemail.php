<?php
  include 'setup.php';

  session_start();

  if ($_SERVER["REQUEST_METHOD"] = "POST") {
    if ($_POST['email'] != '') {
      $email = $_POST['email'];
      usermakemail($email, $_SESSION['chguser']);
    }
  } 

  header("Location: pages/adminchuser.php");
?>