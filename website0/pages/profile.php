<!DOCTYPE html>
<html>
  <head>
    <title>home page</title>
    <link rel="icon" type="image/x-icon" href="../pictures/img.png">
    <link rel='stylesheet' href='../styles/basic.css'>
    <link rel='stylesheet' href='../styles/layout.css'>
    <link rel='stylesheet' href='../styles/proflay.css'>
  </head>
  <body>
    <?php include '../cookies.php'; ?>
    <style>
      body {
        animation: drop 0.3s;
      }
    </style>

    <div class='ban'>
      <div class='banpc-pt1'><div class='ban-pt1-wdth'><a href="home.php"><div class='banpc'>home page</div></a></div></div>
      <div class='banpc-pt2'>
        <?php 
          session_start();
          if (($_SESSION['username']) == 'admin') {
            echo "<a href='adminpg.php'><div class='banpc'>admin page</div></a>";
          }
        ?>
      </div>
      <div class='banpc-pt3'><div class='banlogo'>UNHINGED</div></div>
      <div class='banpc-pt4'>
        <form action='../logout.php' method='post' class='ban-pt4-wdth'>
          <input type='submit' value='logout' class='banpc'>
        </form>
      </div>
    </div>

    <div class='page'>
      <div class='toppt'>
        <h1 class='ntxt'>USER INFORMATION</h1>
      </div>
      <div class='botpt'>
        <div class='col1'>
          <div class='row2'>

            <p class='ntxt'>LOGIN DETAILS</p>
            <?php 
              include '../setup.php';

              getuserinfo($_SESSION['username']);
            ?>

            <p class='ntxt'>UPDATE USER</p>
      
            <div class='upuser'>
              <form action="../upuser.php" method="post" class='loginbox'>
                <div class='userbox'>
                  <label for="username" class='iboxt'>username</label>
                  <input type="text" name="username" id="username" class="ibox">
                </div>
                <div class='passbox'>
                  <label for="password" class='iboxt'>password</label>
                  <input type="password" name="password" id="password" class="ibox">
                </div>
                <div class='subbox'>
                  <input type="submit" value="submit" class='subbox1'>
                </div>
              </form>
            </div>
          </div>
          <div class='row3'>
            <p class='ntxt'>
              <?php
                if (isset($_COOKIE['ben'])) {
                  echo $_COOKIE['ben'];
                }
              ?>
            </p>
          </div>
        </div>
        <div class='col2'>
          <div class='row2'>
            <p class='ntxt'>DELETE EMAILS</p>

            <?php 
              getemails($_SESSION['username']);
            ?>

            <p class='ntxt'>EDIT EMAILS</p>

            <div class='newemail'>
              <form action="../addemail.php" method="post" class='loginbox'>
                <div class='emailbox'>
                  <label for="email" class='iboxt'>email</label>
                  <input type="text" name="email" id="email" class="ibox">
                </div>
                <div class='subbox'>
                  <input type="submit" value="submit" class='subbox1'>
                </div>
              </form>
            </div>
          </div>
          <div class='row3'></div>
        </div>
      </div>
    </div>

  </body>
</html>