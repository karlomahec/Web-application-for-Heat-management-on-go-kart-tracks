<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "kaz_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch kart data
$sql = "SELECT * FROM karts WHERE driveable = 1";
$result = $conn->query($sql);

$karts = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $karts[] = array(
            'number'=> $row['kart_number'],
        );
    }
}
echo json_encode($karts);

$conn->close();
?>