<?php 
  error_reporting(E_ALL);
  ini_set("display_errors", 1);

  $dsn = "mysql:host=localhost:3306;dbname=project";
  $user = "root";
  $pass = "root";
  $pdo = new PDO($dsn, $user, $pass);

  #likes array for survey element
  $likesarray = array('legos', 'videogame', 'dogs', 'family', 'tswift', 'guitar', 'gatorade', 'koolaid', 'friends');


  #SETUP ALL TABLES AND AN ADMIN

  $sql = "CREATE TABLE IF NOT EXISTS registration (
    username VARCHAR(20) NOT NULL PRIMARY KEY,
    password VARCHAR(60) NOT NULL
  );";

  $pdo -> query($sql);

  $sql = "CREATE TABLE IF NOT EXISTS email (
    num INTEGER AUTO_INCREMENT NOT NULL PRIMARY KEY,
    username VARCHAR(20) NOT NULL,
    email VARCHAR(60) NOT NULL,
    FOREIGN KEY(username) REFERENCES registration(username)
  );";

  $pdo-> query($sql);

  $sql = "CREATE TABLE IF NOT EXISTS likes (
    num INTEGER AUTO_INCREMENT NOT NULL PRIMARY KEY,
    username VARCHAR(20) NOT NULL,
    likeditem VARCHAR(20) NOT NULL,
    FOREIGN KEY(username) REFERENCES registration(username)
  );";

  $pdo -> query($sql);
  
  #INSERTS AN ADMIN IF USERNAME NOT ALREADY USED
  $sql = "SELECT password FROM registration WHERE username = ?";
  $statement = $pdo -> prepare($sql);
  $statement -> execute(['admin']);
  $adminpass = $statement -> fetch();
  if (!($adminpass)) {
    $admin = "admin";
    $adpass = password_hash('wwwwwwwW', PASSWORD_BCRYPT);
    $sql = "INSERT INTO registration (username, password) VALUES (?, ?)";
    $statement = $pdo -> prepare($sql);
    $statement -> bindParam(1, $admin);
    $statement -> bindParam(2, $adpass);
    $statement -> execute();
  }

  

  #ALL FUNCTIONS USEFEL FOR LOGIN AND REGISTRATION PAGE

  #for login page sign in
  function checkuser($username, $password) {
    if (isset($username)) {
      global $pdo;

      $sql = "SELECT password FROM registration WHERE username = ?";
      $statement = $pdo -> prepare($sql);
      $statement -> execute([$username]);

      $check = $statement -> fetch();

      if ($check) {
        $passfromtable = $check['password'];
        if (password_verify($password, $passfromtable)) {
          header("Location: pages/home.php"); #user and pass good takes u to homepage
        } else {
          $_SESSION = null;
          session_destroy();
          setcookie('ben', 'the password you entered was incorrect.', time() + 1);
          header("Location: pages/login.php");
        }
      } else {
        $_SESSION = null;
        session_destroy();
        setcookie('ben', 'the username used does not exist. if you are a new user, please navigate to the new user page.', time() + 1);
        header("Location: pages/login.php"); #user not exist in table
        #include 'pages/logintest.php';
      }
    } else {
      header("Location: pages/login.php"); #no submitted username (shouldn't be possible)
    }
  }

  #verifys that password is 'strong enough'
  function checkpass ($password) : bool {
    if (strlen($password) > 7) {
      if (strtolower($password) != $password) {
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  #returns true if user exists in table, false otherwise
  function checkforuser($username) {
    if (isset($username)) {
      global $pdo;

      $sql = "SELECT password FROM registration WHERE username = ?";
      $statement = $pdo -> prepare($sql);
      $statement -> execute([$username]);

      $check = $statement -> fetch();
      if ($check) {
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  #for register page, adding user if not exists in table and password strong enough
  function adduser($username, $password, $email = null) {
    if (!(checkforuser($username))) {
      if (checkpass($password)) {
        global $pdo;

        $newpass = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO registration (username, password) VALUES (?, ?)";
        $statement = $pdo -> prepare($sql);
        $statement -> bindParam(1, $username);
        $statement -> bindParam(2, $newpass);
        $statement -> execute();

        if ($email != null) {
          makemail($email, $username);
        }

        header("Location: pages/home.php"); # ----- possibly put new user notification
      } else {
        $_SESSION = null;
        session_destroy();
        setcookie('ben', 'the password you entered was not strong enough.<br> all passwords need to be at least eight letters and one capital.', time() + 1);
        header("Location: pages/registerpage.php"); #pass not strong
      } 
    } else {
      $_SESSION = null;
      session_destroy();
      setcookie('ben', 'the username you tried has already been taken.', time() + 1);
      header("Location: pages/registerpage.php"); #user taken
    }
  }

  #CREATES EMAILS FOR EXISTING USERS
  function makemail($email, $username) {
    if (checkforuser($username)) {
      global $pdo;

      $sql = "INSERT INTO email (username, email) VALUES (?, ?)";
      $statement = $pdo -> prepare($sql);
      $statement -> bindParam(1, $username);
      $statement -> bindParam(2, $email);
      $statement -> execute();
    } else {
      $_SESSION = null;
      session_destroy();
      setcookie('ben', 'the username you tried does not exist.', time() + 1);
      header("Location: pages/registerpage.php"); #user doesn't exist (shouldn't happen)
    }
  }

  #deletes emails for user 
  function deletemail($user){
    if (checkforuser($user)) {
      global $pdo;

      $sql = "DELETE FROM email WHERE username = ?";
      $statement = $pdo -> prepare($sql);
      $statement -> bindParam(1, $user);
      $statement -> execute();
    }
  }

  #CREATES LIKES FOR EXISTING USERS 
  function createlike($username, $like) {
    global $pdo;

    $sql = "INSERT INTO likes (username, likeditem) VALUES (?, ?)";
    $statement = $pdo -> prepare($sql);
    $statement -> bindParam(1, $username);
    $statement -> bindParam(2, $like);
    $statement -> execute();
  }

  #DELETES LIKES FOR EXISTING USERS
  function deletelikes($user) {
    global $pdo;

    $sql = "DELETE FROM likes WHERE username = ?";
    $statement = $pdo -> prepare($sql);
    $statement -> bindParam(1, $user);
    $statement -> execute();
  }

  #for selecting all values from the table for certain user then seeing if they have checked the selected value
  function checkifchecked($like) {
    global $pdo;
    $user = $_SESSION['username'];
  
    $sql = "SELECT likeditem FROM likes WHERE username = ? AND likeditem = ?";
    $statement = $pdo -> prepare($sql);
    $statement -> bindParam(1, $user);
    $statement -> bindParam(2, $like);
    $statement -> execute();
    $check = $statement -> fetch();
  
    if ($check) {
      return true;
    }
    return false;
  }
  
  #displays text piece for home page
  function displayinfo($like) {
    echo "<label for='$like' class='txtb'>$like</label>";
    if (checkifchecked($like)) {
      echo "<input type='checkbox' name='$like' id='$like' class='textb' checked>";
    } else {
      echo "<input type='checkbox' name='$like' id='$like' class='textb'>";
    }
  }

  #returns character number
  function characternum() {
    global $pdo;
    $user = $_SESSION['username'];
    
    $sql = "SELECT likeditem FROM likes WHERE username = ?";
    $statement = $pdo -> prepare($sql);
    $statement -> bindParam(1, $user);
    $statement -> execute();
    
    $num = 0;
    while ($row = $statement -> fetch()) {
      if ($row[0] == 'tswift') {
        $num--;
      } else if ($row[0] == 'legos') {
        $num+=3;
      } else if ($row[0] == 'friends') {
        $num+=2;
      } else {
        $num++;
      }
    }
  
    return $num;
  }

  #gets user information
  function getuserinfo($user) {
    global $pdo;

    $sql = "SELECT username FROM registration WHERE username = ?";
    $statement = $pdo -> prepare($sql);
    $statement -> bindParam(1, $user);
    $statement -> execute();

    $info = $statement -> fetch();
    echo "<div class='curinfo'>";
    echo "<div class='curuser'><p>current username: $info[0]</p></div>";
    echo "<div class='curpass'><p>current password: encrypted</p></div>";
    echo "</div>";
  }

  #outputs emails
  function getemails($user) {
    global $pdo;

    $sql = "SELECT email FROM email WHERE username = ?";
    $state = $pdo -> prepare($sql);
    $state -> bindParam(1, $user);
    $state -> execute();

    $check = $state -> fetch();

    echo "<div class='curemailinfo'>";
    if ($check) {
      $sql = "SELECT email FROM email WHERE username = ?";
      $statement = $pdo -> prepare($sql);
      $statement -> bindParam(1, $user);

      $statement -> execute();

      echo "<form action='../upemail.php' method='post' class='emailform'>";
      while ($row = $statement -> fetch()) {
        echo "<div class='curemail'><input type='radio' name='email' value='$row[0]'>";
        echo "<label for='$row[0]'>$row[0] </label></div>";
      }
      echo "<div class='subbox'><input type='submit' value='submit' class='subbox1'></div>";
      echo "</form>";
    } else {
      echo "<div class = 'emailform'><div class='curemail'><p class='ntxt1'>no email attatched to account.</p></div></div>";
    }
    echo "</div>";
  }

  function userdeletemail($email) {
    global $pdo;

    session_start();

    $sql = "DELETE FROM email WHERE username = ? AND email = ?";
    $statement = $pdo -> prepare($sql);
    $statement -> bindParam(1, $_SESSION['username']);
    $statement -> bindParam(2, $email);
    $statement -> execute();
  }

  function useradduser($username, $password) {
    if (!(checkforuser($username))) {
      global $pdo;

      $sql = "INSERT INTO registration (username, password) VALUES (?, ?)";
      $statement = $pdo -> prepare($sql);
      $statement -> bindParam(1, $username);
      $statement -> bindParam(2, $password);
      $statement -> execute();

    } else {
      setcookie('ben', 'the username you tried has already been taken.', time() + 1);
      header("Location: pages/profile.php"); #user taken
    }
  }

  function userupdateuser($newuser = null, $newpass = null) {
    global $pdo;
    
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
            header("Location: pages/profile.php");
          }
        } else {
          /* need to add password doesnt meet requirements error*/
          setcookie('ben', 'the password you tried doesnt fit requirements.', time() + 1);
          header("Location: pages/profile.php");
        }
      }

      if (($newuser != null) && (checkpass($newpass) || $newpass == null)) {
        if (!(checkforuser($newuser))) {

          $sql = "SELECT password FROM registration WHERE username = ?";
          $statement = $pdo -> prepare($sql);
          $statement -> bindParam(1, $_SESSION['chguser']);
          $statement -> execute();
          $check = $statement -> fetch();

          useradduser($newuser, $check[0]);
          
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

          $_SESSION['username'] = $newuser;

          header("Location: pages/profile.php");
        } else {
          setcookie('ben', 'user already exists.', time() + 1);
          header("Location: pages/profile.php");
        }
      } 
    }
  }

  function usermakemail($email, $username) {
    global $pdo;

    $sql = "INSERT INTO email (username, email) VALUES (?, ?)";
    $statement = $pdo -> prepare($sql);
    $statement -> bindParam(1, $username);
    $statement -> bindParam(2, $email);
    $statement -> execute();
  }
?>