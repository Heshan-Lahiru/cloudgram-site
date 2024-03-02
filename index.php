<?php
session_start();
require 'connect.php';
$conn = new mysqli("localhost","root","","app");
if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $compassword = $_POST['compassword'];
    $stmt = $conn->prepare("SELECT * FROM data WHERE name=? OR mail=?");
    $stmt->bind_param('ss', $name, $mail); // Correct string for two strings
$stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('User or email already exists');</script>";
        exit;
    }
    if ($password == $compassword) {
        // Hash the password using bcrypt
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);



    if($_FILES["image"]["error"] === 4){
        echo "<script>alert('Image doesn't exist')</script>";
    } else {
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        $validImageExtensions = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));

        if(!in_array($imageExtension, $validImageExtensions)){
            echo "<script>alert('Invalid image format')</script>";
        } else if($fileSize > 1000000){
            echo "<script>alert('Image size is too large')</script>";
        } else {
            $newImageName = uniqid() . '.' . $imageExtension;

            move_uploaded_file($tmpName, 'image/' . $newImageName);
            $query = "INSERT INTO data VALUES('','$name','$mail', '$newImageName','$hashedPassword')";
            mysqli_query($conn, $query);
            echo "<script>alert('Successfully added');
             document.location.href = 'login.php';</script>";
        }
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Registration</title>
  <link
        href="style.css"
        rel="stylesheet">
  <style>

    </style>

<body>
<div class="box">
  <form class="registration-form" action="" method="post" enctype="multipart/form-data">
    <h2>Register Now</h2>

    <div class="inputBx">
            <span></span>
      <label for="name">Name</label>
      <input type="text" name="name" id="name" required placeholder="Enter Name">
    </div>

    <div class="inputBx">
            <span></span>
      <label for="mail">Email</label>
      <input type="mail" id="mail" name="mail" required placeholder="Enter Email">
    </div>

    <div class="inputBx">
            <span></span>
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required placeholder="Enter Password">
    </div>

    <div class="inputBx">
            <span></span>
      <label for="compassword">Confirm Password</label>
      <input type="password" id="compassword" name="compassword" required placeholder="Enter Password Again">
    </div>

    <div class="inputBx">
            <span></span>
      <label for="image">Profile Image</label>
      <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png">
    </div>

    <div class="inputBx">
        <input type="submit" name="submit" value="Sign In">
        </div></form>
</div>
</body>
</html>
