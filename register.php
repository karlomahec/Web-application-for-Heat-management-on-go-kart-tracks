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
    $email = $_POST['mail'];
    $password = $_POST['pw'];
    $fullName = $_POST['fullName']; // Add this line for registration
    $phoneNumber = $_POST['phoneNumber']; // Add this line for registration
    $dateOfBirth = $_POST['dateOfBirth']; // Add this line for registration

    // Check if the email exists in the database
    $sql = "SELECT * FROM Users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Email exists in the database, so this is a login attempt
        $row = $result->fetch_assoc();
        if ($row['password'] == $password) {
            // Password matches, user is logged in correctly, redirect to admin-home.php
            header("Location: admin-home.php");
            exit;
        } else {
            // Password does not match, show login error popup
            header("Location: prijava.html?login_error=1");
            exit;
        }
    } else {
        // Email does not exist in the database, so this is a registration
        // Insert the new user data into the database
        $sql = "INSERT INTO Users (email, password, name, phone_number, date_of_birth) VALUES ('$email', '$password', '$fullName', '$phoneNumber', '$dateOfBirth')";

        if ($conn->query($sql) === TRUE) {
            // Registration successful, redirect to admin-home.php
            header("Location: prijava.html");
            exit;
        } else {
            // Registration failed, show error popup
            header("Location: prijava.html?registration_error=1");
            exit;
        }
    }

    // Close the connection
    $conn->close();
}
?>
