<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "kaz_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$currentID = $_POST['currentID'];
$newDuration = $_POST['newDuration'];

// Update the duration in the database for the current heat
$query = "UPDATE heats SET duration = '$newDuration' WHERE id = $currentID";

if ($conn->query($query) === TRUE) {
    echo "Duration updated successfully";
} else {
    echo "Error updating duration: " . $conn->error;
}


?>