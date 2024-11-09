<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Karting Arena Zagreb</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="img/logoKAZ_neg.png" type="image/x-icon">
  <link rel="shortcut icon" href="img/logoKAZ_neg.png" type="image/x-icon">
  <link rel="stylesheet" href="heat-admin.css">
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
                  <li><b><a href="admin-home.php">Pretraga</a></b></li>
                  <li><b><a href="heat-admin.php">Vožnja</a></b></li>
                  <li><b><a href="karts-admin.php">Status Kartova</a></b></li>
                  <li><b><a href="history-admin.php">Povijest vožnji</a></b></li>
                </ul>
            </nav>
            <b><a class="cta" href="http://localhost/karlo/prijava.html">Odjava</a></b>
            <p class="menu cta">Menu</p>
        </header>
        <div class="overlay">
            <a class="close">&times;</a>
            <div class="overlay__content">
                <b><a href="admin-home.php">Pretraga</a></b>
                <b><a href="heat-admin.php">Vožnja</a></b>
                <b><a href="karts-admin.php">Status Kartova</a></b>
                <b><a href="history-admin.php">Povijest vožnji</a></b>
                <b><a class="cta" href="prijava.html" style="color: black;">Odjava</a></b>
            </div>
        </div>
        <script type="text/javascript" src="mobile.js"></script>


  
<div class="control">
    <h1>Heat Control</h1>
    <div id="heat-info" class="heat-info">
    </div>
    <button class="btn" id="start-button">Start</button>
    <button class="btn" id="pause-button">Pause</button>
    <button class="btn" id="finish-button">Finish</button>
    <div id="timer" class="timer">0:00</div>
</div>

<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "kaz_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    $sql = "SELECT H.id AS heat_id, H.number, H.type, H.duration, U.id AS user_id, U.name, U.email, U.phone_number, U.number_of_drives, U.best_lap_time, U.date_of_birth
                FROM Heats H
                JOIN User_Heats UH ON H.id = UH.heat_id
                JOIN Users U ON UH.user_id = U.id
                ORDER BY H.id, U.id";

    $result = $conn->query($sql);

    // Display the search results in a table
    if ($result->num_rows > 0) {
        echo '<table class="times">';
        echo '<tr><th>Vozač</th><th>Vrijeme kruga</th><th>Najbolji krug</th><th>Broj krugova</th></tr>';
    
        $current_heat_id = -1;
        while ($row = $result->fetch_assoc()) {
        if ($current_heat_id != $row['heat_id']) {
            if ($current_heat_id != -1) {
                break;
            }
        }
        echo '<tr>';
        echo "<td>" . $row['name'] . "</td>";
        echo "<td> </td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "</tr>";
        $current_heat_id = $row['heat_id'];
      }

      echo '</table>';
    } else {
    }
?>


<div class="split-container">
    <div class="left-section">
        <h2>Users</h2>
        <ul id="user-list">
        </ul>
    </div>
    <div class="middle-section">
        <h2>Kart Box State</h2>
        <ul id="kart-box-state">
        </ul>
    </div>
    <div class="right-section">
        <h2>Control</h2>
        <p style="margin:5px">Set duration: </p>
        <input style="margin-top:5px" class="form-style" type="time" id="time-picker">
        <button class="btn" id="report-kart-issue">Report a Kart Issue</button>
        <button class="btn" id="report-driver">Report a Driver</button>
    </div>
</div>

