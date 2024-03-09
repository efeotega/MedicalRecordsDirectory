<!DOCTYPE html>

<?php
include 'connection.php';

if (isset($_POST['submit'])) {
    $fname = mysqli_real_escape_string($db, $_POST['fname']);
    $lname = mysqli_real_escape_string($db, $_POST['lname']);
    $chhid = strtoupper(uniqid('CHH'));
    $dob = mysqli_real_escape_string($db, $_POST['dob']);
    $gender = mysqli_real_escape_string($db, $_POST['gender']);
    $state = mysqli_real_escape_string($db, $_POST['state']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $password = md5($password);
    $query = "INSERT INTO patients (`chhid`, `fname`,`lname`, `dob`, `gender`, `state`, `phone`, `email`, `password`) 
  			  VALUES('$chhid' , '$fname','$lname', '$dob', '$gender', '$state', '$phone','$email','$password')";

    mysqli_query($db, $query);

    $query_table = "CREATE TABLE `$chhid` ( `sl` INT NOT NULL AUTO_INCREMENT , `symptoms` VARCHAR(255) NOT NULL , `diagnosis` VARCHAR(255) NOT NULL , `date` DATE NOT NULL , `dr` VARCHAR(255) NOT NULL , `trtmnt` VARCHAR(500) NOT NULL , `medicines` VARCHAR(200) NOT NULL , PRIMARY KEY (`sl`))";
    mysqli_query($db, $query_table);

    mkdir($chhid, 0777);

    $chhid_generated = "Registration Successful.<br>Your Central Health Hospital ID number is <b>" . $chhid . "</b>.<br> Please note it down for future use. Proceed to <a href='patientlogin.php'>Login</a>";
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Register | CHH</title>
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
                    <a href="index.php" style="float: left; padding-left: 50px; color: black">Central Health Hospital</a>
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
                <form action="patientRegister.php" class="content-section" method="POST">
                    <h1 style="font-size: 50px; ">REGISTER</h1>
                    <?php
                    if (isset($chhid_generated)) {
                        echo $chhid_generated;
                    }
                    ?>
                    <div class="row form-input-group">
                        <label style="float: left; vertical-align: middle;" class="col-lg-2">First Name</label><input
                            name="fname" type="text" class="input-box col-lg-10">
                    </div>

                    <div class="row form-input-group">
                        <label style="float: left; vertical-align: middle;" class="col-lg-2">Last Name</label><input
                            name="lname" type="text" class="input-box col-lg-10">
                    </div>
                    <div class="row form-input-group">
                        <label style="float: left; vertical-align: middle;" class="col-lg-2">DOB</label><input
                            name="dob" type="date" class="input-box col-lg-4">
                        <label style="text-align: center" class="col-lg-2">Gender</label>
                        <select name="gender" class="input-box col-lg-4">
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                        </select>
                    </div>
                    <div class="form-input-group">
                        <div class="row">
                            <label style="float: left" class="col-lg-2">State</label>
                            <select name="state" class="input-box col-lg-4">
                                <option value="">Select State</option>
                                <option value="Abia">Abia</option>
                                <option value="Adamawa">Adamawa</option>
                                <option value="Akwa Ibom">Akwa Ibom</option>
                                <option value="Anambra">Anambra</option>
                                <option value="Bauchi">Bauchi</option>
                                <option value="Bayelsa">Bayelsa</option>
                                <option value="Benue">Benue</option>
                                <option value="Borno">Borno</option>
                                <option value="Cross River">Cross River</option>
                                <option value="Delta">Delta</option>
                                <option value="Ebonyi">Ebonyi</option>
                                <option value="Edo">Edo</option>
                                <option value="Ekiti">Ekiti</option>
                                <option value="Enugu">Enugu</option>
                                <option value="Gombe">Gombe</option>
                                <option value="Imo">Imo</option>
                                <option value="Jigawa">Jigawa</option>
                                <option value="Kaduna">Kaduna</option>
                                <option value="Kano">Kano</option>
                                <option value="Katsina">Katsina</option>
                                <option value="Kebbi">Kebbi</option>
                                <option value="Kogi">Kogi</option>
                                <option value="Kwara">Kwara</option>
                                <option value="Lagos">Lagos</option>
                                <option value="Nasarawa">Nasarawa</option>
                                <option value="Niger">Niger</option>
                                <option value="Ogun">Ogun</option>
                                <option value="Ondo">Ondo</option>
                                <option value="Osun">Osun</option>
                                <option value="Oyo">Oyo</option>
                                <option value="Plateau">Plateau</option>
                                <option value="Rivers">Rivers</option>
                                <option value="Sokoto">Sokoto</option>
                                <option value="Taraba">Taraba</option>
                                <option value="Yobe">Yobe</option>
                                <option value="Zamfara">Zamfara</option>
                                <option value="Federal Capital Territory">Federal Capital Territory</option>

                            </select>
                            <label style="text-align: center; vertical-align: middle;"
                                class="col-lg-2">Phone</label><input name="phone" type="text"
                                class="input-box col-lg-4">
                        </div>
                    </div>
                    <div class="row form-input-group">
                        <label style="text-align: left" class="col-lg-2">Email</label><input name="email" type="email"
                            class="input-box col-lg-4">
                        <label style="text-align: center" class="col-lg-2">Password</label><input name="password"
                            type="password" class="input-box col-lg-4">
                    </div>
                    <button type="submit" name="submit" class="form-button-one"
                        style="border-color: #00cf7a; color: #00cf7a">Send registration Request</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>