<!DOCTYPE html>

<?php
include 'connection.php';
session_start();
if (isset($_SESSION['pharmacist_logged_in'])) {
    header('Location: pharmacistHome.php');
} else {
    if (isset($_POST['email'], $_POST['password'])) {
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if (empty($email) or empty($password)) {
            $error = 'All Fields Required!';
        } else {
            $password = md5($password);
            $query = "SELECT * FROM pharmacists WHERE email='$email' AND password='$password'";
            $results = mysqli_query($db, $query);
            $rows = mysqli_num_rows($results);
            if ($rows == 1) {
                $_SESSION['pharmacist_logged_in'] = TRUE;
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['password'] = $_POST['password'];
                header('Location: pharmacistHome.php');
                exit();
            } else {
                $error = 'Incorrect Credentials!';
            }
        }
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
    <title>LOGIN | CHH</title>
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
                    <a href="index.php" style="float: left; padding-left: 50px; color: black">Central Health Hospital</a>
                </span>
                <span style="float: right;">
                    <a href="logout.php" onclick="return confirmLogout();" style="color:#252525"><i class="fas fa-sign-out-alt"></i>Log Out</a>
                </span>
            </center>
        </div>
    </div>
    <div class="col-lg-offset-4 col-lg-4 box" style="vertical-align: middle; padding: 20px">
        <form action="pharmacistLogin.php" method="POST">
            <h1 style="font-size: 50px; font-family: bebas-neue ;">Pharmacist Login</h1>
            <?php if (isset($error)) { ?>
                <br>
                <small style="font-size: 15px; font-family: 'Montserrat'; color: #aa0000;">
                    <?php echo $error; ?>
                </small><br>
                <br>
            <?php } ?>
            <div class="row form-input-group">
                <label style="text-align: left">Email</label><br><br>
                <input placeholder="Email" type="email" name="email" class="input-box col-lg-12" autocomplete="off"
                    required>
            </div>
            <div class="row form-input-group">
                <label style="text-align: left">Password</label><br><br>
                <input placeholder="Password" type="password" name="password" class="input-box col-lg-12"
                    autocomplete="off" required>
                    <input type="checkbox" id="showPassword"> Show Password</input>
            </div>
            <br>
            <br>
            <button type="submit" name="submit" class="form-button-one"
                style="background-color: #00cf7a; border-color:#00cf7a; color: white">Login</button>
            <script>
        // Get references to the password input and the checkbox
        const passwordInput = document.getElementById('password');
        const showPasswordCheckbox = document.getElementById('showPassword');

        // Add event listener to the checkbox
        showPasswordCheckbox.addEventListener('change', function () {
            // If checkbox is checked, show the password
            if (this.checked) {
                passwordInput.type = 'text';
            } else {
                // Otherwise, hide the password
                passwordInput.type = 'password';
            }
        });

    </script>
        </form>
        
    </div>
    
</body>

</html>