<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crime Reporting System</title>
    <style>
body {
    background-image: url('https://cdn.pixabay.com/photo/2019/03/03/14/38/hacker-4031973_640.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    background-attachment: fixed; /* Add this line to fix the background */
    font-family: Arial, sans-serif;
    margin: 20px auto;
    max-width: 800px;
    text-align: center;
    color: #333; /* Text color for better readability */
}

h1 {
    color: #333;
}

a, button {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    margin: 10px;
    text-decoration: none;
    background-color: #FF0000;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

a:hover, button:hover {
    background-color: #D60000;
}

select, input, button {
    margin: 10px 0;
    padding: 10px;
    width: calc(100% - 22px); /* Adjusted width to accommodate padding */
    box-sizing: border-box;
}

#crimeOptions, #citySearchForm {
    display: none;
    margin-top: 20px;
}

#searchResult {
    margin-top: 20px;
    text-align: left;
}

.error {
    color: #FF0000;
    margin-top: 5px;
}

.container {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    text-align: left;
    margin-bottom: 5px;
}

/* Updated styles for better readability and aesthetics */

.container {
    margin-top: 50px; /* Increased margin-top for better spacing */
}

h2 {
    margin-top: 20px; /* Added margin-top to separate sections */
}

input[type="text"],
select {
    width: 100%; /* Set input and select width to 100% */
    box-sizing: border-box;
    border: 1px solid #ccc; /* Added border for input and select */
    border-radius: 5px;
}

input[type="text"]:focus,
select:focus {
    outline: none; /* Removed outline on focus for better appearance */
    border-color: #FF0000; /* Changed border color on focus */
}

button {
    background-color: #FF0000;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #D60000;
}

/* Added styles for the search result display */
#searchResult {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    background-color: #fff;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    margin-top: 20px;


       
}

    </style>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle City Search
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['searchCity'])) {
    $searchCity = $_POST['searchCity'];

    // Query to get total number of crimes and their types in the specified city
    $query = "SELECT COUNT(*) AS totalCrimes, crime_type FROM crime_reports WHERE city_name = '$searchCity' GROUP BY crime_type";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo '<h2>Crime Statistics for ' . $searchCity . '</h2>';
        echo '<ul>';
        while ($row = $result->fetch_assoc()) {
            echo '<li>' . $row['crime_type'] . ': ' . $row['totalCrimes'] . ' cases</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No crime data found for ' . $searchCity . '</p>';
    }
}

// Handle Crime Report Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crimeType'], $_POST['cityName'], $_POST['crimeId'], $_POST['userEmail'])) {
    $crimeType = $_POST['crimeType'];
    $cityName = $_POST['cityName'];
    $crimeId = $_POST['crimeId'];
    $userEmail = $_POST['userEmail'];

    // Validate and sanitize input to prevent SQL injection
    $crimeType = $conn->real_escape_string($crimeType);
    $cityName = $conn->real_escape_string($cityName);
    $crimeId = $conn->real_escape_string($crimeId);
    $userEmail = $conn->real_escape_string($userEmail);

    // Debugging: Print out the values of variables to check if they are correct
    echo "Crime Type: " . $crimeType . "<br>";
    echo "City Name: " . $cityName . "<br>";
    echo "Crime ID: " . $crimeId . "<br>";
    echo "User Email: " . $userEmail . "<br>";

    // Insert the data into the crime_reports table
    $sql = "INSERT INTO crime_reports (crime_type, city_name, crime_id, user_email) VALUES ('$crimeType', '$cityName', '$crimeId', '$userEmail')";

    if ($conn->query($sql) === TRUE) {
        $response = ['success' => true];
        echo json_encode($response);
    } else {
        $response = ['success' => false, 'message' => $conn->error];
        echo json_encode($response);
    }
}

$conn->close();
?>


<div>
    <h1>Crime Reporting System</h1>

   

    <a href="#" onclick="showCrimeOptions()">Report Crime</a>
    <a href="#" onclick="showCitySearchForm()">Search City</a>

    <!-- Crime Options Section -->
    <div id="crimeOptions">
        <h2>Select Crime Type</h2>
        <select id="crimeType" required>
            <option value="Commercial Crimes">Commercial Crimes</option>
            <option value="Crimes Against Property">Crimes Against Property</option>
            <option value="Crimes Against Morality">Crimes Against Morality</option>
            <option value="Robbery">Robbery</option>
            <option value="Hate Crimes">Hate Crimes</option>
            <option value="Felonies">Felonies</option>
            <option value="Others">Others</option>
        </select>

        <h2>Enter City Name</h2>
        <input type="text" id="cityName" placeholder="Enter your city name" required>

        <h2>Enter Your Email</h2>
        <input Type="text" id="userEmail" placeholder="Enter your email" required>

        <!-- Enter 5-Digit Crime ID -->
        <h2>Enter 5-Digit Crime ID</h2>
        <input type="text" id="crimeId" placeholder="Enter 5-digit crime ID" pattern="\d{5}" title="Please enter a 5-digit number" maxlength="5" required>

        <button onclick="submitReport()">Submit</button>
    </div>

    <!-- City Search Form -->
    <div id="citySearchForm">
        <h2>Search City</h2>
        <label for="searchCity">Enter City Name:</label>
        <input type="text" id="searchCity" placeholder="Enter city name" required>
        <button onclick="searchCity()">Search</button>
    </div>
</div>

<a href="about.php" target="_blank">About Crime</a>

<script>
    function showCrimeOptions() {
        var crimeOptions = document.getElementById("crimeOptions");
        var citySearchForm = document.getElementById("citySearchForm");

        crimeOptions.style.display = "block";
        citySearchForm.style.display = "none";
    }

    function showCitySearchForm() {
        var crimeOptions = document.getElementById("crimeOptions");
        var citySearchForm = document.getElementById("citySearchForm");

        crimeOptions.style.display = "none";
        citySearchForm.style.display = "block";
    }

    function submitReport() {
        var crimeType = document.getElementById("crimeType").value;
        var cityName = document.getElementById("cityName").value;
        var crimeId = document.getElementById("crimeId").value;
        var userEmail = document.getElementById("userEmail").value;

        // Validate crime ID (5 digits)
        if (!/^\d{5}$/.test(crimeId)) {
            alert('Please enter a 5-digit crime ID.');
            return;
        }

        // Make an asynchronous POST request to the PHP file to handle crime report submission
        fetch('', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'crimeType=' + encodeURIComponent(crimeType) +
                  '&cityName=' + encodeURIComponent(cityName) +
                  '&crimeId=' + encodeURIComponent(crimeId)+
                  '&userEmail=' + encodeURIComponent(userEmail),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Report submitted successfully');
                // Clear input fields
                document.getElementById("crimeType").value = "";
                document.getElementById("cityName").value = "";
                document.getElementById("crimeId").value = "";
                document.getElementById("userEmail").value = "";
            } else {
                alert('Error submitting report: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Submitted.');
        });
    }

    function searchCity() {
        var searchCityValue = document.getElementById("searchCity").value;
        
        // Make an asynchronous POST request to the PHP file to handle city search
        fetch('', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'searchCity=' + encodeURIComponent(searchCityValue),
        })
        .then(response => response.text())
        .then(data => {
            // Display the result in the searchResult div
            document.getElementById("searchResult").innerHTML = data;
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while searching for the city.');
        });
    }
   
</script>

<!-- Display search result -->
<div id="searchResult"></div>

</body>
</html>