<!DOCTYPE html>

<?php
include 'connection.php';
session_start();
if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    if (empty($email)) {
        $error = 'Email Field Required!';
    } else {
        $query = "SELECT * FROM patientrecords WHERE email='$email' AND drugs IS NOT NULL AND drugs <> ''";
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
    <title>HOME | CHH</title>
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
                    <a href="logout.php" onclick="return confirmLogout();" style="color:#252525"><i
                            class="fas fa-sign-out-alt"></i>Log Out</a>
                </span>
            </center>
        </div>
    </div>
    <div class="col-lg-offset-4 col-lg-4 box" style="vertical-align: middle; padding: 20px">
        <h1>Adminster Drugs</h1>
        <form action="adminsterDrugs.php" method="POST">
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
        echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Illness</th><th>Symptom</th><th>Drugs</th></tr>";

        while ($row = mysqli_fetch_assoc($results)) {
            echo "<tr>";
            echo "<td class='editable' data-column='id' contenteditable='false'>" . $row['id'] . "</td>";
            echo "<td class='editable' data-column='fname' contenteditable='false'>" . $row['fname'] . "</td>";
            echo "<td class='editable' data-column='lname' contenteditable='false'>" . $row['lname'] . "</td>";
            echo "<td class='editable' data-column='email' contenteditable='false'>" . $row['email'] . "</td>";
            echo "<td class='editable' data-column='illness' contenteditable='true'>" . $row['illness'] . "</td>";
            echo "<td class='editable' data-column='symptom' contenteditable='false'>" . $row['symptom'] . "</td>";
            echo "<td class='editable' data-column='drugs' contenteditable='false'>" . $row['drugs'] . "</td>";
            echo "<td><button onclick='adminsterDrug(this)' data-id='" . $row['id'] . "' data-drug='" . $row['drugs'] . "' data-email='" . $row['email'] . "'>Administer</button></td>";
            echo "</tr>";
        }

        echo "</table>";
    } elseif (isset($rows) && $rows == 0) {
        echo "No records found";
    }
    ?>

    <script>
        function adminsterDrug(button) {
            try {
                var drug = button.getAttribute('data-drug');
                var patientemail = button.getAttribute('data-email');
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "set_drug_session.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Handle the response from the server
                        //alert(xhr.responseText); // Alert response from PHP script (optional)
                    }
                };

                // Concatenate drug and patientemail values into the POST data
                var postData = "drug=" + drug + "&patientemail=" + patientemail;
                xhr.send(postData);

                var phpPageUrl = "paymentPage.php";

                // Redirect to the PHP page
                window.location.href = phpPageUrl;
            }
            catch (error) {
                alert(error);
            }

        }
    </script>

</body>

</html>
<?php
?>