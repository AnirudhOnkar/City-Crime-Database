<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";

// Establish connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle user registration
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate and sanitize input to prevent SQL injection
    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user data into the users table
    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to proj.php after successful registration
        header('Location: proj.php');
        exit(); // Ensure that code execution stops after redirection
    } else {
        echo '<p>Error registering user: ' . $conn->error . '</p>';
    }
}

$conn->close();
?>
