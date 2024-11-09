let timerInterval;
let elapsedTime = 0;
let currentHeatID = 1;
let kartsForFuture = [];

function fetchHeatInfo() {
    // Make an AJAX request to backend.php that retrieves heat information
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `heat-fetching.php?currentID=${currentHeatID}`, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const heatInfo = JSON.parse(xhr.responseText);
            updateHeatInfo(heatInfo);
        }
    };
    xhr.send();
}

function fetchUserDataAndKarts() {
    const xhr1 = new XMLHttpRequest();
    xhr1.open("GET",`heat-users.php?currentID=${currentHeatID}`, true);
    xhr1.onreadystatechange = function () {
        if (xhr1.readyState === 4 && xhr1.status === 200) {
            const userInfo = JSON.parse(xhr1.responseText);

            const xhr2 = new XMLHttpRequest();
            xhr2.open("GET","heat-karts.php", true);
            xhr2.onreadystatechange = function () {
                if (xhr2.readyState === 4 && xhr2.status === 200) {
                    const kartInfo = JSON.parse(xhr2.responseText);
                    populateKartList(kartInfo);
                    populateUserListWithKarts(userInfo, kartInfo);
                }
            };
            xhr2.send();
        }
    };
    xhr1.send();
}


function populateKartList(karts) {
    document.getElementById("kart-box-state").innerHTML = "";
    const kartList = document.getElementById("kart-box-state");
    kartList.innerHTML = "";
    const allKartNumbers = karts.map(kart => kart.number);

    allKartNumbers.forEach(kartNumber => {
        const listItem = document.createElement("li");
        listItem.innerHTML = `${kartNumber} `;
        kartList.appendChild(listItem);
    });
}


function populateUserListWithKarts(users, karts) {
    const userList = document.getElementById("user-list");
    
    // Clear the user list
    userList.innerHTML = "";
    const availableKarts = [];
    // Create an array to store kart numbers that are not assigned yet
    if(!kartsForFuture.length){
        karts.forEach(kart =>{
            availableKarts.push(kart);
        })
    }else{
        availableKarts.length = 0;
        kartsForFuture.forEach(kart =>{
            availableKarts.push(kart);
        })
    }
    const kartsInUse = [];
    if(!kartsForFuture.length){
        karts.forEach(kart=>{
            kartsForFuture.push(kart);
        });
    }
    users.forEach(user => {
        const listItem = document.createElement("li");

        // Check if there are available karts
        if (availableKarts.length > 0) {
            const kart = availableKarts.shift(); // Get the first available kart
            kartsInUse.push(kart);

            // Create the edit button, input field, and display the current user and kart
            const editButton = document.createElement("button");
            editButton.className = "edit-icon";
            editButton.innerHTML = "✎";

            const kartNumberInput = document.createElement("input");
            kartNumberInput.type = "text";
            kartNumberInput.value = kart.number;
            kartNumberInput.style.display = "none"; // Initially hide the input field

            const saveButton = document.createElement("button");
            saveButton.className = "Save";
            saveButton.innerHTML = "Save";
            saveButton.style.display = "none"; // Initially hide the Save button

            const numberAndSaveContainer = document.createElement("div"); // Container for number and Save button
            numberAndSaveContainer.style.display = "flex"; // Display them side by side


            editButton.addEventListener("click", () => {
                // Toggle the visibility of the input field and Save button
                kartNumberInput.style.display = "inline";
                kartNumberInput.style.width = "20px";
                saveButton.style.display = "inline";
                editButton.style.display = "none";

                // Hide the username and current kart display
                userKartDisplay.style.display = "flex";
            });

            saveButton.addEventListener("click", () => {
                // Update the user's kart number and save it
                kart.number = kartNumberInput.value;

                // Toggle the visibility of the input field and Save button
                kartNumberInput.style.display = "none";
                saveButton.style.display = "none";

                // Show the username and updated kart display
                userKartDisplay.style.display = "block";

                // Update the user list
                populateUserListWithKarts(users, karts);
            });

            const userKartDisplay = document.createElement("span");
            userKartDisplay.innerHTML = `${user.name} - Kart: ${kart.number}`;

            numberAndSaveContainer.appendChild(userKartDisplay);
            numberAndSaveContainer.appendChild(saveButton);

            listItem.appendChild(userKartDisplay);
            listItem.appendChild(editButton);
            listItem.appendChild(kartNumberInput);
            listItem.appendChild(saveButton);
        } else {
        }
        userList.appendChild(listItem);
    });
    kartsInUse.forEach(kartUsed => {
        kartsForFuture.forEach(kart => {
            if(kartUsed == kart){
                kartsForFuture.push(kartsForFuture.splice(kartsForFuture.indexOf(kart),1)[0]);
            }
        });
    });
    console.log(kartsForFuture);
    updateKartList(karts, kartsInUse);

    populateKartList(kartsForFuture);
}

function updateKartList(karts,kartsInUse){
    const kartList = document.getElementById("kart-box-state");
    kartList.innerHTML = "";

    const kartsUsed = kartsInUse.map(kart => kart.number);
    const allKartNumbers = karts.map(kart => kart.number);
    allKartNumbers.forEach(number => {
        kartsUsed.forEach(usednumber =>{
            if(number == usednumber){
                allKartNumbers.push(allKartNumbers.shift());
            }
        })
    });

    allKartNumbers.forEach(kartNumber => {
        const listItem = document.createElement("li");
        listItem.innerHTML = `${kartNumber} `;
        kartList.appendChild(listItem);
    });
}

// Update the heat information in the UI
function updateHeatInfo(heatInfo) {
    const heatInfoDiv = document.getElementById("heat-info");
    heatInfoDiv.innerHTML = `
        <p>Heat Type: ${heatInfo.type}</p>
        <p>Number: ${heatInfo.number}</p>
        <p>Duration: ${heatInfo.duration}</p>
    `;
}

function startHeatTimer() {
    // Clear any existing interval to prevent multiple timers running simultaneously
    clearInterval(timerInterval);

    // Start the interval to update the timer every second
    timerInterval = setInterval(function () {
        elapsedTime++;
        updateTimerDisplay();
    }, 1000);
}

// Pause the heat timer
function pauseHeatTimer() {
    clearInterval(timerInterval);
}

// Finish the heat
function finishHeat() {
    const kartList = document.getElementById("kart-box-state");
    clearInterval(timerInterval);
    elapsedTime=0;
    // Update server to indicate that the heat is finished
    // Fetch next heat's information and update UI
    currentHeatID++;
    fetchHeatInfo();
    fetchUserDataAndKarts(kartList);
}

// Update the timer display
function updateTimerDisplay() {
    const minutes = Math.floor(elapsedTime / 60);
    const seconds = elapsedTime % 60;
    const timerDisplay = document.getElementById("timer");
    timerDisplay.textContent = `${minutes}:${seconds < 10 ? "0" : ""}${seconds}`;
}

// Attach event listeners to buttons
document.getElementById("start-button").addEventListener("click", startHeatTimer);
document.getElementById("pause-button").addEventListener("click", pauseHeatTimer);
document.getElementById("finish-button").addEventListener("click", finishHeat);

// Fetch heat information when the page loads
fetchUserDataAndKarts();
fetchHeatInfo();

