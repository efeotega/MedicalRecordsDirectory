<!DOCTYPE html>

<?php
include 'connection.php';

if (isset($_POST['submit'])) {
    $fname = mysqli_real_escape_string($db, $_POST['fname']);
    $lname = mysqli_real_escape_string($db, $_POST['lname']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $password = md5($password);
    $query = "INSERT INTO admins (`fname`,`lname`,`email`, `password`) 
  			  VALUES('$fname','$lname','$email','$password')";

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
    <title>Add Admins | CHH</title>
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
                    <a href="index.php" style="float: left; padding-left: 50px; color: black">Central Health Hospital |
                        Add Admins</a>
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
                <form action="addAdmins.php" class="content-section" method="POST">
                    <h1 style="font-size: 50px; ">ADD ADMINS</h1>
                    <div class="row form-input-group">
                        <label style="float: left; vertical-align: middle;" class="col-lg-2">First Name</label><input
                            name="fname" type="text" class="input-box col-lg-10" required>
                    </div>

                    <div class="row form-input-group">
                        <label style="float: left; vertical-align: middle;" class="col-lg-2">Last Name</label><input
                            name="lname" type="text" class="input-box col-lg-10" required>
                    </div>


                    <div class="row form-input-group">
                        <label style="text-align: left" class="col-lg-2">Email</label><input name="email" type="email"
                            class="input-box col-lg-4" required>
                        <label style="text-align: center" class="col-lg-2">Password</label><input name="password"
                            type="password" class="input-box col-lg-4" required>
                    </div>
                    <button type="submit" name="submit" class="form-button-one"
                        style="border-color: #00cf7a; color: #00cf7a">Add Admin</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>