<?php
$servername = "localhost";
$username = "steve.nsabimana";
$password = "Nsateve2@";
$dbname = "webtech_fall2024_stève_nsabimana";

// Create connection using mysqli
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character encoding to avoid issues with special characters
$conn->set_charset("utf8");
?>

