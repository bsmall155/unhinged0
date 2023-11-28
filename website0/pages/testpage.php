<!DOCTYPE html>
<html>
  <head>
    <title>result page</title>
    <link rel="icon" type="image/x-icon" href="../pictures/img.png">
    <link rel='stylesheet' href='../styles/basic.css'>
    <link rel='stylesheet' href='../styles/layout.css'>
    <link rel='stylesheet' href='../styles/resultimg.css'>
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
      }
    </style>

    <div class='ban'>
      <div class='banpc-pt1'><div class='ban-pt1-wdth'><a href="home.php"><div class='banpc'>home page</div></a></div></div>
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
        <div class='row1'><h1 class='ntxt'>Welcome To Your Results</h1></div>
        <div class='row2'></div>
        <div class='row3'></div>
      </div>
      <div class='col2'>
        <div class='row1'></div>
        <div class='row2'>
          <?php 
            include '../setup.php';
            $num = characternum(); 
            switch ($num) {
              case -1: 
                echo "<div class='row2-hgt'><img src='../pictures/tswift.png' class='basicp'>";
                echo "<p class='ntxt'>you're a tswift fan. not cool</p></div>";
                break;
              case 0:
                echo "<div class='row2-hgt'><img src='../pictures/pig.webp' class='basicp'>";
                echo "<p class='ntxt'>either you haven't choose anything yet, or you're lame.</p></div>";
                break;
              case 1:
                echo "<div class='row2-hgt'><img src='../pictures/simple.jpg' class='basicp'>";
                echo "<p class='ntxt'>too simple</p></div>";
                break;
              case 2:
                echo "<div class='row2-hgt'><img src='../pictures/icecream.webp' class='basicp'>";
                echo "<p class='ntxt'>plain. just like you.</p></div>";
                break;
              case 3:
                echo "<div class='row2-hgt'><img src='../pictures/jake.webp' class='basicp'>";
                echo "<p class='ntxt'>i like jake too.</p></div>";
                break;
              case 4:
                echo "<div class='row2-hgt'><img src='../pictures/intelectual.webp' class='basicp'>";
                echo "<p class='ntxt'>you remind me of this guy</p></div>";
                break;
              case 5:
                echo "<div class='row2-hgt'><img src='../pictures/spiderman.avif' class='mefr'>";
                echo "<p class='ntxt'>you might be spiderman</p></div>";
                break;
              case 6:
                echo "<div class='row2-hgt'><img src='../pictures/link.jpg' class='basicp'>";
                echo "<p class='ntxt'>i don't think this does you justice.</p></div>";
                break;
              case 7:
                echo "<div class='row2-hgt'><img src='../pictures/spongebob.webp' class='basicp'>";
                echo "<p class='ntxt'>ur special like this guy</p></div>";
                break;
              case 8:
                echo "<div class='row2-hgt'><img src='../pictures/steve.jpg' class='basicp'>";
                echo "<p class='ntxt'>respectable.</p></div>";
                break;
              case 9:
                echo "<div class='row2-hgt'><img src='../pictures/csteacher.jpg' class='mefr'>";
                echo "<p class='ntxt'>you could be a computer science professor.</p></div>";
                break;
              case 10:
                echo "<div class='row2-hgt'><img src='../pictures/woody.jpg' class='basicp'>";
                echo "<p class='ntxt'>i am truly envious.</p></div>";
                break;
              case 11:
                echo "<div class='row2-hgt'><img src='../pictures/blackguy.jpg' class='mefr'>";
                echo "<p class='ntxt'>just like me fr.</p></div>";
                break;
            }
          ?>
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