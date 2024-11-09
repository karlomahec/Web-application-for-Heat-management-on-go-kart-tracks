<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "kaz_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to calculate the number of drivers and free spaces
function calculateDriversAndFreeSpaces($driversSignedUp) {
    $totalDrivers = 12;
    $freeSpaces = $totalDrivers - $driversSignedUp;
    return [$totalDrivers, $freeSpaces];
}

// Fetch the first 7 heats from the database
$query = "SELECT id, number, type, duration, time_of_day FROM heats ORDER BY time_of_day ASC LIMIT 7";
$result = $conn->query($query);

$heats = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $heats[] = $row;
    }
}
?>
<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Karting Arena Zagreb</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="img/logoKAZ_neg.png" type="image/x-icon">
  <link rel="shortcut icon" href="img/logoKAZ_neg.png" type="image/x-icon">
  <link href='https://fonts.googleapis.com/css?family=Atkinson Hyperlegible' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Slick Carousel CSS -->
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
  <!-- Slick Carousel JS -->
  <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script src="mobile.js"></script>
</head>
    <body>
        <header>
            <a class="logo" href="/"><img src="img/logoKAZ_neg.png" alt="logo"></a>
            
            <nav>
                <ul class="nav__links">
                  <li><b><a href="index.php">Početna</a></b></li>
                  <li><b><a href="cjenik.html">Cjenik</a></b></li>
                  <li><b><a href="onama.html">O nama</a></b></li>
                  <li><b><a href="dostupnost.html">Dostupnost</a></b></li>
                  <li><b><a href="natjecanja.html">Natjecanja</a></b></li>
                </ul>
            </nav>
            <b><a class="cta" href="prijava.html">Prijava</a></b>
            <p class="menu cta">Menu</p>
        </header>
        <div class="overlay">
            <a class="close">&times;</a>
            <div class="overlay__content">
              <b><a href="index.php">Početna</a></b
                <b><a href="cjenik.html">Cjenik</a></b>
                <b><a href="onama.html">O nama</a></b>
                <b><a href="dostupnost.html">Dostupnost</a></b>
                <b><a href="natjecanja.html">Natjecanja</a></b>
                <b><a class="cta" href="prijava.html" style="color: black;">Prijava</a></b>
            </div>
        </div>
        <script type="text/javascript" src="mobile.js"></script>
        
        <div class="carousel">
          <div class="image-wrapper">
            <div class="image-description">10-minutna<br>vožnja</div>
            <div class="image" style="background-image: linear-gradient(to bottom right, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 1) 70%),url(img/indivi.jpg);background-size: cover;"></div>
          </div>
          <div class="image-wrapper">
            <div class="image-description">Grand Prix<br>Advanced</div>
            <div class="image" style="background-image: linear-gradient(to bottom right, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 1) 70%),url(img/gpa.jpg);background-size: cover;"></div>
          </div>
          <div class="image-wrapper">
            <div class="image-description">Mini Grand<br>Prix</div>
            <div class="image" style="background-image: linear-gradient(to bottom right, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 1) 70%),url(img/mgp.jpg);background-size: cover;"></div>
          </div>
          <div class="image-wrapper">
            <div class="image-description">10-minutna<br>vožnja</div>
            <div class="image" style="background-image: linear-gradient(to bottom right, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 1) 70%),url(img/indivi.jpg);background-size: cover;"></div>
          </div>
          <div class="image-wrapper">
            <div class="image-description">Grand Prix<br>Advanced</div>
            <div class="image" style="background-image: linear-gradient(to bottom right, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 1) 70%),url(img/gpa.jpg);background-size: cover;"></div>
          </div>
          <div class="image-wrapper">
            <div class="image-description">Mini Grand<br>Prix</div>
            <div class="image" style="background-image: linear-gradient(to bottom right, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 1) 70%),url(img/mgp.jpg);background-size: cover;"></div>
          </div>
        </div>
        
        <script>
          $(document).ready(function() {
            $('.carousel').slick({
              slidesToShow: 3,
              slidesToScroll: 3,
              autoplay: true,
              autoplaySpeed: 5000,
              centerMode: true,
              centerPadding: '0px',
              prevArrow: '',
              nextArrow: '',
              responsive: [
                {
                  breakpoint: 1000,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                  }
                }
              ]
            });
          });
        </script>
        
        <div class="container">
        <div class="left-segment">
            <div class="schedule-container">
                <div class="schedule-title">
                    <h2>Raspored danas</h2>
                </div>
                <?php foreach ($heats as $heat) {
                    // Fetch the number of drivers signed up for the heat from your user_heats database
                    $query = "SELECT COUNT(*) AS drivers_signed_up FROM user_heats WHERE heat_id = " . $heat['id'];
                    $result = $conn->query($query);
                    $driversSignedUp = 0;
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $driversSignedUp = $row['drivers_signed_up'];
                    }
                    list($totalDrivers, $freeSpaces) = calculateDriversAndFreeSpaces($driversSignedUp);
                ?>
                <div class="schedule">
                    <div class="time"><?php echo date('h:i A', strtotime($heat['time_of_day'])); ?></div>
                    <div class="line"></div>
                    <div class="info">
                        <p>Drivers: <?php echo $driversSignedUp; ?></p>
                        <p>Free Spaces: <?php echo $freeSpaces; ?></p>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
          <div class="middle-segment">
              <h2>Trenutna konfiguracija</h2>
              <img src="img/konfa.png" alt="Image">
          </div>
          <?php
            $query = "SELECT name, best_lap_time FROM users WHERE best_lap_time IS NOT NULL ORDER BY best_lap_time ASC LIMIT 15";
            $result = mysqli_query($conn, $query);

            if ($result) {
                echo '<div class="right-segment">';
                echo '<h2 style="text-align: center;">Top vozači</h2>';
                echo '<div class="leaderboard">';
                
                $position = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    $name = $row['name'];
                    $bestTime = $row['best_lap_time'];

                    echo '<p>' . $position . '. ' . $name . ' <span class="best-time">Best Time: ' . $bestTime . '</span></p>';
                    
                    $position++;
                }

                echo '</div>';
                echo '</div>';
            } else {
                echo 'Error: ' . mysqli_error($conn);
            }
            mysqli_close($conn);
        ?>
      </div>

      <div class="container2">
        <div class="left">
          <div class="title">Raspored vožnji</div>
          <div class="top-left" style="margin-top: 30px;">
            <p>Vožnje za odrasle:</p>
            <p>PON – ČET: 16:00 – 23:00</p>
            <p>PET: 14:00 – 23:00</p>
            <p>SUB/NED: 13:00 – 23:00</p>
          </div>
          <div class="bottom-right" style="margin-bottom: 30px;">
            <p>Dječje vožnje:</p>
            <p>UTO/ČET: 14:00 – 16:00</p>
            <p>SUB/NED: 09:00 – 13:00</p>
          </div>
        </div>
        <div class="right">
          <div class="title">Hotlap - Tutorial</div>
          <div class="video-container">
          <video controls>
            <source src="videos/hotlap-tutorial.mkv" type="video/mp4">
            Your browser does not support the video tag.
          </video>
          </div>  
        </div>
      </div>

        <footer class="page-footer">
            <div class="center-content">
                <i class="fa fa-phone"></i><b style="margin-right: 5px;">Telefon:</b> 01 5814 721<br>
                <i class="fa fa-envelope"></i><b style="margin-right: 5px;">E-mail: </b> info@karting-arena.com<br>
                <i class="fa fa-map-marker"></i><b style="margin-right: 5px;">Lokacija:</b> Zagrebački Velesajam p.35
            </div>
        
            <div class="social-icons">
              <a href="#"><i class="fa fa-facebook"></i></a>
              <a href="#"><i class="fa fa-twitter"></i></a>
              <a href="#"><i class="fa fa-instagram"></i></a>
            </div>
        
            <div class="nav__links" style="justify-content: center; margin-top: 10px;">
              <a href="#" >Terms of Service</a> ||
              <a href="#"style="margin-left:20px ;">Privacy Policy</a> ||
              <a href="#"style="margin-left:20px ;">Copyright</a>
            </div>
          </footer>
    </body>
</html>
