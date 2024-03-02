<!DOCTYPE html>
<html>
<head>
<title>Photo Display</title>
<link rel="stylesheet" href="style1.css">
<style>
 
  .navigation {
    position: fixed; 
    bottom: 0; 
    width: 100%; 
    height: 8%; 
    background-color:  #38a3a5; 
    padding: 10px;
    text-align: center; 
  }

  .navigation a {
    color: black; 
    padding: 8px 16px; 
    text-decoration: none; 
    font-size: 18px; 
  }

  .navigation a:hover {
    background-color: #ddd; 
  }

  
  .userpage-button {
    position: fixed; 
    bottom: -8px; 
    right: 10px; 
    display: flex; 
    align-items: center; 
    padding: 10px; 
    border-radius: 5px; 
   width:90px; 
    color: white; 
    cursor: pointer; 
  }

  .userpage-button img {
    width: 70px; 
    height: 70px;
    margin-right: 5px; 
  }

  
  .text-and-like {
    width: 500px;
    border: 2px solid #ccc;
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 5px;
  }

  .like-button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 15px;
    text-align: center;
    text-decoration: none;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  img {
    max-width: 500px; 
    max-height: 500px;
  }
  
</style>
</head>
<body>

<?php

$db = new mysqli("localhost", "root", "", "app"); 


if ($db->connect_errno) {
    die("Connection failed: " . $db->connect_error);
}


if (isset($_SESSION['userid'])) {
    $user_id = $_SESSION['userid'];
} else {
    
}


$sql = "SELECT * FROM photouplord1";
$result = $db->query($sql);
?>
<div class="content">
    <?php
  
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $photo_id = $row['photouploardid']; 
            $photo_data = htmlspecialchars($row['photo']); // Sanitize photo data
            $textdata = htmlspecialchars($row['textdata']); // Sanitize text data

            // Retrieve like count from the "likesave" table
            $like_count_sql = "SELECT COUNT(*) AS like_count FROM likesave WHERE photouploardid = ?"; // Corrected column name
            $like_count_stmt = $db->prepare($like_count_sql);
            $like_count_stmt->bind_param('i', $photo_id);
            $like_count_stmt->execute();
            $like_count_result = $like_count_stmt->get_result();
            $like_count_row = $like_count_result->fetch_assoc();
            $current_like_count = $like_count_row['like_count'];

            // HTML structure for each photo, including like button (adjusted for readability)
            ?>
            <center>
                <fieldset>
                    <img  src="<?php echo $photo_data; ?>" alt="<?php echo $textdata; ?>" />
                    <div class="text-and-like">
                        <h2 style="color:white; font-family: Cursive;"><?php echo $textdata; ?></h2>
                      
                        <button class="like-button" data-photo-id="<?php echo $photo_id; ?>" data-current-count="<?php echo $current_like_count; ?>">
                            Like (<?php echo $current_like_count; ?>)
                        </button>
                   
      
                    </div>
                </fieldset>
            </center>
            <script>
                const likeButtons = document.querySelectorAll('.like-button');

likeButtons.

                </script>
            <?php
        }
    } else {
        echo "<p>No photos found.</p>";
    }
    ?>
</div>

<div class="navigation"><center>
<ul class="menu">
        <div class="toggle"><ion-icon name="add-outline"></ion-icon></div>
        <li style="--i:0;" class="active"><a href="display.php"><ion-icon name="home-outline"></ion-icon></a></li>
        <li style="--i:1;"><a href="userpage.php"><ion-icon name="person-outline"></ion-icon></a></li>
        <li style="--i:2;"><a href="setting.php"><ion-icon name="settings-outline"></ion-icon></a></li>
        <li style="--i:3;"><a href="chatpeople.php"><ion-icon name="mail-outline"></ion-icon></a></li>
        <li style="--i:4;"><a href="#"><ion-icon name="camera-outline"></ion-icon></a></li>

        <div class="indicator"></div>
    </ul></center>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="scriptmenu.js"></script></div>



<script src="scripts.js"></script>

<?php
// Close the database connection
$db->close();
?>

</body>
</html>
