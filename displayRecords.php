<!DOCTYPE html>

<?php
include 'connection.php';
session_start();
if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    if (empty($email)) {
        $error = 'Email Field Required!';
    } else {
        $query = "SELECT * FROM financialreports WHERE email='$email'";
        $results = mysqli_query($db, $query);
        $rows = mysqli_num_rows($results);
    }
}
?>
<html>

<head>
<script>
            function confirmLogout() {
                return confirm("Are you sure you want to log out?");
            }
        </script>
    <meta charset="UTF-8">
    <title>Patient Records | CHH</title>
    <link rel="icon" href="favicon.ico" sizes="20x20" type="image/png">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="css/flexboxgrid.css">
    <link rel="stylesheet" type="text/css" href="css/forms.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.typekit.net/sgr8dvc.css">
    <link href="https://fonts.googleapis.com/css?family=Lato|Montserrat|Open+Sans|Oswald|Raleway|Roboto"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">

    <style>
        /* CSS for table */
        table {
            width: 100%;
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

<body style=" height:  100%; background-color: #f5f5f5; padding-bottom: 10px;">
    <div class="dashboard-navbar-light">
        <div class="dashboard-navbar-options-light nav-title" style="width: 100%;">
            <center>
                <span>
                    <a href="index.php" style="float: left; padding-left: 50px; color: black">Central Health
                        Hospital</a>
                </span>
                <span style="float: right;">
                    <a href="logout.php" onclick="return confirmLogout();" style="color:#252525"><i class="fas fa-sign-out-alt"></i>Log Out</a>
                </span>
            </center>
        </div>
    </div>
    <div class="col-lg-offset-4 col-lg-4 box" style="vertical-align: middle; padding: 20px">
        <h1>Patients Records</h1>
        <form action="displayRecords.php" method="POST">
            <?php if (isset($error)) { ?>
                <br>
                <small style="font-size: 15px; font-family: 'Montserrat'; color: #aa0000;">
                    <?php echo $error; ?>
                </small><br>
                <br>
            <?php } ?>
            <div class="row form-input-group">
                <label style="text-align: left">Enter patients email</label><br><br>
                <input placeholder="Email" type="email" name="email" class="input-box col-lg-12" autocomplete="off"
                    required>
            </div>
            <br>
            <br>
            <button type="submit" name="submit" class="form-button-one"
                style="background-color: #00cf7a; border-color:#00cf7a; color: white">Search</button>
        </form>

    </div>
    <div id="responseMessage"></div>
    <?php
    if (isset($rows) && $rows >= 1) {
        echo "<table id='editableTable'>";
        echo "<tr><th>ID</th><th>Email</th><th>Price</th><th>Drug</th><th>Date</th></tr>";

        while ($row = mysqli_fetch_assoc($results)) {
            echo "<tr>";
            echo "<td class='editable' data-column='id' contenteditable='false'>" . $row['id'] . "</td>";
            echo "<td class='editable' data-column='email' contenteditable='false'>" . $row['email'] . "</td>";
            echo "<td class='editable' data-column='price' contenteditable='true'>" . $row['price'] . "</td>";
            echo "<td class='editable' data-column='itembought' contenteditable='true'>" . $row['itembought'] . "</td>";
            echo "<td class='editable' data-column='date' contenteditable='true'>" . $row['date'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } elseif (isset($rows) && $rows == 0) {
        echo "No records found";
    }
    ?>

    <script>
        // JavaScript to handle saving changes to the database when Enter key is pressed
        document.getElementById('editableTable').addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                let td = e.target;
                let column = td.getAttribute('data-column'); // Retrieve column name from data-column attribute
                let row = td.parentNode.rowIndex;
                let cellValue = td.innerText;
                let id = this.rows[row].cells[0].innerText; // Assuming the ID is in the first column

                // Remove focus from the current cell
                td.blur();

                // Send an AJAX request to update the database
                let xhr = new XMLHttpRequest();
                xhr.open('POST', 'updatePatientRecord.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        document.getElementById('responseMessage').innerHTML = xhr.responseText; // Display response message on the screen
                    }
                }
                xhr.send('id=' + id + '&column=' + column + '&value=' + encodeURIComponent(cellValue));
            }
        });
    </script>

</body>

</html>
<?php
?>