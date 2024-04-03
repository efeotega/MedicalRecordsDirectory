<?php
session_start();

if (isset($_POST['drug'])) {
    $_SESSION['drug'] = $_POST['drug'];
    $_SESSION['patientemail'] = $_POST['patientemail'];
    echo "Drug set in session successfully";
} else {
    echo "Error: Drug not set in request";
}
?>
