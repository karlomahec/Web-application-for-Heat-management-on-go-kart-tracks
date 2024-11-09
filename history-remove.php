<?php
// Check if user ID and heat ID are provided via POST request
if (isset($_POST['userId']) && isset($_POST['heatId'])) {
    $userId = $_POST['userId'];
    $heatId = $_POST['heatId'];

    // Establish a database connection (make sure to include your database credentials)
    $db_host = "127.0.0.1";
    $db_user = "root";
    $db_password = "";
    $db_name = 'kaz_db';

    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL DELETE query
    $sql = "DELETE FROM user_heats WHERE user_id = $userId AND heat_id = $heatId";

    if ($conn->query($sql) === TRUE) {
        echo 'success'; // Return success to the AJAX request
    } else {
        echo 'failure: ' . $conn->error; // Return an error message
    }

    // Close the database connection
    $conn->close();
} else {
    echo 'Invalid input'; // Return an error message if input is missing
}
?>
