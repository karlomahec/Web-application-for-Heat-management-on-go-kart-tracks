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
  <link rel="stylesheet" href="natjecanja.css">
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

        <div style="text-align: center;">
            <p class="title">Natjecateljski programi</p>
        </div>

        <script>
            function addHoverClass(element) {
                element.classList.add("hovered");
            }

            function removeHoverClass(element) {
                element.classList.remove("hovered");
            }
        </script>

        
         <div class="competitioncontainer" onmouseover="addHoverClass(this)" onmouseout="removeHoverClass(this)" style="background:url(img/sprint_pozadina.png) no-repeat;box-shadow: 0 0 0 1000px rgba(0,0,0,0.5) inset;">
            <div class="competitiontitle">
                <p class="subtitle">SWS Sprint Cup</p>
                <img src="img/sprint.JPG">
            </div>
            <div class="competitiondesc">
                <img src="img/sprintrules.png" style="padding-bottom: 60px;object-fit: contain;">
                <div>
                    <p class="description"><b>Što je SWS Sprint Cup?</b><br>
                        U naumu popularizacije rental kartinga kao 
                        amaterskog sporta u Republici Hrvatskoj i 
                        susjednim zemljama, Karting Arena Zagreb u 
                        partnerstvu sa Sodijem, vodećim globalnim 
                        proizvođačem karting vozila, organizira SWS 
                        Sprint Cup – natjecanje od devet (9) utrka koje 
                        će se održavati od listopada do lipnja iduće 
                        godine.
                    </p>
                        <p class="description"><b>Pravila natjecanja</b><br>
                        Svi natjecatelji dužni su proučiti pravilnik. 
                        Pravilnik je podložan promjenama i vozači su dužni pratiti izmjene u pravilniku. 
                        Organizator je dužan obavijestiti sve sudionike prvenstva o promjenama. 
                        Pravilnik natjecanja možete preuzeti putem linka dolje:
                    </p>
                    <div style="display: flex;justify-content: center;padding: 20px;">
                        <button class="glow-button-blue" style="background-color:rgb(0, 153, 255);" onclick="openPDF('pdf/SWS_Sprint_Cup_Rulebook_23_24_draft.pdf')">Preuzmi pravilnik</button>
                    </div>
                </div>
            </div>
            <div class="dropdown">
                <a href="mailto:kartingmahec@gmail.com?subject=Pretplata&body=Ime%20i%20prezime:%0ASWS%20ID:%0AJeste%20li%20ve%C4%87%20vozili%20u%20Karting%20Areni%20Zagreb%3F%0AJeste%20li%20ve%C4%87%20sudjelovali%20u%20natjecateljskom%20programu%20Karting%20Arene%20Zagreb%3F%0AProgram:%20Sprint%20Cup">
                    <button class="glow-button-blue" style="background-color:rgb(0, 153, 255); z-index: -1; margin-right: 20px;">Pretplati se</button>
                </a>
            </div>
        </div>

        
        

        <div class="competitioncontainer" onmouseover="addHoverClass(this)" onmouseout="removeHoverClass(this)" style="background:url(img/Background-Design-Endurance.png) no-repeat;box-shadow: 0 0 0 1000px rgba(0,0,0,0.5) inset;">
            <div class="competitiontitle">
                <p class="subtitle">SWS Endurance Cup</p>
                <img src="img/endu-pravila.JPG">
            </div>
            <div class="competitiondesc">
                <img src="img/endurance.png" style="object-fit:contain;">
                <div>
                    <p class="description"><b>Što je SWS Endurance Cup?</b><br>
                        Karting Arena Zagreb u partnerstvu sa Sodijem, vodećim globalnim proizvođačem karting vozila, 
                        organizira SWS Endurance Cup – natjecanje od pet timskih utrka idržljivosti koje će se održavati 
                        od listopada 2022. do lipnja 2023. godine.
                    </p>
                        <p class="description"><b>Pravila natjecanja</b><br>
                        Svi natjecatelji dužni su proučiti pravilnik. 
                        Pravilnik je podložan promjenama i vozači su dužni pratiti izmjene u pravilniku. 
                        Organizator je dužan obavijestiti sve sudionike prvenstva o promjenama. 
                        Pravilnik natjecanja možete preuzeti putem linka dolje:
                    </p>
                    <div style="display: flex;justify-content: center;padding: 20px;">
                        <button class="glow-button-red" onclick="openPDF('pdfs/SWS_Endurance_Cup_Rulebook_22_23_draft_2')" style="background-color:rgb(255, 0, 0);" onclick="openPDF('pdfs/SWS_Endurance_Cup_Rulebook_22_23_draft_2.pdf')">Preuzmi pravilnik</button>
                    </div>
                </div>
            </div>
            <div class="dropdown">
                <a href="mailto:kartingmahec@gmail.com?subject=Pretplata&body=Ime%20i%20prezime:%0ASWS%20ID:%0AJeste%20li%20ve%C4%87%20vozili%20u%20Karting%20Areni%20Zagreb%3F%0AJeste%20li%20ve%C4%87%20sudjelovali%20u%20natjecateljskom%20programu%20Karting%20Arene%20Zagreb%3F%0AProgram:%20Endurance%20Cup">
                    <button class="glow-button-red" style="background-color:rgb(255, 0, 0); z-index: -1; margin-right: 20px;">Pretplati se</button>
                </a>
            </div>
        </div>

        <div class="competitioncontainer" onmouseover="addHoverClass(this)" onmouseout="removeHoverClass(this)" style="background:url(img/mini_pozadina.png) no-repeat;box-shadow: 0 0 0 1000px rgba(0,0,0,0.5) inset;">
            <div class="competitiontitle">
                <p class="subtitle">SWS Junior Cup</p>
                <img src="img/junior.JPG">
            </div>
            <div class="competitiondesc">
                <img class="junior" src="img/junior-rules.png">
                <div>
                    <p class="description"><b>Što je SWS Junior Cup?</b><br>
                        U naumu popularizacije rental kartinga kao amaterskog sporta među djecom u Republici Hrvatskoj i susjednim zemljama, 
                        Karting Arena Zagreb u partnerstvu sa Sodijem, vodećim globalnim proizvođačem karting vozila, organizira SWS Junior Cup i 
                        SWS Junior Kids Cup natjecanja. Natjecanja će se održavati kao jedan kombinirani event, od listopada 2022. do lipnja 2023. godine. 
                        Premda dijele infrastrukturu i resurse Organizatora, SWS Junior Cup i SWS Junior Kids Cup su dva odvojena prvenstva.
                    </p>
                        <p class="description"><b>Pravila natjecanja</b><br>
                        Svi natjecatelji dužni su proučiti pravilnik. 
                        Pravilnik je podložan promjenama i vozači su dužni pratiti izmjene u pravilniku. 
                        Organizator je dužan obavijestiti sve sudionike prvenstva o promjenama. 
                        Pravilnik natjecanja možete preuzeti putem linka dolje:
                    </p>
                    <div style="display: flex;justify-content: center;padding: 20px;">
                        <button class="glow-button-orange" onclick="openPDF('pdfs/SWS_Junior_Cup_Rulebook_22_23_draft_05.pdf')"  style="background-color:rgb(255, 145, 0);">Preuzmi pravilnik</button>
                    </div>
                </div>
            </div>
            <div class="dropdown">
                <a href="mailto:kartingmahec@gmail.com?subject=Pretplata&body=Ime%20i%20prezime:%0ASWS%20ID:%0AJeste%20li%20ve%C4%87%20vozili%20u%20Karting%20Areni%20Zagreb%3F%0AJeste%20li%20ve%C4%87%20sudjelovali%20u%20natjecateljskom%20programu%20Karting%20Arene%20Zagreb%3F%0AProgram:%20Junior%20Cup">
                    <button class="glow-button-orange" style="background-color:rgb(255, 145, 0); z-index: -1; margin-right: 20px;">Pretplati se</button>
                </a>
            </div>
        </div>

        <div class="competitioncontainer" onmouseover="addHoverClass(this)" onmouseout="removeHoverClass(this)" onmouseover="addHoverClass(this)" onmouseout="removeHoverClass(this)" style="background:url(img/babababab.png) no-repeat;box-shadow: 0 0 0 1000px rgba(0,0,0,0.5) inset;">
            <div class="competitiontitle">
                <p class="subtitle">Mini Cup</p>
                <img src="img/mini.JPG">
            </div>
            <div class="competitiondesc">
                <img class="mini" src="img/mini-pravila.png" >
                <div>
                    <p class="description"><b>Što je Mini Cup?</b><br>
                        U naumu popularizacije rental kartinga kao amaterskog sporta u Republici Hrvatskoj i susjednim zemljama, 
                        Karting Arena Zagreb organizira Mini Cup – natjecanje od devet (9) utrka namijenjeno najmlađim vozačima, 
                        koje će se održavati od listopada 2022. do lipnja 2023. godine.
                    </p>
                        <p class="description"><b>Pravila natjecanja</b><br>
                        Svi natjecatelji dužni su proučiti pravilnik. 
                        Pravilnik je podložan promjenama i vozači su dužni pratiti izmjene u pravilniku. 
                        Organizator je dužan obavijestiti sve sudionike prvenstva o promjenama. 
                        Pravilnik natjecanja možete preuzeti putem linka dolje:
                    </p>
                    <div style="display: flex;justify-content: center;padding: 20px;">
                        <button class ="glow-button-pink" onclick="openPDF('pdfs/Mini_Cup_Rulebook_22_23.pdf')" style="background-color:rgb(255, 0, 76);">Preuzmi pravilnik</button>
                    </div>
                </div>
            </div>
            <div class="dropdown">
                <a href="mailto:kartingmahec@gmail.com?subject=Pretplata&body=Ime%20i%20prezime:%0ASWS%20ID:%0AJeste%20li%20ve%C4%87%20vozili%20u%20Karting%20Areni%20Zagreb%3F%0AJeste%20li%20ve%C4%87%20sudjelovali%20u%20natjecateljskom%20programu%20Karting%20Arene%20Zagreb%3F%0AProgram:%20Mini%20Cup">
                    <button class="glow-button-pink" style="background-color:rgb(255, 0, 76); z-index: -1; margin-right: 20px;">Pretplati se</button>
                </a>
            </div>
        </div>

        <script>
            function openPDF(pdfPath) {
                window.open(pdfPath, '_blank'); // This will open the PDF in a new tab/window
            }
        </script>

        <div class="overlay_container"></div>

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
