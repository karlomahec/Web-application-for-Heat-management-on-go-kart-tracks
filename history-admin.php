<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Karting Arena Zagreb</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="img/logoKAZ_neg.png" type="image/x-icon">
  <link rel="shortcut icon" href="img/logoKAZ_neg.png" type="image/x-icon">
  <link rel="stylesheet" href="history-admin.css">
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


  <?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "kaz_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


  ?>
    <div style="display:flex;justify-content:center">
    <div class="heats">
        <!-- Add a button to open the form popup for adding a single user to a heat -->
        <button class="btn" width="300px" id="addUserButton">Add User to Heat</button>
        <!-- Add a button to open the form popup for adding multiple users to multiple heats -->
        <button class="btn" width="500px" id="addMultipleUsersButton">Add Multiple Users to Heats</button>

        <div class="date-navigation">
            <button id="prevDateButton" class="btn" style="font-size:30px;">&larr;</button>
            <p style="color:white;"id="selectedDate">Selected Date: <?php echo date('Y-m-d'); ?></p>
            <button id="nextDateButton" class="btn" style="font-size:30px;">&rarr;</button>
        </div>

        <script>
            const urlParams = new URLSearchParams(window.location.search);
            let currentDate;
            const heatDate = urlParams.get('heatDate');
            if(!heatDate){
                currentDate = new Date('2023-08-08');
            }else{
                currentDate = new Date(heatDate);
            }
            updateSelectedDate(currentDate.toISOString().slice(0, 10)); // Update the selected date paragraph
            
            const firstDate = currentDate;

            document.addEventListener("DOMContentLoaded", function(date) {
                var xhr2 = new XMLHttpRequest();
                xhr2.open('POST','', true);
                xhr2.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                
                xhr2.onreadystatechange = function() {
                    if (xhr2.readyState === XMLHttpRequest.DONE) {
                        if (xhr2.status === 200) {
                            
                        } else {
                            console.error('Error:', xhr2.statusText);
                        }
                    }
                };
                const formData = `heatDate=${encodeURIComponent(firstDate.toISOString().slice(0, 10))}`;
                xhr2.send(formData);
                console.log(formData);
            });

            function updateSelectedDate(date) {
                document.getElementById("selectedDate").textContent = "Selected Date: " + date;
            }
            function updateServerDate(date) {
                // Send an AJAX request to a PHP script to update the date on the server
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                           window.location.href='history-admin.php?heatDate='+date;
                        } else {
                            console.error('Error:', xhr.statusText);
                        }
                    }
                };
                const formData = `heatDate=${encodeURIComponent(date)}`;
                xhr.send(formData);
                console.log(formData);
            }
            

            // Event listener for the "Previous Date" button
            document.getElementById("prevDateButton").addEventListener("click", function() {
                currentDate.setDate(currentDate.getDate() - 1); // Decrease the date by 1 day
                updateSelectedDate(currentDate.toISOString().slice(0, 10)); // Update the selected date paragraph
                updateServerDate(currentDate.toISOString().slice(0, 10));
            });

            // Event listener for the "Next Date" button
            document.getElementById("nextDateButton").addEventListener("click", function() {
                currentDate.setDate(currentDate.getDate() + 1); // Increase the date by 1 day
                updateSelectedDate(currentDate.toISOString().slice(0, 10)); // Update the selected date paragraph
                updateServerDate(currentDate.toISOString().slice(0, 10));
            });
            
        </script>

        <?php
            if (isset($_GET['heatDate'])) {
                $heatDate = $_GET['heatDate'];
                $selectedDate = $heatDate;
            }else{
                $selectedDate = '2023-08-08';
            }
            $sql = "SELECT H.id AS heat_id, H.number, H.type, H.duration, H.date, U.id AS user_id, U.name, U.email, U.phone_number, U.number_of_drives, U.best_lap_time, U.date_of_birth
            FROM Heats H
            JOIN User_Heats UH ON H.id = UH.heat_id
            JOIN Users U ON UH.user_id = U.id
            WHERE H.date = '$selectedDate'
            ORDER BY H.id, U.id";


            $result = $conn->query($sql);

            // Initialize a variable to keep track of the current heat
            $current_heat_id = -1;
            $numResults = $result->num_rows;
            $i = 0;
            // Iterate through the result and display users by heats
            while ($row = $result->fetch_assoc()) {
                $i++;
                if ($current_heat_id != $row['heat_id']) {
                    if ($current_heat_id != -1) {
                        echo '</table>';
                    }
                    echo '<table border="0" style="background-color:white;">';
                    echo '<tr><th style="padding:20px;">'. $row['type'] . ' ' . $row['number'].'<br>' . $row['duration'] . '</th>';
                    
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
                echo '<button class="remove" id="RemoveUser" onclick="removeUser(' . $row['user_id'] . ', ' . $row['heat_id'] . ')">Remove</button>';
                echo '</td>';
                if($i == $numResults){
                    $sql1 = "SELECT H.id AS heat_id, H.number, H.type, H.duration
                    FROM Heats H
                    ORDER BY H.id DESC
                    LIMIT 1";
                    $result1 = $conn->query($sql1);
                    while ($row = $result1->fetch_assoc()) {
                        echo '<table border="0" style="background-color:white;">';
                        echo '<tr><th style="padding:20px;">'. $row['type'] . ' ' . $row['number'].'<br>' . $row['duration'] . '</th>';
                        echo '<td>';
                        echo 'Last heat available';
                        echo '</td>';
                        echo '</table>';
                    }
                }
            }

            // Close the last table
            if ($current_heat_id != -1) {
                
                echo '</table>';
            }
        ?>
        </div>
    </div>
    </div>

    <script>
    // JavaScript function to remove a user from a heat
    function removeUser(userId, heatId) {
        // Send an AJAX request to a PHP script that handles the removal
        $.ajax({
            type: "POST",
            url: "history-remove.php", // Create this PHP script to handle the removal
            data: {
                userId: userId,
                heatId: heatId
            },
            success: function(response) {
                // Handle the response from the server, e.g., remove the user's div from the DOM
                if (response === 'success') {
                    location.reload(); // Reload the page to reflect the updated data
                } else {
                    alert('Failed to remove user.');
                }
            }
        });
    }
    </script>

    <!-- Modal for adding a single user to a heat -->
    <div id="addUserModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeAddUserModal">&times;</span>
            <h2>Add User to Heat</h2>
            <form method="post">
                 <div style="display:flex;justify-content:baseline;align-items:left;">
                 <select name="heats" id="heats" class="form-style">
                 <?php
                    // Retrieve heat data from the database
                    $sqlHeats = "SELECT id, number FROM heats";
                    $resultHeats = $conn->query($sqlHeats);

                    // Generate the options for the select element
                    while ($rowHeat = $resultHeats->fetch_assoc()) {
                        echo '<option value="' . $rowHeat['id'] . '">' . $rowHeat['number'] . '</option>';
                    }
                ?>
                </select>
                <multi-input> 
                    <input list="users" name="selected_users" class="form-style">
                    <datalist id="users">
                    <?php
                        // Retrieve heat data from the database
                        $sqlUsers = "SELECT id, name FROM users";
                        $resultUsers = $conn->query($sqlUsers);

                        // Generate the options for the select element
                        while ($rowUser = $resultUsers->fetch_assoc()) {
                            echo '<option value="' . $rowUser['id'] . '">' . $rowUser['name'] . '</option>';
                        }
                    ?>
                    </datalist>
                </multi-input>
                <button id="get" class="issuebtn">Unesi</button>
            </form>
            </div>
        </div>
    </div>


    <script>
            const getButton = document.getElementById('get');
            const multiInput = document.querySelector('multi-input');
            const number = document.getElementById('heats');

            getButton.addEventListener('click', function() {
            const selectedValues = multiInput.getValues().join(',');

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

            const formData = `heatnumber=${encodeURIComponent(number.value)}&selected_users=${encodeURIComponent(selectedValues)}`;
            xhr.send(formData);
        });
    </script>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $selectedHeatID = $_POST['heatnumber'];
            $selectedUserIDsString = $_POST['selected_users'];
        
            // Split the selected user IDs string into an array
            $selectedUserIDsArray = explode(',', $selectedUserIDsString);
    
        
            // Insert the selected users for the selected heat into the user_heats table
            foreach ($selectedUserIDsArray as $userID) {
                $sqlInsert = "INSERT INTO user_heats (user_id, heat_id) VALUES ('$userID', '$selectedHeatID')";
                $resultInsert = $conn->query($sqlInsert);
                if (!$resultInsert) {
                    // Handle error if the insertion fails
                    echo "Error inserting data: " . $conn->error;
                }
            }
        }
        ?>


    <!-- Modal for adding multiple users to multiple heats -->
    <div id="addMultipleUsersModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeAddMultipleUsersModal">&times;</span>
            <h2>Add Multiple Users to Heats</h2>
            <form method="post">
                <select name="package" id="package" class="form-style">
                        <option value="10-minutna vožnja">10-minutna vožnja</option>
                        <option value="MGP">MGP</option>
                        <option value="GPA">GPA</option>
                </select>
                 <div style="display:flex;justify-content:baseline;align-items:left;">
                 
                 <select name="startheat" id="startheat" class="form-style">
                 <?php
                    // Retrieve heat data from the database
                    $sqlHeats = "SELECT id, number FROM heats";
                    $resultHeats = $conn->query($sqlHeats);

                    // Generate the options for the select element
                    while ($rowHeat = $resultHeats->fetch_assoc()) {
                        echo '<option value="' . $rowHeat['id'] . '">' . $rowHeat['number'] . '</option>';
                    }
                ?>
                </select>
                <multi-input id="MultiInput"> 
                    <input list="resUsers" name="resUsers" class="form-style">
                    <datalist id="resUsers">
                        <?php
                            // Retrieve heat data from the database
                            $sqlUsers = "SELECT id, name FROM users";
                            $resultUsers = $conn->query($sqlUsers);

                            // Generate the options for the select element
                            while ($rowUser = $resultUsers->fetch_assoc()) {
                                echo '<option value="' . $rowUser['id'] . '">' . $rowUser['name'] . '</option>';
                            }
                        ?>
                    </datalist>
                </multi-input>
                <br>
            <button id="getRes" class="issuebtn">Unesi</button>
            </form>
            </div>
        </div>
    </div>

    <script>
            const getButton1 = document.getElementById('getRes');
            const multiInput1 = document.getElementById('MultiInput'); 
            const number1 = document.getElementById('startheat');
            const package = document.getElementById('package');

            getButton1.addEventListener('click', function() {
                const selectedValues = multiInput1.getValues().join(',');
                
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

                const formData = `package=${encodeURIComponent(package.value)}&startheat=${encodeURIComponent(number1.value)}&resUsers=${encodeURIComponent(selectedValues)}`;
                xhr.send(formData);
            });
    </script>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $selectedPackage = $_POST['package'];
            $selectedHeatID = $_POST['startheat']; 
            $selectedUserIDsString = $_POST['resUsers']; // Updated to 'resUsers'

            // Split the selected user IDs string into an array
            $selectedUserIDsArray = explode(',', $selectedUserIDsString);
            foreach($selectedUserIDsArray as $user){
                echo $user;
            }

            // Based on the selected package, determine the number of heats to add users to
            $heatsToAddUsers = 1; // Default for "10-minutna vožnja"
            $durationChanges = []; // Array to track changes in heat duration
            if ($selectedPackage == "MGP") {
                $heatsToAddUsers = 2;
                $durationChanges[0] = 5; // Change duration of the first heat to 5 minutes
            } elseif ($selectedPackage == "GPA") {
                $heatsToAddUsers = 3;
                $durationChanges = [10, 5, 10]; // Change durations of the first, second, and third heats
            }

            // Loop through the heats and insert users
            for ($i = 0; $i < $heatsToAddUsers; $i++) {
                foreach ($selectedUserIDsArray as $userID) {
                    $sqlInsert = "INSERT INTO user_heats (user_id, heat_id) VALUES ('$userID', '$selectedHeatID')";
                    $resultInsert = $conn->query($sqlInsert);
                    if (!$resultInsert) {
                        // Handle error if the insertion fails
                        echo "Error inserting data: " . $conn->error;
                    }
                }

                // Update heat duration if needed
                if (isset($durationChanges[$i])) {
                    $newDuration = $durationChanges[$i];
                    $sqlUpdateDuration = "UPDATE heats SET duration = '$newDuration' WHERE id = '$selectedHeatID'";
                    $resultUpdateDuration = $conn->query($sqlUpdateDuration);
                    if (!$resultUpdateDuration) {
                        // Handle error if the update fails
                        echo "Error updating duration: " . $conn->error;
                    }
                }

                // Move to the next heat
                $selectedHeatID++;
            }
        }
        ?>

    <script src="history-script.js"></script>
    <script src="history-multi-input.js"></script>
    <div class="backdrop" id="backdrop">
        
    </div>

