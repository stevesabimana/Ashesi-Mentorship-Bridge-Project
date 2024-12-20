<?php
session_start();
include("../../config.php");
//include("../setting/core.php");
//isLogin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/animate.min.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="../fonts/icomoon/style.css">
    <link rel="stylesheet" href="../fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="../css/aos.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="sidebar">
            <a class = "option"><img src = "../images/option.png"></a>
            <nav>
                        <ul>
                            <li><a href="../../index.php"><img src = "../images/home.png">Home</a></li>
                            <li><a href="dashboard.php"><img src = "../images/dasboard.png">dashboard</a></li>
                            <li><a href="chat.php"><img src = "../images/inbox.png">Message</a></li>
                            <li><a href="profile.php"><img src = "../images/account.png">Profile</a></li>
                            <li><a href="../action/logout_action.php"><img src = "../images/logout.png">Logout</a></li>

                        </ul>
            </nav>
               
</div>

<div class="content">
    <header>
        <h1>Welcome, <?php echo $_SESSION['firstName']?>!</h1>
    </header>

    <main>

    <div class="container">
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $userId = $_POST['userId'];
                $firstName = $_POST['firstName'];
                $lastName = $_POST['lastName'];
                $dob = $_POST['dob'];
                $email = $_POST['email'];
                $major = $_POST['major'];
                $nationality = $_POST['nationality'];

                $sql = "UPDATE user SET firstName='$firstName', lastName='$lastName', dob='$dob', email='$email', major='$major', nationality='$nationality' WHERE userId=$userId";

                if ($conn->query($sql) === TRUE) {
                    echo "<p>Profile updated successfully</p>";
                    UNSET($_SESSION['firstName']);
                    UNSET($_SESSION['lastName']);

                    $_SESSION['firstName'] = $firstName;
                    $_SESSION['lastName'] = $lastName;
                } else {
                    echo "Error updating profile: " . $conn->error;
                }
            }

            // Fetch user data
            $userId = $_SESSION['userId'];
            $sql = "SELECT * FROM user WHERE userId = $userId";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
        ?>
        <div class="profile-info">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="hidden" name="userId" value="<?php echo $row['userId']; ?>">
                <div class="form-group">
                    <label>First Name:</label>
                    <input type="text" name="firstName" value="<?php echo $row['firstName']; ?>">
                </div>
                <div class="form-group">
                    <label>Last Name:</label>
                    <input type="text" name="lastName" value="<?php echo $row['lastName']; ?>">
                </div>
                <div class="form-group">
                    <label>Date of Birth:</label>
                    <input type="date" name="dob" value="<?php echo $row['dob']; ?>">
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" value="<?php echo $row['email']; ?>">
                </div>
                <div class="form-group">
                    <label>Major:</label>
                    <input type="text" name="major" value="<?php echo $row['major']; ?>">
                </div>
                <div class="form-group">
                    <input type="submit" value="Update Profile">
                </div>
            </form>
        </div>
        <?php
                }
            } else {
                echo "0 results";
            }
            $conn->close();
        ?>
    </div>
        
    </main>
</div>

<script src="admin.js"></script>
</body>
</html>


