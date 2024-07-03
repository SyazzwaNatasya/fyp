<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    require('../db.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['userName'])) {
        // removes backslashes
        $userName = stripslashes($_REQUEST['userName']);
        //escapes special characters in a string
        $userName = mysqli_real_escape_string($con, $userName);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $contact = stripslashes($_REQUEST['contact']);
        $contact = mysqli_real_escape_string($con, $contact);
        $create_datetime = date("Y-m-d H:i:s");
        $query    = "INSERT INTO user (userName, password, email, contact)
                     VALUES ('$userName', '$password', '$email', '$contact')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="userName" placeholder="Username" required />
        <input type="password" class="login-input" name="password" placeholder="Password" required>
        <input type="text" class="login-input" name="contact" placeholder="Contact" required>
        <input type="email" class="login-input" name="email" placeholder="Email" required>
        
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link">Already have an account? <a href="login.php">Login here</a></p>
    </form>
<?php
    }
?>
</body>
</html>
