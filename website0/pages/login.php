<!DOCTYPE html>
<html>
  <head>
    <title>login page</title>
    <link rel="icon" type="image/x-icon" href="../pictures/img.png">
    <link rel='stylesheet' href='../styles/basic.css'>
    <link rel='stylesheet' href='../styles/layout.css'>
    <link rel='stylesheet' href='../styles/loginbx.css'>
    <link rel='stylesheet' href='../styles/animate.css'>
  </head>
  <body>
    <style>
      html {
        background-color: black;
      }
      body {
        animation: drop 0.5s;
      }
      .err {
        color: red;
        font-size: 16px;
        font-weight: normal;
      }
    </style>

    <div class='ban'>
      <div class='banpc-pt1'><div class='ban-pt1-wdth'><a href="home.php"><div class='banpc'>home page</div></a></div></div>
      <div class='banpc-pt2'></div>
      <div class='banpc-pt3'><div class='banlogo'>UNHINGED</div></div>
      <div class='banpc-pt4'><div class='ban-pt4-wdth'><a href="registerpage.php"><div class='banpc'>new user</div></a></div></div>
    </div>


    <div class='page'>
      <div class='col1'></div>
      <div class='col2'>
        <div class='row1'></div>
        <div class='row2'>
          <form action="../process.php" method="post" class='loginbox'>
            <div>
              <p class='logintxt'>LOGIN FORM</p>
            </div>
            <div class='userbox'>
              <label for="username" class='iboxt'>username</label>
              <input type="text" name="username" id="username" class="ibox" required>
            </div>
            <div class='passbox'>
              <label for="password" class='iboxt'>password</label>
              <input type="password" name="password" id="password" class="ibox" required>
            </div>
            <div class='subbox'>
              <input type="submit" value="submit" class='subbox1'>
            </div>
          </form>
        </div>
        <div class='row3'></div>
      </div>
      <div class='col3'>
        <p class='err'>
          <?php
            if (isset($_COOKIE['ben'])) {
              echo $_COOKIE['ben'];
            }
          ?>
        </p>
      </div>
    </div>
  </body>
</html>