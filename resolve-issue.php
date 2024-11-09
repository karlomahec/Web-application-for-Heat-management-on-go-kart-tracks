<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "kaz_db";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['kart_number'])) {
    $kart_number = $_POST['kart_number'];

    // Create a connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update the database to clean the issue on the specified kart
    $sql = "UPDATE Karts SET parts_to_fix = '', description = '', driveable = 1 WHERE kart_number = $kart_number";
    if ($conn->query($sql) === TRUE) {
        header("Location:karts-admin.php");
    } else {
        echo "Error resolving issue: " . $conn->error;
    }

    // Close the connection
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
