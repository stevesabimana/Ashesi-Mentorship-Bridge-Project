<?php
session_start();
include("../../config.php");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type'); // Allow Content-Type header

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Handle preflight requests
    header('Access-Control-Allow-Methods: POST'); // Allow POST method
    header('Access-Control-Max-Age: 86400'); // Cache preflight response for 24 hours
    exit;
}

header('Content-Type: application/json');

if ($conn->connect_error) 
{
    // Log error and display a generic message
    error_log("Database connection failed: " . $conn->connect_error);
    echo json_encode(array("status" => "error", "message" => "An unexpected error occurred. Please try again later."));
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    // Sanitize and validate inputs
    $firstName = filter_var($_POST["firstname"], FILTER_SANITIZE_STRING);
    $lastName = filter_var($_POST["lastname"], FILTER_SANITIZE_STRING);
    $dob = $_POST["dob"];
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $major = filter_var($_POST["major"], FILTER_SANITIZE_STRING);
    $password = $_POST["password"];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
        echo json_encode(array("status" => "error", "message" => "Invalid email address!"));
        // echo "Email not valid\n";
        exit();
    }
    else
    {
       // echo "Email is valid\n";
    }

    // Validate password complexity (example: at least 8 characters)
    if (strlen($password) < 8) 
    {
        echo json_encode(array("status" => "error", "message" => "Password must be at least 8 characters long!"));
        exit();
    }
    else
    {
        // echo "Password is valid\n";
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // echo "Password hashed\n";

    // Check if user already exists
    $sql_check = "SELECT COUNT(*) AS count FROM user WHERE email = ?";

   //  echo "SQL Check\n";
    $stmt_check = $conn->prepare($sql_check);
    
    // echo "Statement prepared\n";
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    $row_check = $result_check->fetch_assoc();

    // echo "Below count check\n";

    if ($row_check['count'] > 0) 
    {
        echo json_encode(array("status" => "error", "message" => "You already have an account!"));
        exit();
    }

    // Insert new user
    $sql = "INSERT INTO user (firstName, lastName, dob, email, major, passwd) VALUES (?, ?, ?, ?, ?, ?)";
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
    } 
    else 
    {
        // Log the error and return a generic message
        error_log("Error inserting user: " . $stmt->error);
        echo json_encode(array("status" => "error", "message" => "Failed to create an account, please try again!"));
        exit();
    }   
} 
    else 
    {
        echo "This is not a POST request.";
    }

?>
