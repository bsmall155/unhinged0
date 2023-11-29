<?php
  /* this file contains majority of the funtions to increase the admins functionality and provide CRUD options. */

  error_reporting(E_ALL);
  ini_set("display_errors", 1);

  $dsn = "mysql:host=localhost:3306;dbname=project";
  $user = "root";
  $pass = "root";
  $pdo = new PDO($dsn, $user, $pass);

  include "setup.php";

  #for delete/select
  function delsel ($act, $user) {
    if (isset($act)) {
      global $pdo;
      switch($act) {
        case 1 :
          deletelikes($user);
          deletemail($user);

          $sql = "DELETE FROM registration WHERE username = ?";
          $statement = $pdo -> prepare($sql);
          $statement -> execute([$user]);

          /*echo "succesfully removed user $user";*/
          header("Location: pages/adminpg.php");
          break;

        case 2 :
          /*echo "$user has been selected for changes.";*/
          session_start();
          $_SESSION['chguser'] = $user;

          header("Location: pages/adminchuser.php");
          break;
      }
    } else {header("Location: pages/adminpg.php");}
  }


  #displays table for del/sel
  function displaytable() {
    global $pdo;

    $sql = "SELECT * FROM registration";
    $statement = $pdo -> query($sql);

    echo "<div class='upuser upuser1'><form action='../admindelsel.php' method='post' class='loginbox'>";
    while ($row = $statement->fetch()){
      echo "<div class='inputbox'><input type='radio' name='user' value='$row[0]'>";
      echo "<label for='$row[0]'>$row[0] </label></div>";
    }
    echo "<div class='inputbox'><input type='radio' name='act' value='1'>";
    echo "<label for='del'>delete</label></div>";
    echo "<div class='inputbox'><input type='radio' name='act' value='2'>";
    echo "<label for='sel'>select</label></div>";

    echo "<div class='subbox'><input type='submit' value='submit' class='subbox1'></div>";

    echo "</form></div>";
  }


  #adds user if requirements good
  function adminadduser($newusername, $newpassword) {
    global $pdo;
    if (isset($newusername)){
      if (!(checkforuser($newusername)) && checkpass($newpassword)) {
        $newpass = password_hash($newpassword, PASSWORD_BCRYPT);
  
        $sql = "INSERT INTO registration (username, password) VALUES (?, ?)";
        $statement = $pdo -> prepare($sql);
        $statement -> bindParam(1, $newusername);
        $statement -> bindParam(2, $newpass);
        $statement -> execute();
  
        header("Location: pages/adminpg.php");
      } else {
        setcookie('ben', 'either the username you picked has already been taken or the password doesnt meet requirements.', time() + 1);
        header("Location: pages/adminpg.php");
        /*echo "either username is already taken or password doesn't pass requirements";*/
      }
    } else {header("Location: pages/adminpg.php");}
  }

  function adminadduserpass($username, $password) {
    if (!(checkforuser($username))) {
      global $pdo;

      $sql = "INSERT INTO registration (username, password) VALUES (?, ?)";
      $statement = $pdo -> prepare($sql);
      $statement -> bindParam(1, $username);
      $statement -> bindParam(2, $password);
      $statement -> execute();

    } else {
      setcookie('ben', 'the username you tried has already been taken.', time() + 1);
      header("Location: pages/adminchuser.php"); #user taken
    }
  }

  function adminupdateuser($newuser = null, $newpass = null) {
    global $pdo;
    
    session_start();
    if (isset($_SESSION['chguser'])) {
      if ($newpass != null) {
        if (checkpass($newpass)) {
          $newp = password_hash($newpass, PASSWORD_BCRYPT);
          $sql = "UPDATE registration SET password = ? WHERE username = ?";
          $statement = $pdo -> prepare($sql);
          $statement -> bindParam(1, $newp);
          $statement -> bindParam(2, $_SESSION['username']);
          $statement -> execute();

          if ($newuser == null) {
            header("Location: pages/adminpg.php");
          }
        } else {
          /* need to add password doesnt meet requirements error*/
          setcookie('ben', 'the password you tried doesnt fit requirements.', time() + 1);
          header("Location: pages/adminchuser.php");
        }
      }

      if (($newuser != null) && (checkpass($newpass) || $newpass == null)) {
        if (!(checkforuser($newuser))) {

          $sql = "SELECT password FROM registration WHERE username = ?";
          $statement = $pdo -> prepare($sql);
          $statement -> bindParam(1, $_SESSION['chguser']);
          $statement -> execute();
          $check = $statement -> fetch();

          adminadduserpass($newuser, $check[0]);
          
          $sql = "UPDATE likes SET username = ? WHERE username = ?";
          $statement = $pdo -> prepare($sql);
          $statement -> bindParam(1, $newuser);
          $statement -> bindParam(2, $_SESSION['chguser']);
          $statement -> execute();

          $sql = "UPDATE email SET username = ? WHERE username = ?";
          $statement = $pdo -> prepare($sql);
          $statement -> bindParam(1, $newuser);
          $statement -> bindParam(2, $_SESSION['chguser']);
          $statement -> execute();
          
          $sql = "DELETE FROM registration WHERE username = ?";
          $statement = $pdo -> prepare($sql);
          $statement -> bindParam(1, $_SESSION['chguser']);
          $statement -> execute();

          header("Location: pages/adminpg.php");
        } else {
          setcookie('ben', 'the username you tried has already been taken.', time() + 1);
          header("Location: pages/adminchuser.php");
        }
      } 
    }
  }

  function admingetemails($user) {
    global $pdo;

    $sql = "SELECT email FROM email WHERE username = ?";
    $state = $pdo -> prepare($sql);
    $state -> bindParam(1, $user);
    $state -> execute();

    $check = $state -> fetch();

    if ($check) {
      $sql = "SELECT email FROM email WHERE username = ?";
      $statement = $pdo -> prepare($sql);
      $statement -> bindParam(1, $user);

      $statement -> execute();

      echo "<form action='../adminemail.php' method='post' class='loginbox'>";
      while ($row = $statement -> fetch()) {
        echo "<div class='emailbox'><input type='radio' name='email' value='$row[0]'>";
        echo "<label for='$row[0]'>$row[0] </label></div>";
      }
      echo "<div class='subbox'><input type='submit' value='submit' class='subbox1'></div>";
      echo "</form>";
    } else {
      echo "<div class='inputbox'><p class='ntxt ntxt1'>no email attatched to account.</p></div>";
    }
  }

  function admindeletemail($email) {
    global $pdo;

    session_start();

    $sql = "DELETE FROM email WHERE username = ? AND email = ?";
    $statement = $pdo -> prepare($sql);
    $statement -> bindParam(1, $_SESSION['chguser']);
    $statement -> bindParam(2, $email);
    $statement -> execute();
  }

?>
