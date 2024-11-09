<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "kaz_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$currentID = $_GET['currentID']; // Get the currentID from the client

// Select the next heat using the currentID
$query = "SELECT number, type, duration FROM heats WHERE id = $currentID";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $heatInfo = $result->fetch_assoc();
    echo json_encode($heatInfo);
} else {
    echo "No heats found";
}

?>
