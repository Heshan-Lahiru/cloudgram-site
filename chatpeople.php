<?php
session_start();
require 'connect.php';

$conn = new mysqli("localhost", "root", "", "app");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, image FROM data";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Users List</title>
    <link rel='stylesheet' href='style.css'>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly; /* Distribute cards evenly */
            background: #000000d6;
        }
      

        .card {
            width: 900px; /* Adjust card width as needed */
            height: 250px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }


        .card img {
            border-radius: 50%;
            width: 100px; /* Adjust image width as needed */
            height: 100px; /* Adjust image height as needed */
            margin-right: 10px;
        }

        .card h2 {
            margin-top: 14px;
            font-weight: bold;
            color:white;
        }

        .card a {
            text-decoration: none;
            padding: 10px 20px;
            
            background-color: #38a3a5;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .card a:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>

<?php while ($row = $result->fetch_assoc()) { ?>
    <div class="card">
        <img src="image/<?php echo $row["image"]; ?>" alt="<?php echo $row["name"]; ?>">
        <h2><?php echo $row["name"]; ?></h2>
        <br><br<br>
        <a href="chat.php?name=<?php echo $row["name"]; ?>">Chat</a>
    </div>
<?php } ?>

</body>
</html>

<?php
} else {
    echo "No users found";
}

$conn->close();
?>
