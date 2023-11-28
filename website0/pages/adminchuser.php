<!DOCTYPE html>
<html>
  <head>
    <title>update user page</title>
    <link rel="icon" type="image/x-icon" href="../pictures/img.png">
    <link rel='stylesheet' href='../styles/basic.css'>
    <link rel='stylesheet' href='../styles/layout.css'>
    <link rel='stylesheet' href='../styles/adminlay.css'>
  </head>
  <body>
    <?php 
      include '../admincook.php';
      include '../cookies.php'; 
      include '../processadmin.php';
    ?>
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
      <div class='banpc-pt2'><a href='adminpg.php'><div class='banpc'>back</div></a></div>
      <div class='banpc-pt3'><div class='banlogo'>UNHINGED</div></div>
      <div class='banpc-pt4'>
        <form action='../logout.php' method='post' class='ban-pt4-wdth'>
          <input type='submit' value='logout' class='banpc'>
        </form>
      </div>
    </div>

    <div class='page'>
      <div class='col1'>
        <div class='row1'></div>
        <div class='row2'>
          <div>
            <div><h1 class='ntxt'>USER SELECTED: <?php echo $_SESSION['chguser'];?></h1></div>
            <div class='upuser'>
              <form action="../adminupdate.php" method="post" class='loginbox'>
                <div class='userbox'> 
                  <label for="user">username</label>
                  <input type="text" name="user" id="user">
                </div>
                <div class='passbox'>
                  <label for="pass">password</label>
                  <input type="password" name="pass" id="pass">
                </div>
                <div class='subbox'>
                  <input type="submit" value="submit" class='subbox1'>
                </div>
              </form>
            </div>
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

      <div class='col2'>
        <div class='row1'></div>
        <div class='row2'>
          <div><h1 class='ntxt'>EMAIL EDITOR</h1></div>
          <div class='upuser'>
            <?php admingetemails($_SESSION['chguser']); ?>

            <form action="../adminaddemail.php" method="post" class='loginbox'>
              <div class='emailbox'>
                <label for="email">email</label>
                <input type="text" name="email" id="email">
              </div>
              <div class='subbox'>
                <input type="submit" value="submit" class='subbox1'>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>