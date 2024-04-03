<!DOCTYPE html>

<?php
include 'connection.php';
session_start();
if (isset($_SESSION['doctor_logged_in'])) {
    $email = $_SESSION['email'];

    $query = "SELECT * FROM patientrecords";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $recordid = $row['id'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $email = $row['email'];
    $illness = $row['illness'];
    $symptoms = $row['symptoms'];
    $drug = $row['drug'];
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
        <div class="row">
            <div class="col-lg-offset-1 col-lg-10 box"
                style="vertical-align: middle; padding: 50px; font-family: Varela Round ">
                <div class="row">
                    <div class="col-lg-6">
                        <h1 style="font-size: 50px; ">
                            <?php echo $fname . " " . $lname ?>
                        </h1>
                        <h2 style="font-size: 30px; "><b>
                                <?php echo "Doctor ID: " . $chhid ?>
                            </b></h2>
                    </div>
                    <div class="col-lg-5 box"
                        style="vertical-align: middle; font-family: Varela Round; background-color: #e9e9e9;  border-radius: 20px">
                        <h1 style="font-size: 25px; ">
                            <?php echo "Doctor ID: " . $chhid ?><br>
                            <?php echo $fname . " " . $lname ?>
                        </h1>
                        <br><br>
                        <h1 style="font-size: 25px; ">Central Health Hospital</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-offset-1 col-lg-5 box"
                style="vertical-align: middle; padding: 50px; font-family: Varela Round ">
                <h1 style="font-size: 50px;color: #00cf7a ">View Patients Records</h1>
                <a href="uploadRecords.php" class="form-button-one" style="border-color: #00cf7a; color: #00cf7a"><i
                        class="fas fa-file-medical"></i> View Patients Records</a>
            </div>
            <div class="col-lg-5 box" style="vertical-align: middle; padding: 50px; font-family: Varela Round ">
                <h1 style="font-size: 50px; color: #1e78ff">View Appointments</h1>
                <a href="addRecords.php" class="form-button-one" style="border-color: #1e78ff; color: #1e78ff"><i
                        class="fas fa-clipboard"></i> View Appointments</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-offset-1 col-lg-5 box"
                style="vertical-align: middle; padding: 50px; font-family: Varela Round ">
                <h1 style="font-size: 50px; color: #ffbd00 ">Records & Reports</h1>
                <a href="displayReports.php" class="form-button-one" style="border-color: #00cf7a; color: #00cf7a"><i
                        class="fas fa-file-medical"></i> View Reports</a>
                <a href="displayRecords.php" class="form-button-one" style="border-color: #1e78ff; color: #1e78ff"><i
                        class="fas fa-clipboard"></i> View Records</a>
            </div>
            <div class="col-lg-5 box" style="vertical-align: middle; padding: 50px; font-family: Varela Round ">
                <h1 style="font-size: 50px; color:#ff0043 ">Central Health Hospital</h1>
                <a href="displayReports.php" class="form-button-one" style="border-color: #ff0043; color: #ff0043"><i
                        class="fas fa-info-circle"></i> About</a>
                <a href="displayReports.php" class="form-button-one" style="border-color: #ff0043; color: #ff0043"><i
                        class="fas fa-user"></i> Creators</a>
                <a href="displayReports.php" class="form-button-one" style="border-color: #ff0043; color: #ff0043"><i
                        class="fas fa-at"></i> Contact Us</a>
            </div>
        </div>
    </body>

    </html>
    <?php
} else {
    header('Location: patientlogin.php');
} ?>