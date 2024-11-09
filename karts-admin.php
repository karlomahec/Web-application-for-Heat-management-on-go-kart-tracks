<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Karting Arena Zagreb</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="img/logoKAZ_neg.png" type="image/x-icon">
  <link rel="shortcut icon" href="img/logoKAZ_neg.png" type="image/x-icon">
  <link rel="stylesheet" href="karts-admin.css">
  <link href='https://fonts.googleapis.com/css?family=Atkinson Hyperlegible' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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


        <div class ="issue">
            <p class="title">Order an issue</p>
            <div class="subissue">
            <div class ="issue-image">
                <img src ="img/kart-form.png" usemap="#kartmap">
                <map name="kartmap">
                    <area shape="rect" coords="320,102,251,238" alt="Front-bumper" title="Front-bumper">
                    <area shape="circle" coords="148,182,48" alt="Front-wheels" title="Front-wheels">
                    <area shape="rect" coords="8,87,219,232" alt="Side-bumper" title="Side-bumper">
                    <area shape="rect" coords="205,54,314,154" alt="Nose" title="Nose">
                    <area shape="rect" coords="172,99,201,73" alt="Fuel-tank" title="Fuel-tank">
                    <area shape="rect" coords="169,47,219,22" alt="Wheel" title="Wheel">
                    <area shape="rect" coords="32,43,123,79" alt="Engine" title="Engine">
                    <area shape="rect" coords="211,158,257,132" alt="Pedals" title="Pedals">
                    <area shape="circle" coords="82,17,25" alt="Exhaust" title="Exhaust">
                    <area shape="circle" coords="23,78,19" alt="Back-wheels" title="Back-wheels">
                    <area shape="circle" coords="108,17,84" alt="Seat" title="Seat">
                </map>
            </div>
            <div class ="issue-form">
            <form method="post">
                 <div style="display:flex;justify-content:baseline;align-items:left;">
                 <select name="kartnumber" id="karts" class="form-style">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
            </select>
            <multi-input> 
                <input list="parts" name="selected_parts" class="form-style">
                <datalist id="parts">
                    <option value="Front-bumper"></option>
                    <option value="Front-wheels"></option>
                    <option value="Side-bumper"></option>
                    <option value="Nose"></option>
                    <option value="Fuel-tank"></option>
                    <option value="Engine"></option>
                    <option value="Wheel"></option>
                    <option value="Pedals"></option>
                    <option value="Exhaust"></option>
                    <option value="Back-wheels"></option>
                    <option value="Seat"></option>
                </datalist>
            </multi-input>
                 </div>
            
            <textarea class="form-style" rows="6" cols="50" placeholder="Describe the issue with the kart..." name="description" id="description"></textarea>
            <br>
            <button id="get" class="issuebtn">Pošalji</button>
            </form>
            </div>
            </div>
        </div>

        <script src="scripts.js"></script>

        <script>
            const getButton = document.getElementById('get');
            const multiInput = document.querySelector('multi-input'); 
            const desc = document.getElementById('description');
            const number = document.getElementById('karts');

            getButton.addEventListener('click', function() {
                const selectedValues = multiInput.getValues().join(' and ');
                
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            window.location.reload();
                        } else {
                            console.error('Error:', xhr.statusText);
                        }
                    }
                };

                const formData = `kartnumber=${encodeURIComponent(number.value)}&selected_parts=${encodeURIComponent(selectedValues)}&description=${encodeURIComponent(desc.value)}`;
                xhr.send(formData);
            });
            
        </script>

        <?php
            $servername = "127.0.0.1";
            $username = "root";
            $password = "";
            $dbname = "kaz_db";
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['kartnumber'], $_POST['selected_parts'], $_POST['description'])) {
                    $kart_number = $_POST['kartnumber'];
                    $selected_parts = $_POST['selected_parts'];
                    $description = $_POST['description'];
                    $driveable = empty($description) ? 1 : 0;
                    $conn = new mysqli($servername, $username, $password, $dbname);
            
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $sql = "UPDATE Karts SET parts_to_fix = '$selected_parts', description = '$description', driveable = $driveable WHERE kart_number = $kart_number";
            
                    if ($conn->query($sql) === TRUE) {
                    } else {
                        echo "Error updating Kart data: " . $conn->error;
                    }
                    $conn->close();
                } else {
                    echo '<script>alert("Fill all fields");</script>';
                }
            }
        ?>

        <script src="multi-input.js"></script>
        <script src="scripts.js"></script>

        <div class ="fleet">
        <?php

            $servername = "127.0.0.1";
            $username = "root";
            $password = "";
            $dbname = "kaz_db";

            // Create a connection to the database
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check the connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // SQL query to fetch all Karts data
            $sql = "SELECT * FROM Karts";

            // Execute the query
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo '<table>';
                echo '<tr style="background-color: rgb(179, 179, 179);"><th>Kart Number</th><th>Description</th><th>Parts to Fix</th><th>Driveable</th></tr>';

                // Loop through the result set and display data in the table
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td width="100px" style="text-align:center">' . $row['kart_number'] . '</td>';
                    echo '<td>' . $row['description'] . '</td>';
                    echo '<td>' . $row['parts_to_fix'] . '</td>';
                    echo '<td width="150px"  style="text-align:center;display:flex;margin:auto;margin-right:15px;">' . ($row['driveable'] ? 
                    '<p style="color:green;font-size:20px;padding-top:10px;padding-bottom:10px;">&#10004; </p>' : 
                    '<p style="color:red;font-size:30px">&times; </p> 
                    <form class="resolve-form" action="resolve-issue.php" method="post">
                    <input type="hidden" name="kart_number" value="' . $row['kart_number'] . '">
                    <button id="resolve" class="btn">Resolve issue</button></form>') . 
                    '</td>';
                    
                    echo '</tr>';
                    
                }
                
                echo '</table>';
            } else {
                echo '<p>No Karts data available.</p>';
            }
        ?>
    </div>

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