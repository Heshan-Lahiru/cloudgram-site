<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    background-color: #f5f5f5;
}

.container {
    width: 600px; /* Adjust width as needed */
    margin: 0 auto; /* Center the container horizontally */
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    margin-bottom: 15px;
}

.settings-buttons {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-evenly;
    margin-bottom: 20px;
}

.settings-buttons a {
    text-decoration: none;
    padding: 10px 20px;
    background-color: #38a3a5;
    color: white;
    border-radius: 5px;
    margin: 5px;
    cursor: pointer;
}

.settings-buttons a:hover {
    opacity: 0.8;
}

        </style>
</head>
<body>
    <div class="container">
        <h1>Settings</h1>
        
        <div class="settings-buttons">
            <a href="userpage.php">User Page</a>
            <a href="logout.php">Log Out</a>
            <a href="help.php">Help</a>
            <a href="changeps.php">Change Password</a>
            </div>
    </div>

    <?php
        // Placeholder logic, replace with your actual functionalities
        if (isset($_GET["action"])) {
            switch ($_GET["action"]) {
                case "userpage":
                    // Code to redirect to user page
                    break;
                case "logout":
                    // Code to handle logout functionality
                    break;
                // Add cases for other buttons
            }
        }
    ?>

    <script src="script.js"></script>
</body>
</html>
