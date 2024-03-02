<?php
session_start();

require 'connect.php';

$conn = new mysqli("localhost", "root", "", "app");

if (isset($_POST["submit"])) {
    $mail = $_POST["mail"];
    $password = $_POST["password"];

    $sql = "SELECT password, userid FROM data WHERE mail = ?"; // Use prepared statements
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $mail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row["password"];

        if (password_verify($password, $hashedPassword)) {
            $mail = strstr($mail, '@', true); // Extract username
            $_SESSION['userid'] = $row['userid']; // Store userid in session

            switch ($mail) {
                case 'Admin':
                    header("Location: setting.html");
                    exit();
                default:
                    $_SESSION['mail'] = $mail;
                    header("Location: userpage.php");
                    exit();
            }
        } else {
            $error = "Incorrect password. Please try again."; // Set error message
        }
    } else {
        $error = "Username not found. Please check and try again."; // Set error message
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link
        href="style.css"
        rel="stylesheet">
    </head>
<body>
<div class="box">
    <form class="registration-form" action="" method="POST">
        <h2>Register Now</h2>

        <div class="inputBx">
            <span></span>
            <input type="text" name="mail" id="mail" placeholder="Enter Username" required>
        </div>

        <div class="inputBx">
            <span></span>
            <input type="password" name="password" id="password" placeholder="Enter Password" required>
        </div>
        <div class="inputBx">
        <input type="submit" name="submit" value="Sign In">
        </div>
        <div class="group">
            <a href="#">Forget Password</a>
            <a href="index.php">Signup</a>
        </div>
        <?php
        if (isset($error)) {
            echo '<div class="error-message">' . $error . '</div>';
        }
        ?>
    </form>
</div>
</body>
</html>
