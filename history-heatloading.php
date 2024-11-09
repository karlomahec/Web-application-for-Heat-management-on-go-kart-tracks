<?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $selectedDate = $_POST['heatDate'];    
                
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
        }else{
            echo "POST request incorrect";
        }
        ?>