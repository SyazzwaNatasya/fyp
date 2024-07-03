<?php
require('../db.php');
$activityID = $_GET['activityID'];

if(count($_POST)>0) 
{
   $activityName = $_POST['activityName'];
   $activityDetails = $_POST['activityDetails'];
   $price = $_POST['price'];

   mysqli_query($con,"UPDATE activity set activityName='$activityName', activityDetails='$activityDetails', price='$price' WHERE activityID='$activityID'");
   header('location:list_activity.php');
}

$activityID = $_GET['activityID'];
$result = mysqli_query($con,"SELECT * FROM activity WHERE activityID='$activityID'");
$row= mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Update Activity</title>
    <link rel="stylesheet" href="../login/style.css"/>
</head>
<body>
    <form class="form" action="" method="post">
        <h1 class="login-title">Update Activity</h1>
        <input type="text" class="login-input" name="activityName" value="<?php echo $row['activityName']; ?>"/>
        <input type="text" class="login-input" name="activityDetails" value="<?php echo $row['activityDetails']; ?>">
        <input type="price" class="login-input" name="price" value="<?php echo $row['price']; ?>" >
        <input type="submit" name="submit" value="Update Activity" class="login-button">
    </form>
</body>
</html>
