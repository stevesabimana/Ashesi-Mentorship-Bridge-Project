<?php
session_start();
include("../../config.php");

if ($conn->connect_error) 
{
    // Log error and display a generic message
    error_log("Database connection failed: " . $conn->connect_error);
    echo json_encode(array("status" => "error", "message" => "An unexpected error occurred. Please try again later."));
    exit();
}

// Sanitize and validate inputs
$firstName = filter_var($_POST["firstname"], FILTER_SANITIZE_STRING);
$lastName = filter_var($_POST["lastname"], FILTER_SANITIZE_STRING);
$dob = $_POST["dob"];
$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
$major = filter_var($_POST["major"], FILTER_SANITIZE_STRING);
$password = $_POST["password"];

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(array("status" => "error", "message" => "Invalid email address!"));
    exit();
}

// Validate password complexity (example: at least 8 characters)
if (strlen($password) < 8) {
    echo json_encode(array("status" => "error", "message" => "Password must be at least 8 characters long!"));
    exit();
}

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Check if user already exists
$sql_check = "SELECT COUNT(*) AS count FROM User WHERE email = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("s", $email);
$stmt_check->execute();
$result_check = $stmt_check->get_result();
$row_check = $result_check->fetch_assoc();

if ($row_check['count'] > 0) {
    echo json_encode(array("status" => "error", "message" => "You already have an account!"));
    exit();
}

// Insert new user
$sql = "INSERT INTO User (firstName, lastName, dob, email, major, passwd) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $firstName, $lastName, $dob, $email, $major, $hashedPassword);

if ($stmt->execute()) 
{
    // Retrieve the newly inserted userId
    $userId = $stmt->insert_id;

    // Store user details in session
    $_SESSION['userId'] = $userId;
    $_SESSION['firstName'] = $firstName;
    $_SESSION['lastName'] = $lastName;

    echo json_encode(array("status" => "success", "message" => "You have successfully created an account!"));
    exit();
} else {
    // Log the error and return a generic message
    error_log("Error inserting user: " . $stmt->error);
    echo json_encode(array("status" => "error", "message" => "Failed to create an account, please try again!"));
    exit();
}
?>
