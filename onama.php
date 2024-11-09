<?php
// Start the session (this should be at the beginning of the page)
session_start();
?>
<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Karting Arena Zagreb</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="img/logoKAZ_neg.png" type="image/x-icon">
  <link rel="shortcut icon" href="img/logoKAZ_neg.png" type="image/x-icon">
  <link rel="stylesheet" href="onama.css">
  <link rel="stylesheet" href="user.css">
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
                  <li><b><a href="index-login.php">Početna</a></b></li>
                  <li><b><a href="cjenik-login.php">Cjenik</a></b></li>
                  <li><b><a href="onama.php">O nama</a></b></li>
                  <li><b><a href="dostupnost-login.php">Dostupnost</a></b></li>
                  <li><b><a href="natjecanja.php">Natjecanja</a></b></li>
                </ul>
            </nav>
            <div class="userbox">
              <button onclick="openPopup()"><i class="fa fa-user"></i></button>
              <b><a class="cta" href="prijava.html">Odjava</a></b>
            </div>
            <p class="menu cta">Menu</p>
        </header>
        <div class="overlay">
            <a class="close">&times;</a>
            <div class="overlay__content">
                <b><a href="index-login.php">Početna</a></b>
                <b><a href="cjenik-login.php">Cjenik</a></b>
                <b><a href="onama.php">O nama</a></b>
                <b><a href="dostupnost-login.php">Dostupnost</a></b>
                <b><a href="natjecanja.php">Natjecanja</a></b>
                <b><a class="cta" href="prijava.html" style="color: black;">Odjava</a></b>
            </div>
        </div>
        <script type="text/javascript" src="mobile.js"></script>

        <div class="popup-container" id="popup">
        <div class="popup-content">
            <p>User Details</p>
            <p>Name: <?php echo $_SESSION['user_name']; ?></p>
            <p>Email: <?php echo $_SESSION['user_email']; ?></p>
            <p>Phone number: <?php echo $_SESSION['phone']; ?></p>
            <p>Date of birth: <?php echo $_SESSION['date']; ?></p>
            <br>
            <hr>
            <br>
            <p>Personal best lap: <?php echo $_SESSION['best_lap']; ?></p>
            <p>Number of drives: <?php echo $_SESSION['num_drives']; ?></p>
            <p><a color="white" onclick="closePopup()">&times;</a></p>
        </div>
        </div>

        <script>
          function openPopup() {
            document.getElementById("popup").style.display = "block";
          }

          function closePopup() {
            document.getElementById("popup").style.display = "none";
            document.body.style.overflow = "auto"; // Enable scrolling on the main content
          }

          document.querySelector(".userbox button").addEventListener("click", openPopup);

        </script>

        <div style="width: 60%; margin: auto;margin-top: 50px;">
            <p class="title">Naša priča</p>
            <p class="description">Karting Arena Zagreb<br>
                svoja je vrata otvorila u studenom 2011. godine te je tako postala prva “indoor" i “outdoor” staza u Hrvatskoj 
                i jedna od najvećih u ovom dijelu Europe. Naših više od 95.000 registriranih članova svakodnevno uživa u 
                vrhunsko pripremljenoj karting floti i naprednim timing sustavom za mjerenje vremena. Indoor i outoor 
                staza svojom konfiguracijom pružaju vrhunski doživljaj sportske vožnje.</p>
        </div>

        <div>
            <p class="title" style="margin-left: 140px;">Kartovi</p>
        <div class="kartcontainer">
            <div class="left">
                <img src="img/novi_kartovi.jpg" height="400" width="650" style="padding: 20px;object-fit: contain;">
                <div style="margin-left: 50px;margin-right: 80px;">
                    <p class="subtitle">Sodi SR5 270CC go-kart</p>
                <p class="description">Idealni za razvijanje vlastite vještine vožnje uz snažnih 270 
                    kubika i 12,5 konjskih snaga. Najveća moguća dostignuta 
                    brzina u kartu je 45km/h, no bez obzira na velike brzine, 
                    prilagođeni su sigurnosti svakog vozača</p>
                <p style="font-size: 15px;color: gray;margin-bottom: 10px;">*Sodi RX-8 može voziti osoba s 15+ godina</p>
            
                </div>
            </div>
            <div class="right">
                <img src="img/zeleni.jpg" height="400" width="750" style="padding: 20px;object-fit: contain;">
                <div style="margin-left: 50px;margin-right: 80px;">
                    <p class="subtitle">TB Kart R13 120CC</p>
                <p class="description">Vaše dijete želi voziti kart iako je mlađi od 15 godina? Imamo 
                    rješenje! TB Kart R13 najsigurniji je “manji” kart na svijetu te je 
                    prilagodljiv svakom djetetu. Uz 120 kubika svako dijete je u 
                    mogućnosti iskusiti adrenealinsku vožnju te biti osiguran</p>
                <p style="font-size: 15px;color: gray;">*TB Kart R13 može voziti osoba od 5-15 godina</p>
            
                </div>
            </div>
        </div>
        </div> 
        
        <div>
            <p class="title" style="margin-left: 140px;margin-top: 50px;">Staza</p>

            <div class="trackcontainer">
                <div class="subtrackcontainer">
                    <img src="img/staza.jpg" height="400" width="550" style="object-fit: contain;">
                    <div class="middledesc">
                        <p class="description">
                            Karting Arena Zagreb prvi je INDOOR/OUTDOOR kartodrom u Hrvatskoj i jedan od najvećih u ovom dijelu Europe. Iskusite 
                            kvalitetne i vrhunsko pripremljene go karte. Naša tehnička služba dnevno servisira sve go karte kako bi 
                            bili tehnički besprijekorni.
                            <br>
                            Staza je duga 365 m, a široka između 6 i 10 m. Stručno izabrana trasa s podnim 
                            premazom, koji simulira držanje pneumatika na stazi Formule 1, jamči izuzetan doživljaj sportske vožnje.

                        </p>
                    </div>
                    <img src="img/outdoor.jpg" height="400" width="550" style="object-fit: contain;">    
                </div>
            </div>
        </div>

        <div>
            <p class="title" style="margin-left: 140px;margin-top: 50px;">Staza</p>

            <div class="contactcontainer">
                <div style="display: flex;">
                    <i class="fa fa-map-marker"></i>
                    <p class="description" style="color: black;text-decoration: underline;">FUNEXPERIENCE d.o.o. Avenija Dubrovnik 15 Zagrebački Velesajam, Ulaz Istok III, Paviljon 35 Zagreb</p>
                </div>
                <div style="display: flex;">
                    <i class="fa fa-phone"></i>
                    <p class="description" style="color: black;text-decoration: underline;">+385 1 7787534</p>
                </div>
                <div style="display: flex;">
                    <i class="fa fa-envelope"></i>
                    <p class="description" style="color: black;text-decoration: underline;">info@karting-arena.com</p>
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
