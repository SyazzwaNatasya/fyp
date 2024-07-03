<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Add New Activity</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../login/style.css"/>

</head>
<body>
<?php
    require('../db.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['submit'])) {
        // removes backslashes
        $activityName = stripslashes($_REQUEST['activityName']);
        //escapes special characters in a string
        $activityName = mysqli_real_escape_string($con, $activityName);
        $activityDetails = $_REQUEST['activityDetails'];
        $activityDetails = mysqli_real_escape_string($con, $activityDetails);
        $price = $_REQUEST['price'];
        $price = mysqli_real_escape_string($con, $price);
        $entryDate = date("Y-m-d");
        $query    = "INSERT into activity (activityName, activityDetails, price, quantity, entryDate)
                     VALUES ('$activityName', '$activityDetails', '$price', '1', '$entryDate')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>Successfully Added.</h3><br/>
                  <p class='link'>Click here to <a href='list_activity.php'>the list</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='new_activity.php'>add</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Add New Activity</h1>
        <input type="text" class="login-input" name="activityName" placeholder="Activity Name" required />
        <input type="text" class="login-input" name="activityDetails" placeholder="Details">
        <input type="price" class="login-input" name="price" placeholder="Price eg: 5.00">
        <input type="submit" name="submit" value="submit" class="login-button">
        </br></br><a class="nav-link scrollto" href="../Mainpage.php">Home</a>
    </form>
<?php
    }
?>
</body>
</html>
