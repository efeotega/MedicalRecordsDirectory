<?php
include 'connection.php'; // Include your database connection file

// Check if the necessary parameter (id) is provided via POST
if(isset($_POST['id'])) {
    $id = $_POST['id'];

    // Sanitize the input to prevent SQL injection
    $id = mysqli_real_escape_string($db, $id);

    // Prepare the DELETE query
    $query = "DELETE FROM pharmacists WHERE id = '$id'";

    // Execute the query
    if(mysqli_query($db, $query)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($db);
    }
} else {
    echo "Invalid request";
}
?>
