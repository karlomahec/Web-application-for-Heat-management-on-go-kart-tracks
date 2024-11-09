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

// Get users for the first heat
$sql = "SELECT U.id AS user_id, U.name
FROM User_Heats UH
JOIN Users U ON UH.user_id = U.id
WHERE UH.heat_id = $currentID
ORDER BY U.id";

$result = $conn->query($sql);

$userData = array();

while ($row = $result->fetch_assoc()) {
    $userData[] = array(
        'name' => $row['name'],
    );
}

echo json_encode($userData);

$conn->close();

?>
