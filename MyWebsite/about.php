<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Crime</title>
    <style>
        /* Global styles */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('https://t4.ftcdn.net/jpg/04/32/31/41/360_F_432314164_aGSuiKikhfzcURx2tGGcC6ikw1Rm15JR.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8); /* Added opacity for better readability */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        /* Form styles */
        form {
            max-width: 500px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #fff; /* Set background color for input and textarea */
        }

        textarea {
            height: 100px;
        }

        button {
            padding: 10px 20px;
            background-color: #FF0000;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin: 0 auto;
        }

        button:hover {
            background-color: #D60000;
        }
    </style>
</head>
<div class="container">
        <h1>Report a Crime</h1>
        <!-- Crime report form -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="form-group">
                <label for="crimeId">Crime ID (5 digits):</label>
                <input type="text" id="crimeId" name="crimeId" pattern="\d{5}" title="Please enter a 5-digit number" maxlength="5" required>
            </div>
            <div class="form-group">
                <label for="crimeTime">Time:</label>
                <input type="time" id="crimeTime" name="crimeTime" required>
            </div>
            <div class="form-group">
                <label for="crimeDate">Date:</label>
                <input type="date" id="crimeDate" name="crimeDate" required>
            </div>
            <div class="form-group">
                <label for="crimeDesc">Short Description:</label>
                <textarea id="crimeDesc" name="crimeDesc" placeholder="Enter a short description" required></textarea>
            </div>
            <div class="form-group">
                <button type="submit" name="submitCrime">Submit</button>
            </div>
        </form>
        <?php
        // Handle form submission and insert data into the crime_details table
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitCrime'])) {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "mydatabase";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $crimeId = $_POST['crimeId'];
            $crimeTime = $_POST['crimeTime'];
            $crimeDate = $_POST['crimeDate'];
            $crimeDesc = $_POST['crimeDesc'];

            // Validate and sanitize input to prevent SQL injection
            $crimeId = $conn->real_escape_string($crimeId);
            $crimeTime = $conn->real_escape_string($crimeTime);
            $crimeDate = $conn->real_escape_string($crimeDate);
            $crimeDesc = $conn->real_escape_string($crimeDesc);

            // Prepare and bind the SQL statement using prepared statements
            $stmt = $conn->prepare("INSERT INTO crime_details (crime_id, crime_time, crime_date, description) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isss", $crimeId, $crimeTime, $crimeDate, $crimeDesc);

            // Execute the prepared statement
            if ($stmt->execute()) {
                echo '<p>Crime details added successfully.</p>';
            } else {
                echo '<p>Error adding crime details: ' . $stmt->error . '</p>';
            }

            // Close the prepared statement and database connection
            $stmt->close();
            $conn->close();
        }
        ?>
    </div>
</body>
</html>
