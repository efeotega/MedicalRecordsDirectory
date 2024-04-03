<!DOCTYPE html>

<?php
include 'connection.php';

if (isset($_POST['submit'])) {
    $fname = mysqli_real_escape_string($db, $_POST['fname']);
    $lname = mysqli_real_escape_string($db, $_POST['lname']);
    $specialty = mysqli_real_escape_string($db, $_POST['specialty']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $password = md5($password);
    $query = "INSERT INTO doctors (`fname`,`lname`, `specialty`,`email`, `password`) 
  			  VALUES('$fname','$lname','$specialty','$email','$password')";

    $result = mysqli_query($db, $query);
    if ($result != null) {
        $message = "Successfull";
        echo "<script>alert('$message');</script>";
        header("location:adminHome.php");
    }
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Register Doctor | CHH</title>
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
                    <a href="login.php" style="color:#252525"><i class="fas fa-sign-in-alt"></i></a>
                </span>
            </center>
        </div>
    </div>
    <div>
        <div>
            <div class="col-lg-offset-1 col-lg-10 box" style="vertical-align: middle; padding: 20px">
                <form action="addDoctors.php" class="content-section" method="POST">
                    <h1 style="font-size: 50px; ">Add Doctor</h1>
                    <?php
                    if (isset($chhid_generated)) {
                        echo $chhid_generated;
                    }
                    ?>
                    <div class="row form-input-group">
                        <label style="float: left; vertical-align: middle;" class="col-lg-2">First Name</label><input
                            name="fname" type="text" class="input-box col-lg-10" required>
                    </div>

                    <div class="row form-input-group">
                        <label style="float: left; vertical-align: middle;" class="col-lg-2">Last Name</label><input
                            name="lname" type="text" class="input-box col-lg-10" required>
                    </div>
                    <div class="row form-input-group">
                        <label style="float: left; vertical-align: middle;" class="col-lg-2">Specialty</label><input
                            name="specialty" type="text" class="input-box col-lg-10" required>
                    </div>
                    <div class="row form-input-group">
                        <label style="text-align: left" class="col-lg-2">Email</label><input name="email" type="email"
                            class="input-box col-lg-4" required>
                        <label style="text-align: center" class="col-lg-2">Password</label><input name="password"
                            type="password" class="input-box col-lg-4" required>
                    </div>
                    <button type="submit" name="submit" class="form-button-one"
                        style="border-color: #00cf7a; color: #00cf7a">Register</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>