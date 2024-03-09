<?php
include 'connection.php'; // Include your database connection file

// Check if the necessary parameters are provided via POST
if(isset($_POST['id']) && isset($_POST['column']) && isset($_POST['value'])) {
    $id = $_POST['id'];
    $column = $_POST['column'];
    $value = $_POST['value'];

    // Sanitize the input to prevent SQL injection
    $id = mysqli_real_escape_string($db, $id);
    $column = mysqli_real_escape_string($db, $column);
    $value = mysqli_real_escape_string($db, $value);

    // Prepare the UPDATE query
    $query = "UPDATE patientrecords SET `$column` = '$value' WHERE id = '$id'";

    // Execute the query
    if(mysqli_query($db, $query)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($db);
    }
} else {
    echo "Invalid request";
}
?>
