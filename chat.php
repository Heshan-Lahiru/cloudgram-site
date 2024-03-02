<?php
session_start();
require 'connect.php';
$conn = new mysqli("localhost", "root", "", "app");

// Check if the "name" parameter exists in the URL
if (isset($_GET["name"])) {
    $name = $_GET["name"];
} else {
    // Redirect to show.php if "name" is missing
    header("Location: show.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat with <?php echo $name; ?></title>
    <link rel="stylesheet" href="style.css">

<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5; /* Light gray background */
    background: #000000d6;
}

.background {
  width: 430px;
  height: 520px;
  position: absolute;
  transform: translate(-50%, -50%);
  left: 50%;
  top: 50%;
 
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
  top: -150px;
}
.shape:last-child {
  background: linear-gradient(to right, #ff512f, #f09819);
  right: -30px;
  bottom: -80px;
}

.chat-container {
    max-width: 700px;
    margin: 50px auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    margin-bottom: 20px;
    color:white;
}

.chat-messages {
    height: 300px;
    overflow-y: scroll; /* Enable scrolling for long messages */
    padding: 10px;

}

.chat-messages p {
    margin: 0;
    padding: 10px;
    border-radius: 5px;
    line-height: 1.5; /* Adjust line spacing for better readability */
    color:white;
}

.chat-messages p.you {
    background-color: #38a3a5;
    color: white;
}

.chat-messages p.received {
    background-color: #ddd;
    color: #333;
}

.chat-form {
    display: flex; /* Arrange elements horizontally */
    margin-top: 20px;
    
}

.chat-form input[type="text"] {
    flex: 1; /* Make the input field expand to fill available space */
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.chat-form button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background-color: #38a3a5;
    color: white;
    cursor: pointer; /* Indicate clickable behavior */
    transition: background-color 0.2s ease-in-out;
}

.chat-form button:hover {
    background-color: #2980b9;
}


    </style>
</head>
<body>
<div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="chat-container">
        <h1>Chat with <?php echo $name; ?></h1>

        <div id="chat-messages" class="chat-messages"></div>

        <form id="chat-form" class="chat-form">
            <input type="text" name="message" id="message" placeholder="Type your message here">
            <button type="submit">Send</button>
        </form>
    </div>

    <script>
        const chatMessages = document.getElementById("chat-messages");
        const chatForm = document.getElementById("chat-form");
        const messageInput = document.getElementById("message");

        chatForm.addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent default form submission

            // Replace with actual communication logic using WebSockets or other real-time techniques
            const message = messageInput.value;
            chatMessages.innerHTML += `<p>You: ${message}</p>`;

            messageInput.value = "";
        });
    </script>
</body>
</html>
