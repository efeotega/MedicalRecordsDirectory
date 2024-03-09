<!DOCTYPE html>

<?php
include 'connection.php';
session_start();
if (isset($_SESSION['admin_logged_in'])) {
    $email = $_SESSION['email'];

    $query = "SELECT * FROM admins WHERE email ='$email'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $chhid = $row['id'];
    $fname = $row['fname'];
    $lname = $row['lname'];
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
        <div class="row">
            <div class="col-lg-offset-1 col-lg-10 box"
                style="vertical-align: middle; padding: 50px; font-family: Varela Round ">
                <div class="row">
                    <div class="col-lg-6">
                        <h1 style="font-size: 50px; ">Admin Dashboard</h1>
                        <h2 style="font-size: 30px; ">Perform adminstrative actions here</b></h2>
                    </div>
                    <div class="col-lg-5 box"
                        style="vertical-align: middle; font-family: Varela Round; background-color: #e9e9e9;  border-radius: 20px">
                        <h1 style="font-size: 25px; ">
                            <?php echo "Admin Id: " . $chhid ?><br>
                            <?php echo "Name: " . $fname . " " . $lname ?>
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
                <h1 style="font-size: 50px;color: #00cf7a ">View Doctors</h1>
                <a href="viewDoctors.php" class="form-button-one" style="border-color: #00cf7a; color: #00cf7a"><i
                        class="fas fa-file-medical"></i> View Doctors</a>
            </div>
            <div class="col-lg-5 box" style="vertical-align: middle; padding: 50px; font-family: Varela Round ">
                <h1 style="font-size: 50px; color: #1e78ff">Add Doctors</h1>
                <a href="addDoctors.php" class="form-button-one" style="border-color: #1e78ff; color: #1e78ff"><i
                        class="fas fa-clipboard"></i> Add Doctors</a>
            </div>
        </div>
        <div class=row>
            
            <div class="col-lg-offset-1 col-lg-5 box" style="vertical-align: middle; padding: 50px; font-family: Varela Round ">
                <h1 style="font-size: 50px; color: #00cf7a">View Patients</h1>
                <a href="viewAllPatients.php" class="form-button-one" style="border-color: #00cf7a; color: #00cf7a"><i
                        class="fas fa-clipboard"></i> View Patients</a>
            </div>
            <div class="col-lg-5 box" style="vertical-align: middle; padding: 50px; font-family: Varela Round ">
                <h1 style="font-size: 50px; color: #1e78ff">Assign Patients To Doctors</h1>
                <a href="assignPatients.php" class="form-button-one" style="border-color: #1e78ff; color: #1e78ff"><i
                        class="fas fa-clipboard"></i>Assign Patients To Doctors</a>
            </div>
            
            <div class="col-lg-offset-1 col-lg-5 box" style="vertical-align: middle; padding: 50px; font-family: Varela Round ">
                <h1 style="font-size: 50px; color: #00cf7a">View Admins</h1>
                <a href="viewAllAdmins.php" class="form-button-one" style="border-color: #00cf7a; color: #00cf7a"><i
                        class="fas fa-clipboard"></i> View Admins</a>
            </div>
            <div class="col-lg-5 box"
                style="vertical-align: middle; padding: 50px; font-family: Varela Round ">
                <h1 style="font-size: 50px; color: #1e78ff">Add Admins</h1>
                <a href="addAdmins.php" class="form-button-one" style="border-color: #1e78ff; color: #1e78ff"><i
                        class="fas fa-clipboard"></i> Add Admins</a>
            </div>
            <div class="col-lg-offset-1 col-lg-5 box" style="vertical-align: middle; padding: 50px; font-family: Varela Round ">
                <h1 style="font-size: 50px; color: #00cf7a">View Pharmacists</h1>
                <a href="viewAllPharmacists.php" class="form-button-one" style="border-color: #00cf7a; color: #00cf7a"><i
                        class="fas fa-clipboard"></i> View Pharmacists</a>
            </div>
        
            <div class="col-lg-5 box"
                style="vertical-align: middle; padding: 50px; font-family: Varela Round ">
                <h1 style="font-size: 50px; color: #1e78ff">Add Pharmacists</h1>
                <a href="addPharmacists.php" class="form-button-one" style="border-color: #1e78ff; color: #1e78ff"><i
                        class="fas fa-clipboard"></i> Add Pharmacists</a>
            </div>
            <div class="col-lg-offset-1 col-lg-5 box" style="vertical-align: middle; padding: 50px; font-family: Varela Round ">
                <h1 style="font-size: 50px; color: #ffbd00 ">Records & Reports</h1>
                <a href="displayReports.php" class="form-button-one" style="border-color: #00cf7a; color: #00cf7a"><i
                        class="fas fa-file-medical"></i> View Reports</a>
                <a href="displayRecords.php" class="form-button-one" style="border-color: #1e78ff; color: #1e78ff"><i
                        class="fas fa-clipboard"></i> View Records</a>
            </div>
        </div>
    </body>

    </html>
    <?php
} else {
    header('Location: patientlogin.php');
} ?>