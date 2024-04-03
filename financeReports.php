<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['patient_logged_in'])) {
    // Redirect if user is not logged in
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

// Retrieve email from session
$email = $_SESSION['email'];

// Fetch data from financialreports table
$sql = "SELECT * FROM financialreports WHERE email = '$email'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Financial Reports</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Financial Reports</h2>

<table>
    <tr>
        <th>Email</th>
        <th>Item Bought</th>
        <th>Price</th>
        <th>Date</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["itembought"] . "</td>";
            echo "<td>" . $row["price"] . "</td>";
            echo "<td>" . $row["date"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No financial reports found for this email.</td></tr>";
    }
    ?>
</table>

</body>
</html>

<?php
// Close connection
$conn->close();
?>
