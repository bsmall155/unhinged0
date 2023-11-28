<!DOCTYPE html>
<html>
  <head>
    <title>home page</title>
    <link rel="icon" type="image/x-icon" href="../pictures/img.png">
    <link rel='stylesheet' href='../styles/basic.css'>
    <link rel='stylesheet' href='../styles/layout.css'>
    <link rel='stylesheet' href='../styles/home.css'>
  </head>
  <body>
    <?php include '../cookies.php'; ?>
    <style>
      body {
        animation: drop 0.3s;
      }
      .col2 {
        flex: 2;
      }
      .row1, .row2, .row3 {
        align-items: normal;
      }
      .row2 {
        flex: 4;
      }
      .ntxt {
        font-size: 25px;
        font-weight: bold;
      }
    </style>

    <div class='ban'>
      <div class='banpc-pt1'><div class='ban-pt1-wdth'><a href="testpage.php"><div class='banpc'>results</div></a></div></div>
      <div class='banpc-pt2'>
        <?php 
          session_start();
          if (($_SESSION['username']) == 'admin') {
            echo "<a href='adminpg.php'><div class='banpc'>admin page</div></a>";
          } else {
            echo "<a href='profile.php'><div class='banpc'>profile</div></a>";
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
      <div class='col1'>
        <div class='row1'><h1 class='ntxt'>Welcome To Your Personal Experience</h1></div>
        <div class='row2'></div>
        <div class='row3'></div>
      </div>
      <div class='col2'>
        <div class='row1'></div>
        <div class='row2'>
          <div class='ibox'>
            <form action="../likeinput.php" method="post" class='loginbox'>
              <div class='interesttxt'>
                <p class='likes ntxt'>WHAT ARE YOUR INTERESTS?</p>
              </div>
              <div class='inputs'>
                <?php 
                  include '../setup.php';
              
                  $num = 0;
                  foreach ($likesarray as $value) {
                    echo "<div class='likes like$num'>";
                      displayinfo($value);
                    echo "</div>";
                    $num++;
                  }
                ?>
              </div>
              <div class='subbox'>
                <input type="submit" value="submit" class='subbox1'>
              </div>
            </form>
          </div>
        </div>
        <div class='row3'></div>
      </div>
      <div class='col3'>
        <div class='row1'></div>
        <div class='row2'></div>
        <div class='row3'></div>
      </div>
    </div>

  </body>
</html>