<!DOCTYPE html>

<html>
    <head>
    <script>
            function confirmLogout() {
                return confirm("Are you sure you want to log out?");
            }
        </script>
        <meta charset="UTF-8">
        <title>Medical Reports</title>
        <link rel="icon" href="favicon.ico" sizes="20x20" type="image/png">  
        <link rel="stylesheet" type="text/css" href="css/dashboard.css">
        <link rel="stylesheet" type="text/css" href="css/flexboxgrid.css">
        <link rel="stylesheet" type="text/css" href="css/forms.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.typekit.net/sgr8dvc.css">
        <link href="https://fonts.googleapis.com/css?family=Lato|Montserrat|Open+Sans|Oswald|Raleway|Roboto" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    </head>
    <body style=" height:  100%; background-color: #f5f5f5; padding-bottom: 10px;">
        <div class="dashboard-navbar-light">
            <div class="dashboard-navbar-options-light nav-title" style="width: 100%;">
                <center>
                    <span>
                        <a href="index.php" style="float: left; padding-left: 50px; color: black">Central Health Hospital</a>
                    </span>
                    <span style="float: right;">
                        <a href="patientHome.php" style="color:#252525"><i class="fas fa-home"></i></a>  
                        <a href="logout.php" onclick="return confirmLogout();" style="color:#252525"><i class="fas fa-sign-out-alt" ></i></a>
                    </span> 
                </center>
            </div>
        </div>
        <?php
        // put your code here
        ?>
    </body>
</html>
