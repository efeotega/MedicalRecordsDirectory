<?php
session_start();

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required parameters are set
    if (isset($_POST['itemprice'])) {
        // Retrieve email and drug from session
        $email = $_SESSION['patientemail'];
        $drug = $_SESSION['drug'];

        // Sanitize and validate input
        $itemPrice = floatval($_POST['itemprice']); // Convert item price to float

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

        // Prepare SQL statement to insert data into financialreports table
        $sql = "INSERT INTO financialreports (email, itembought, price, date) VALUES (?, ?, ?, NOW())";

        // Prepare and bind parameters
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssd", $email, $drug, $itemPrice);

        // Execute the statement
        if ($stmt->execute() === TRUE) {
            // Close statement and connection
            $stmt->close();
            $conn->close();
            // Redirect to pharmacistHome.php
            header('location: pharmacistHome.php');
            exit(); // Make sure to stop execution after redirection
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Error: Item price not set in request";
    }
} else {
    echo "Error: Invalid request method";
}
?>
