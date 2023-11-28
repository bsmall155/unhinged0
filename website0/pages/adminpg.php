<!DOCTYPE html>
<html>
  <head>
    <title>admin only page</title>
    <link rel="icon" type="image/x-icon" href="../pictures/img.png">
    <link rel='stylesheet' href='../styles/basic.css'>
    <link rel='stylesheet' href='../styles/layout.css'>
    <link rel='stylesheet' href='../styles/adminlay.css'>
  </head>
  <body>
    <?php include '../admincook.php'; ?>
    <?php include '../cookies.php'; ?>
    <style>
      .ntxt {
        font-size: 20px;
        font-weight: bold;
      }
      .row2 {
        flex: 12;
      }
      .err {
        max-width: 350px;
      }
    </style>

    <div class='ban'>
      <div class='banpc-pt1'><div class='ban-pt1-wdth'><a href="home.php"><div class='banpc'>home page</div></a></div></div>
      <div class='banpc-pt2'><a href='profile.php'><div class='banpc'>profile</div></a></div>
      <div class='banpc-pt3'><div class='banlogo'>UNHINGED</div></div>
      <div class='banpc-pt4'>
        <form action='../logout.php' method='post' class='ban-pt4-wdth'>
          <input type='submit' value='logout' class='banpc'>
        </form>
      </div>
    </div>

    
    <div class='page'>
      <div class='col1'>
        <div class='row1'>
          <h1 class='ntxt'>made it to the admin page</h1>
        </div>
        <div class='row2'>
          <?php include '../cookies.php'; ?>
          <p class='ntxt'>ALL USERS</p>
          <?php
            include '../processadmin.php';

            displaytable();
          ?>
        </div>
      </div>

      <div class='col2'>
        <div class='row1'></div>
        <div class='row2'>
          <p class='ntxt'>CREATE NEW USER</p>
          <div class='upuser'>
            <form action="../adminadduser.php" method="post" class='loginbox'>
              <div class='userbox'>
                <label for="newuser">new username</label>
                <input type="text" name="newuser" id="newuser" required>
              </div>
              <div class='passbox'>
                <label for="newpass">new password</label>
                <input type="password" name="newpass" id="newpass" required> 
              </div>
              <div class='subbox'>
                <input type="submit" value="submit" class='subbox1'>
              </div>
            </form>
          </div>
          <p class='ntxt err'>
            <?php
              if (isset($_COOKIE['ben'])) {
                echo $_COOKIE['ben'];
              }
            ?>
          </p>
        </div>
      </div>
    </div>
  </body>
</html>