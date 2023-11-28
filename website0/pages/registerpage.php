<!DOCTYPE html>
<html>
  <head>
    <title>reqister page</title>
    <link rel="icon" type="image/x-icon" href="../pictures/img.png">
    <link rel='stylesheet' href='../styles/basic.css'>
    <link rel='stylesheet' href='../styles/layout.css'>
    <link rel='stylesheet' href='../styles/loginbx.css'>
    <link rel='stylesheet' href='../styles/animate.css'>
  </head>
  <body>
    <style>
      body {
        animation: right 1s;
      }
      .banlogo {
        font-size: 20px;
      }
      .err {
        color: black;
        font-size: 18px;
        font-weight: bold;
      }
      .loginbox {
        position: relative;
        width: 310px;
        height: 100%;
      }
      .logtxtbox, .userbox, .passbox, .emailbox, .subbox {
        flex: 1;
      }
    </style>

    <div class='ban'>
      <div class='banpc-pt1'><div class='ban-pt1-wdth'><a href="home.php"><div class='banpc'>home page</div></a></div></div>
      <div class='banpc-pt2'></div>
      <div class='banpc-pt3'><div class='banlogo'>highly disturbed, unstable, or distraught</div></div>
      <div class='banpc-pt4'><div class='ban-pt4-wdth'><a href="login.php"><div class='banpc'>login</div></a></div></div>
    </div>
    

    <div class='page'>
      <div class='col1'>
        <p class='ntxt'>FOR THE SAFTEY OF YOUR EXPERIENCE, PLEASE REFRAIN FROM USING ANY real INFORMATION.</p>
      </div>
      <div class='col2'>
        <div class='row1'></div>
        <div class='row2'>
          <form action="../register.php" method="post" class='loginbox'>
            <div class='logtxtbox'>
              <p class='logintxt'>REGISTER FORUM</p>
            </div>
            <div class='userbox'>
              <label for="username" class='iboxt'>username</label>
              <input type="text" name="username" id="username" class="ibox" required>
            </div>
            <div class='passbox'>
              <label for="password" class='iboxt'>password</label>
              <input type="password" name="password" id="password" class="ibox" required>
            </div>
            <div class='emailbox'>
              <label for='email' class='iboxt'>email</label>
              <input type='text' name='email' id='email' class='ibox'>
            </div>
            <div class='subbox'>
              <input type="submit" value="submit" class='subbox1'>
            </div>
          </form>
        </div>
        <div class='row3'></div>
      </div>
      <div class='col3'>
        <div class='row1'></div>
        <div class='row2'>
          <p class='err'>
            <?php
              if (isset($_COOKIE['ben'])) {
                echo $_COOKIE['ben'];
              }
            ?>
          </p>
        </div>
        <div class='row3'></div>
      </div>
    </div>

  </body>
</html>
