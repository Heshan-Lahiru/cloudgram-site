<?php
session_start();
// Connect to your database (replace placeholders with actual values)
$db = new mysqli("localhost","root","","app");

// Check for connection errors
if ($db->connect_errno) {
    die("Connection failed: " . $db->connect_error);
}

// Check if the form was submitted
if (isset($_POST['submit'])) {
    // Get the photo and text data from the form
    $photo = $_FILES['photo'];
    $textdata = $_POST['textdata'];

    // Validate and sanitize the data (add your specific validation logic here)
    // ...

    // Generate a unique photo ID
    $photoId = uniqid();

    // Retrieve the user ID using your chosen method
    $userId = $_SESSION['userid'] ?? null; // Assuming user ID is stored in a session variable

    if (!$userId) {
        // Handle error: User not logged in or ID unavailable
        die("Error: User ID not found.");
    }

    // Move the uploaded photo to a designated directory with error handling
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($photo["name"]);
    if (move_uploaded_file($photo["tmp_name"], $target_file)) {
        echo "The photo was uploaded successfully.<br>";
    } else {
        echo "Error uploading photo: " . $photo["error"] . "<br>";
        // Consider logging specific error details for troubleshooting
        error_log("Photo upload error: " . $photo["error"] . "\n", 3, "error_log.txt");
    }

    // Prepare the SQL statement with correct parameter types
    $sql = "INSERT INTO photouplord1  VALUES ('', ?, ?, ?)";
    $stmt = $db->prepare($sql);

    // Bind parameters with the correct number of variables and data types
    $stmt->bind_param("sss",  $userId, $target_file, $textdata);

    // Execute the SQL statement and handle errors
    if ($stmt->execute()) {
        echo "Photo and text data saved successfully!";
        echo '<script>window.location.href = "userpage.php";</script>';
    } else {
        // Check for specific error: foreign key constraint violation
        if ($stmt->errno === 1452) {
            echo "Error saving data: Invalid user ID. Please ensure the user exists in the 'data' table.";
        } else {
            echo "Error saving data: " . $stmt->error;
            // Consider logging specific error details for troubleshooting
            error_log("Error saving data: " . $stmt->error . "\n", 3, "error_log.txt");
        }
    }

    // Close the statement and database connection
    $stmt->close();
    $db->close();
}
?>


<!DOCTYPE html>
<html>
<head>
<title>Photo Upload</title>
<style>
   @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&family=Roboto+Condensed:wght@600&display=swap");

*,
*::before,
*::after {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}

body {
  background-color: #080710;
}

.background {
  width: 430px;
  height: 520px;
  position: absolute;
  transform: translate(-50%, -50%);
  left: 50%;
  top: 50%;
  /* border: 1px solid #fff; */
}

.background .shape {
  height: 200px;
  width: 200px;
  position: absolute;
  border-radius: 50%;
}
.shape:first-child {
  background: linear-gradient(#9b22ea, #bf23f6);
  left: -80px;
  top: -80px;
}
.shape:last-child {
  background: linear-gradient(to right, #ff512f, #f09819);
  right: -30px;
  bottom: -80px;
}
form {
  height: 520px;
  width: 430px;
  background-color: rgba(255, 255, 255, 0.07);
  position: absolute;
  transform: translate(-50%, -50%);
  border-radius: 10px;
  backdrop-filter: blur(10px);
  border: 2px solid rgba(255, 255, 255, 0.01);
  box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
  left: 50%;
  top: 50%;
  padding: 50px 35px;
}
form * {
  font-family: "Poppins", sans-serif;
  color: #fff;
  letter-spacing: 0.5px;
  outline: none;
  border: none;
}
form h3 {
  font-size: 32px;
  font-weight: 500;
  line-height: 42px;
}
form h3 span {
  display: block;
  font-size: 16px;
  font-weight: 300;
  color: #e5e5e5;
}
label {
  display: block;
  margin-top: 30px;
  font-size: 16px;
  font-weight: 500;
}
input {
  display: block;
  height: 50px;
  width: 100%;
  background-color: rgba(255, 255, 255, 0.07);
  border-radius: 3px;
  padding: 0 10px;
  margin-top: 8px;
  font-size: 14px;
  font-weight: 300;
}
.textdata{
  display: block;
  height: 50px;
  width: 100%;
  background-color: rgba(255, 255, 255, 0.07);
  border-radius: 3px;
  padding: 0 10px;
  margin-top: 8px;
  font-size: 14px;
  font-weight: 300;
}
::placeholder {
  color: #fff;
}
button {
  margin-top: 50px;
  width: 100%;
  color: #000;
  padding: 15px 0;
  font-size: 18px;
  font-weight: 600;
  border-radius: 50px;
  cursor: pointer;
}
button:hover {
  background: #000;
  color: #fff;
}

    </style>
</head>
<body>
<div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
<form action="" method="post" enctype="multipart/form-data">
  <input type="file" name="photo" required><br><br>
  <textarea class="textdata" name="textdata" rows="5" cols="40" placeholder="Enter text"></textarea><br><br>
  <input type="submit" name="submit" value="Upload Photo">
</form>

</body>
</html>
