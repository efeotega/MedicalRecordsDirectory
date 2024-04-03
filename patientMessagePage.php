<?php
session_start();

// Check if the sender is logged in
if (isset($_SESSION['patient_logged_in']) && isset($_SESSION['email'])) {
    $senderEmail = $_SESSION['email'];
} else {
    // Redirect if sender is not logged in
    header("Location: login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "med_rec_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $receiverEmail = $_POST['receiver_email'];
    $message = $_POST['message'];

    // Insert message into the database
    $sql = "INSERT INTO messages (sender_email, receiver_email, message) VALUES ('$senderEmail', '$receiverEmail', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Message sent successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch sent messages ordered by date_sent (most recent first)
$sql_sent = "SELECT * FROM messages WHERE sender_email='$senderEmail' ORDER BY date_sent DESC";
$result_sent = $conn->query($sql_sent);

// Fetch received messages ordered by date_sent (most recent first)
$sql_received = "SELECT * FROM messages WHERE receiver_email='$senderEmail' ORDER BY date_sent DESC";
$result_received = $conn->query($sql_received);


// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Messaging</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        form {
            margin-bottom: 20px;
        }
        textarea {
            width: 300px;
            height: 100px;
        }
        .message-container {
            display: inline-block;
            text-align: left;
            width: 45%;
            padding: 10px;
            border: 1px solid #ccc;
            margin: 10px;
            vertical-align: top;
        }
    </style>
</head>
<body>

<h2>Send Message</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="receiver_email">Doctor Email:</label><br>
    <input type="email" id="receiver_email" name="receiver_email" required><br><br>
    <label for="message">Message:</label><br>
    <textarea id="message" name="message" rows="4" cols="50" required></textarea><br><br>
    <input type="submit" value="Send Message">
</form>

<div class="message-container">
    <h2>Sent Messages</h2>
    <?php
    if ($result_sent->num_rows > 0) {
        while($row = $result_sent->fetch_assoc()) {
            echo"<hr>";
            echo "<div><strong>To:</strong> " . $row["receiver_email"]. "<br>";
            echo "<strong>Message:</strong> " . $row["message"]. "<br>";
            echo "<strong>Date:</strong> " . $row["date_sent"]. "<br></div>";
        }
    } else {
        echo "No sent messages";
    }
    ?>
</div>

<div class="message-container">
    <h2>Received Messages</h2>
    <?php
    if ($result_received->num_rows > 0) {
        while($row = $result_received->fetch_assoc()) {
            echo"<hr>";
            echo "<div><strong>From:</strong> " . $row["sender_email"]. "<br>";
            echo "<strong>Message:</strong> " . $row["message"]. "<br>";
            echo "<strong>Date:</strong> " . $row["date_sent"]. "<br></div>";
        }
    } else {
        echo "No received messages";
    }
    ?>
</div>

</body>
</html>
