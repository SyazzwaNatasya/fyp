<?php

    require('../db.php');

    $activityID = $_GET['activityID'];
    /*echo $activityID;*/

    mysqli_query($con,"DELETE FROM activity WHERE activityID='$activityID'");
	header('location:list_activity.php');
    

?>