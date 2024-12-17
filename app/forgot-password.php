<?php
require_once('../config.php');   // Include your database connection file

// Initialize the message variable
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Validate email input
    if (empty($email)) {
        $message = 'Email is required.';
    } else {
        // SQL query to check if email exists
        $sql = "SELECT * FROM user WHERE email = ?";

        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);

        // Check for SQL preparation errors
        if ($stmt === false) {
            $message = 'Error preparing statement: ' . $conn->error;
        } else {
            // Bind the email parameter
            $stmt->bind_param('s', $email);

            // Execute the query
            if ($stmt->execute()) {
                $result = $stmt->get_result();

                // Check if email exists in the database
                if ($result->num_rows > 0) {
                    // Email found - Generate a unique token
                    $token = bin2hex(random_bytes(50));  // Generates a secure random token
                    $expiry = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token valid for 1 hour

                    // Insert the token into the database (make sure to create a 'reset_tokens' table)
                    $token_sql = "INSERT INTO password_reset_tokens (email, token, expiry) VALUES (?, ?, ?)";
                    $token_stmt = $conn->prepare($token_sql);
                    $token_stmt->bind_param('sss', $email, $token, $expiry);
                    $token_stmt->execute();

                    // Send the email with the reset token
                    $reset_link = "http://yourdomain.com/reset-password.php?token=" . $token;
                    $subject = "Password Reset Request";
                    $message = "Hello, \n\nYou requested a password reset. Please click the link below to reset your password:\n\n" . $reset_link;
                    $headers = 'From: no-reply@yourdomain.com' . "\r\n" . 'Reply-To: no-reply@yourdomain.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
                    mail($email, $subject, $message, $headers);

                    // Success message
                    $message = "An email with a password reset link has been sent to your email address.";
                } else {
                    $message = "No user found with that email address.";
                }
            } else {
                $message = 'Error executing query: ' . $stmt->error;
            }

            // Close the prepared statement
            $stmt->close();
        }
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
      
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            margin-bottom: 20px;
        }

        h2 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .password-form {
            display: flex;
            flex-direction: column;
        }

        .password-form label {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .password-form input {
            font-size: 16px;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .password-form input[type="email"] {
            background-color: #f9f9f9;
        }

        .password-form button {
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .password-form button:hover {
            background-color: #45a049;
        }

        .password-form input:focus,
        .password-form button:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(72, 161, 70, 0.5);
        }

        .password-form input::placeholder {
            color: #888;
        }

        /* Message styling */
        .message {
            font-size: 16px;
            text-align: center;
            margin-top: 20px;
        }

        .message.success {
            color: green;
        }

        .message.error {
            color: red;
        }
    </style>
</head>
<body>

    <div class="form-container">
    
        <h2>Forgot Password</h2>
        <form action="forgot-password.php" method="POST" class="password-form">
            <label for="email">Enter your email address:</label>
            <input type="email" name="email" required placeholder="Email Address">
            <button type="submit">Submit</button>
        </form>

        <?php if (!empty($message)): ?>
            <div class="message <?php echo strpos($message, 'No user found') !== false ? 'error' : 'success'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

    </div>

</body>
</html>