<div id="reportDriverModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeReportModal">&times;</span>
            <h2 style="padding-left:10px">Report a malicious driver</h2>
            <form method="post" action="mailto:karlomahec@gmail.com" method="GET">
                 <div style="display:flex;margin:auto;">
                 <h3 style="padding: 5px;padding-left:10px">Select the number of heat:</h3>
                 <select name="heats" id="heats" class="form-style">
                 <?php
                    // Retrieve heat data from the database
                    $sqlHeats = "SELECT id, number FROM heats";
                    $resultHeats = $conn->query($sqlHeats);

                    // Generate the options for the select element
                    while ($rowHeat = $resultHeats->fetch_assoc()) {
                        echo '<option value="' . $rowHeat['id'] . '">' . $rowHeat['number'] . '</option>';
                    }
                ?>
                </select>
                </div>
                <div style="display:flex;margin:auto;">
                <h3 style="padding: 5px;padding-left:10px">Select the malicious drivers:</h3>
                <multi-input> 
                    <input list="users" name="selected_users" class="form-style">
                    <datalist id="users">
                    <?php
                        // Retrieve heat data from the database
                        $sqlUsers = "SELECT id, name FROM users";
                        $resultUsers = $conn->query($sqlUsers);

                        // Generate the options for the select element
                        while ($rowUser = $resultUsers->fetch_assoc()) {
                            echo '<option value="' . $rowUser['id'] . '">' . $rowUser['name'] . '</option>';
                        }
                    ?>
                    </datalist>
                </multi-input>
                </div>
                <div style="display:flex;justify-content:center;align-items:center;">
                <button id="get" class="issuebtn">Unesi</button>
            </form>
            </div>
        </div>
    </div>
    <div class="backdrop" id="backdrop">
        
    </div>

<script>
    var reportDriverModal = document.getElementById("reportDriverModal");
    var reportDriver = document.getElementById("report-driver");
    var closeReportModal = document.getElementById("closeReportModal");
    var reportkartissue = document.getElementById("report-kart-issue");

    reportkartissue.onclick = function(){
        window.location.href = 'karts-admin.php';
    }

    reportDriver.onclick = function(){
        reportDriverModal.style.display = "block";
        document.getElementById("backdrop").style.display = "block";
        document.body.classList.add("blur-effect");
    }
    closeReportModal.onclick = function(){
        reportDriverModal.style.display = "none";
        document.getElementById("backdrop").style.display = "none";
        document.body.classList.add("blur-effect");
    }
     // Close the modals when the user clicks outside the modal
     window.onclick = function (event) {
        if (event.target == reportDriverModal) {
            reportDriverModal.style.display = "none";
            document.getElementById("backdrop").style.display = "none";
		    document.body.classList.remove("blur-effect");
        }
    }
    // Add an event listener to the time picker input
    const timePicker = document.getElementById("time-picker");
    timePicker.addEventListener("change", function () {
        const selectedTime = timePicker.value; // Get the selected time
        updateHeatDuration(selectedTime); // Call a function to update the duration
    });

    // Function to update the heat duration in the database
    function updateHeatDuration(newDuration) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "heat-duration.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        
        // Define the data to send to the server
        const data = `currentID=${currentHeatID}&newDuration=${newDuration}`;
        
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the server response if needed
            }
        };
        
        xhr.send(data);
    }
</script>

<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "kaz_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
  ?>

<script src="control.js"></script>

<footer>
            <div class="heats">
            <div class="center-content">
            <?php
                $sql = "SELECT H.id AS heat_id, H.number, H.type, H.duration, U.id AS user_id, U.name, U.email, U.phone_number, U.number_of_drives, U.best_lap_time, U.date_of_birth
                FROM Heats H
                JOIN User_Heats UH ON H.id = UH.heat_id
                JOIN Users U ON UH.user_id = U.id
                ORDER BY H.id, U.id";


                $result = $conn->query($sql);

                // Initialize a variable to keep track of the current heat
                $current_heat_id = -1;

                // Iterate through the result and display users by heats
                while ($row = $result->fetch_assoc()) {
                    // If the heat changes, start a new table for the new heat
                    if ($current_heat_id != $row['heat_id']) {
                        if ($current_heat_id != -1) {
                            break;
                        }
                        echo '<table border="0" style="background-color:white;">';
                        echo '<tr><th style="padding:20px;">'. $row['type'] . $row['number'].'<br>' . $row['duration'] . '</th>';
                        
                        $current_heat_id = $row['heat_id'];
                        
                    }
                    echo '<td>';
                    echo '<div class="userdiv">';
                    echo $row['name'] . '<br>';
                    $dateOfBirth = new DateTime($row['date_of_birth']);
                    $currentDate = new DateTime();
                    $age = $currentDate->diff($dateOfBirth)->y;
                    echo $age. '<br>';
                    echo $row['number_of_drives']. '<br>';
                    echo $row['best_lap_time']. '<br>';
                    echo '</td>';
                }

                // Close the last table
                if ($current_heat_id != -1) {
                    echo '</table>';
                }
            ?>
            </div>
          </footer>
    </body>
</html>