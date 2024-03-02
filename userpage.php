<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    background-color:#5D5555;
}
.uplordphoto{
  color: black; 
  padding: 8px 16px; 
  text-decoration: none; 
  font-size: 18px;
  background-color:#38a3a5;
}
.profile-picture {
    display: block;
    margin: 0 auto 20px auto;
    width: 150px;
    height: 150px;
    border-radius: 50%; /* Make the image circular */
    object-fit: cover;
}
.a{
  display: flex;
  justify-content: center;
    align-items: center;
}

  </style>
</head>
<body>
<div class="a">  
<center>
  <?php
  session_start();
  // Include connection details (replace with your actual credentials)
  require 'connect.php';
  $conn = new mysqli("localhost", "root", "", "app");

  // Check if user is logged in and retrieve their information
  if (isset($_SESSION['userid'])) {
    $user_id = $_SESSION['userid'];

    // Prepare and execute query with prepared statements for security
    $sql = "SELECT name, image FROM data WHERE userid=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
      $row = $result->fetch_assoc();
      $name = $row['name'];
      $profile_image = $row['image'];

?>
      <h1 style="color:white; font-family: Cursive;">Welcome <?php echo $name; ?></h1>

      <?php if (!empty($profile_image)): ?>
        <img class="profile-picture" width="100px" height="100px" src="image/<?php echo $profile_image; ?>" alt="Profile Picture">
      <?php else: ?>
        <p>No profile picture uploaded.</p>
      <?php endif; ?>

      <?php
    } else {
      echo "<h2>Error: User information not found.</h2>";
    }
  } else {
    echo "<h2>Please log in to view your profile.</h2>";
  }
 
  ?><br><br>
 
 
  <hr>
  <table width="100%" height="60px" border="1" cellspacing="0">
  <th>
  <a  href="display.php">
    <i class="fa fa-home" style="font-size:48px;color:black"></i></a>
</th> 
  <th>
    <a href="uplordphoto.php">
      <i class="fa fa-camera-retro" style="font-size:48px;color:black"></i></a>
</th>

<th> <a href="chatpeople.php"><i class="fa fa-phone" style="font-size:48px;color:black"></i></a>
</th>
</table>

</center>
</div>
</body>
</html>
<?php


// Check if the user is logged in
if (!isset($_SESSION['userid'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Connect to the database
$db = new mysqli("localhost","root","","app");

// Check for connection errors
if ($db->connect_errno) {
    die("Connection failed: " . $db->connect_error);
}

// Get the user ID from the session
$user_id = $_SESSION['userid'];

// Prepare and execute the SQL query, protecting against potential SQL injection
$sql = "SELECT * FROM photouplord1 WHERE userid = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param("i", $user_id); // Bind user ID as integer
$stmt->execute();
$result = $stmt->get_result(); // Fetch results

// Check if any records were found
if ($result->num_rows > 0) {
?>

<!DOCTYPE html>
<html>
<head>
<title>Your Uploaded Photos and Text Data</title>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    background-color:#5D5555;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

.photo-grid {
    display: grid;
    margin: 10px;
    grid-template-columns: repeat(4, 1fr);
    grid-gap: 10px;
}

.photo-grid img {
    width: 100%;
    height: auto;
    margin: 10px;
    object-fit: cover; /* Maintain aspect ratio and crop if needed */
    border-radius: 5px; /* Add rounded corners */
}


.photo-grid {
  margin: 10px;
}

.photo-grid img {
    width: 100px; /* Set image width */
    height: auto;
    margin: 10px;
    object-fit: cover; /* Maintain aspect ratio and crop if needed */
    border-radius: 5px; /* Add rounded corners */
}
a{
  justify-content: center; 
  align-items: center;
}
.b{
  display: flex;
  justify-content: center;
    align-items: center;
}
  </style>
</head>
<body>
<div class="b">
<br><br><br>


   

<?php
// Fetch and display each row using associative array
while ($row = $result->fetch_assoc()) {
?>

  
<?php
// Validate file path and existence before displaying
$photo_path = $row['photo'];
if (file_exists($photo_path) && is_file($photo_path)) {
?>

<img src="<?php echo $photo_path; ?>" alt="Uploaded Photo" style="width: 200px; height: 200px; border: 10px solid white; object-fit: cover; margin-bottom: 50px;">

<?php
} else {
    echo '<p>Photo not found or unavailable.</p>';
}
?>


<?php
}
?>



<?php
} else {
    echo "<p>You haven't uploaded any photos yet.</p>";
}
?>
</div>
</body>
</html>

<?php
// Close statement and database connection
$stmt->close();
$db->close();
?>

