<!DOCTYPE html>

<?php
include 'connection.php';
session_start();

$query = "SELECT * FROM pharmacists";
$results = mysqli_query($db, $query);
$rows = mysqli_num_rows($results);

?>
<html>

<head>
    <meta charset="UTF-8">
    <title>HOME | CHH</title>
    <link rel="icon" href="favicon.ico" sizes="20x20" type="image/png">
    <link rel="stylesheet" type="text/css" href="styling/dashboard.css">
    <link rel="stylesheet" type="text/css" href="styling/flexboxgrid.css">
    <link rel="stylesheet" type="text/css" href="styling/forms.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.typekit.net/sgr8dvc.css">
    <link href="https://fonts.googleapis.com/css?family=Lato|Montserrat|Open+Sans|Oswald|Raleway|Roboto"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">

    <style>
        /* CSS for table */
        table {
            width: 97%;
            border-collapse: collapse;
            border: 2px solid #333;
            background-color: #f2f2f2;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #333;
        }

        th {
            background-color: #444;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #ddd;
        }
    </style>
</head>

<body style=" height:  100%; background-color: #f5f5f5; padding: 10px;">
    <div class="dashboard-navbar-light">
        <div class="dashboard-navbar-options-light nav-title" style="width: 100%;">
            <center>
                <span>
                    <a href="index.php" style="float: left; padding-left: 50px; color: black">Central Health
                        Hospital</a>
                </span>
                <span style="float: right;">
                    <a href="logout.php" style="color:#252525"><i class="fas fa-sign-out-alt"></i>Log Out</a>
                </span>
            </center>
        </div>
    </div>
    <h1>All Pharmacists</h1>
    <div id="responseMessage"></div>
    <?php
    if (isset($rows) && $rows >= 1) {
        echo "<table id='editableTable'>";
        echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th></tr>";

        while ($row = mysqli_fetch_assoc($results)) {
            echo "<tr>";
            echo "<td class='editable' data-column='id' contenteditable='false'>" . $row['id'] . "</td>";
            echo "<td class='editable' data-column='fname' contenteditable='false'>" . $row['fname'] . "</td>";
            echo "<td class='editable' data-column='lname' contenteditable='false'>" . $row['lname'] . "</td>";
            echo "<td class='editable' data-column='email' contenteditable='false'>" . $row['email'] . "</td>";
            echo "<td><button onclick='deleteRow(this)' data-id='" . $row['id'] . "'>Delete</button></td>";
            echo "</tr>";
        }

        echo "</table>";
    } elseif (isset($rows) && $rows == 0) {
        echo "No records found";
    }
    ?>

    <script>
        function deleteRow(button) {
            if (confirm("Are you sure you want to delete this row?")) {
                let row = button.parentNode.parentNode;
                let id = row.cells[0].innerText; // Assuming the ID is in the first column

                // Send an AJAX request to delete the row from the database
                let xhr = new XMLHttpRequest();
                xhr.open('POST', 'deletePharmacists.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        document.getElementById('responseMessage').innerHTML = xhr.responseText; // Display response message on the screen
                        if (xhr.responseText.includes("successfully")) {
                            row.parentNode.removeChild(row); // Remove the row from the table if deletion was successful
                        }
                    }
                }
                xhr.send('id=' + id);
            }
        }
    </script>
</body>

</html>
<?php
?>