<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Karting Arena Zagreb</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="img/logoKAZ_neg.png" type="image/x-icon">
  <link rel="shortcut icon" href="img/logoKAZ_neg.png" type="image/x-icon">
  <link rel="stylesheet" href="admin-home.css">
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


        <form method="GET" action="" style="padding:50px;">
          <input class="form-style" type="text" name="search_query" placeholder="Search users by name">
          <input class="btn" type="submit" value="Search">
        </form>

  <?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "kaz_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
  // The PHP code for fetching and displaying data goes here (same as before)

  // Check if the search form is submitted
  if (isset($_GET['search_query']) && !empty($_GET['search_query'])) {
    $search_query = $_GET['search_query'];

    // Modify the SQL query to search for users by name
    $sql = "SELECT U.id AS user_id, U.name, U.email, U.phone_number, U.number_of_drives, U.best_lap_time, U.date_of_birth
            FROM Users U
            WHERE U.name LIKE '%$search_query%'
            ORDER BY U.id";

    $result = $conn->query($sql);

    // Display the search results in a table
    if ($result->num_rows > 0) {

      echo '<table class="searched">';
      echo '<tr><th>Name</th><th>Email</th><th>Phone Number</th><th>Number of Drives</th><th>Best Lap Time</th><th>Date of Birth</th></tr>';

      while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['phone_number'] . "</td>";
        echo "<td>" . $row['number_of_drives'] . "</td>";
        echo "<td>" . $row['best_lap_time'] . "</td>";
        echo "<td>" . $row['date_of_birth'] . "</td>";
        echo "</tr>";
      }

      echo '</table>';
    } else {
      echo '<p>No results found for "' . $search_query . '".</p>';
    }
  }
  ?>

<?php
    $sqlUsers = "SELECT COUNT(*) AS user_count FROM Users";
    $sqlHeats = "SELECT COUNT(DISTINCT heat_id) AS heat_count FROM user_heats";
    $sqlKarts = "SELECT COUNT(DISTINCT id) AS kart_count FROM karts WHERE driveable='1'";

    $resultUsers = $conn->query($sqlUsers);
    $resultHeats = $conn->query($sqlHeats);
    $resultKarts = $conn->query($sqlKarts);

    $userData = $resultUsers->fetch_assoc();
    $heatData = $resultHeats->fetch_assoc();
    $kartData = $resultKarts->fetch_assoc();

    echo '<table class="searched">';
    echo '<tr>';
    echo '<th>Broj novoregistriranih korisnika</th>';
    echo '<td>' . $userData['user_count'] . '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th>Broj vožnji</th>';
    echo '<td>' . $heatData['heat_count'] . '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th>Broj kartova u funkciji</th>';
    echo '<td>' . $kartData['kart_count'] . '</td>';
    echo '</tr>';
    echo '</table>';
?>



        <footer class="page-footer">
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