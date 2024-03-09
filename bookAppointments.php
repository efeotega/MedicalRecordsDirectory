<!DOCTYPE html>

<?php
include 'connection.php';
session_start();
$email = $_SESSION['email'];

$query = "SELECT * FROM patients WHERE email ='$email'";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($result);
$fname = $row['fname'];
$lname = $row['lname'];
$illness="";
$drugs="";
$message="";

if (isset($_POST['symptoms'])) {
    $symptoms = mysqli_real_escape_string($db, $_POST['symptoms']);
    $allergies = mysqli_real_escape_string($db, $_POST['allergies']);
    if (empty($symptoms)) {
        $error = 'Field Required!';
    } else {
        $query = "INSERT INTO patientrecords (`fname`, `lname`, `email`, `illness`, `symptom`, `allergies`,`drugs`) 
  			  VALUES('$fname' , '$lname', '$email', '$illness', '$symptoms', '$allergies','$drugs')";

        mysqli_query($db, $query);

        $message = 'Successfully Added for ' . $fname . " ".$lname."Your appointment has been booked successfully";
    }
}
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
                    <a href="logout.php" style="color:#252525"><i class="fas fa-sign-out-alt"></i>Log Out</a>
                </span>
            </center>
        </div>
    </div>
    <div class="col-lg-offset-4 col-lg-4 box" style="vertical-align: middle; padding: 20px">

        <form action="bookAppointments.php" method="POST">
            <?php if (isset($error)) { ?>
                <br>
                <small style="font-size: 15px; font-family: 'Montserrat'; color: #aa0000;">
                    <?php echo $error; ?>
                </small><br>
                <br>
            <?php } ?>
            <div class="row form-input-group">
                <label style="text-align: left">Describe how you feel</label><br><br>
                <textarea placeholder="symptoms" type="text" name="symptoms" class="input-box col-lg-12"
                    autocomplete="off" required></textarea>

            </div>
            <div class="row form-input-group">
                <label style="text-align: left">Do you have any allergies</label><br><br>
                <textarea placeholder="allergies" type="text" name="allergies" class="input-box col-lg-12"
                    autocomplete="off" required></textarea>

            </div>
            <br>
            <br>
            <button type="submit" name="submit" class="form-button-one"
                style="background-color: #00cf7a; border-color:#00cf7a; color: white">Book An Appointment</button>
        </form>

    </div>
    <div id="responseMessage"><label><?php echo $message;?></label></div>
    <?php
    if (isset($rows) && $rows >= 1) {
        echo "<table id='editableTable'>";
        echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Illness</th><th>Symptom</th><th>Drugs</th></tr>";

        while ($row = mysqli_fetch_assoc($results)) {
            echo "<tr>";
            echo "<td class='editable' data-column='id' contenteditable='false'>" . $row['id'] . "</td>";
            echo "<td class='editable' data-column='fname' contenteditable='false'>" . $row['fname'] . "</td>";
            echo "<td class='editable' data-column='lname' contenteditable='false'>" . $row['lname'] . "</td>";
            echo "<td class='editable' data-column='email' contenteditable='false'>" . $row['email'] . "</td>";
            echo "<td class='editable' data-column='illness' contenteditable='true'>" . $row['illness'] . "</td>";
            echo "<td class='editable' data-column='symptom' contenteditable='true'>" . $row['symptom'] . "</td>";
            echo "<td class='editable' data-column='drugs' contenteditable='true'>" . $row['drugs'] . "</td>";
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