<script>
    // Get the modal elements
    var addUserModal = document.getElementById("addUserModal");
    var addMultipleUsersModal = document.getElementById("addMultipleUsersModal");

    // Get the button elements that open the modals
    var addUserButton = document.getElementById("addUserButton");
    var addMultipleUsersButton = document.getElementById("addMultipleUsersButton");

    // Get the <span> elements that close the modals
    var closeAddUserModal = document.getElementById("closeAddUserModal");
    var closeAddMultipleUsersModal = document.getElementById("closeAddMultipleUsersModal");

    // Open the modals when the buttons are clicked
    addUserButton.onclick = function () {
        addUserModal.style.display = "block";
        document.getElementById("backdrop").style.display = "block";
		document.body.classList.add("blur-effect");
    }
    addMultipleUsersButton.onclick = function () {
        addMultipleUsersModal.style.display = "block";
        document.getElementById("backdrop").style.display = "block";
		document.body.classList.add("blur-effect");
    }

    // Close the modals when the <span> elements are clicked
    closeAddUserModal.onclick = function () {
        addUserModal.style.display = "none";
        document.getElementById("backdrop").style.display = "none";
		document.body.classList.remove("blur-effect");
    }
    closeAddMultipleUsersModal.onclick = function () {
        addMultipleUsersModal.style.display = "none";
        document.getElementById("backdrop").style.display = "none";
		document.body.classList.remove("blur-effect");
    }

    // Close the modals when the user clicks outside the modal
    window.onclick = function (event) {
        if (event.target == addUserModal) {
            addUserModal.style.display = "none";
            document.getElementById("backdrop").style.display = "none";
		    document.body.classList.remove("blur-effect");
        }
        if (event.target == addMultipleUsersModal) {
            addMultipleUsersModal.style.display = "none";
            document.getElementById("backdrop").style.display = "none";
		    document.body.classList.remove("blur-effect");
        }
    }
</script>

        <footer>
        <div class="heatfooter">
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
        echo '<table style="background-color:white;">';
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