<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "kaz_db";

    // Create a connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];

    // Query to check if the email and password match
    $sql = "SELECT * FROM Users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        session_start();
        $user = $result->fetch_assoc();
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['num_drives'] = $user['number_of_drives'];
        $_SESSION['best_lap'] = $user['best_lap_time'];
        $_SESSION['phone'] = $user['phone_number'];
        $_SESSION['date'] = $user['date_of_birth'];

        if ($user['name'] === 'admin') {
            header("Location: admin-home.php");
        } else {
            header("Location: index-login.php");
        }
        exit;
    } else {
        header("Location: prijava.html?login_error=1");
        exit;
    }

    // Close the connection
    $conn->close();
}
?>
