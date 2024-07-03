<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>History</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
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
    
<style>
body {
    color: #404E67;
    background: #F5F7FA;
    font-family: 'Open Sans', sans-serif;
}
.table-wrapper {
   /* width: 700px; */
    margin: 30px auto;
    background: #fff;
    padding: 20px;	
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.table-title {
    padding-bottom: 10px;
    margin: 0 0 10px;
}
.table-title h2 {
    margin: 6px 0 0;
    font-size: 22px;
}
.table-title .add-new {
    float: right;
    height: 30px;
    font-weight: bold;
    font-size: 12px;
    text-shadow: none;
    min-width: 100px;
    border-radius: 50px;
    line-height: 13px;
}
.table-title .add-new i {
    margin-right: 4px;
}
table.table {
    table-layout: fixed;
}
table.table tr th, table.table tr td {
    border-color: #e9e9e9;
}
table.table th i {
    font-size: 13px;
    margin: 0 5px;
    cursor: pointer;
}
table.table th:last-child {
    width: 100px;
}
table.table td a {
    cursor: pointer;
    display: inline-block;
    margin: 0 5px;
    min-width: 30px;
}    
table.table td a.add {
    color: #27C46B;
}
table.table td a.edit {
    color: #FFC107;
}
table.table td a.delete {
    color: #E34724;
}
table.table td i {
    font-size: 19px;
}
table.table td a.add i {
    font-size: 24px;
    margin-right: -1px;
    position: relative;
    top: 3px;
}    
table.table .form-control {
    height: 32px;
    line-height: 32px;
    box-shadow: none;
    border-radius: 2px;
}
table.table .form-control.error {
    border-color: #f50000;
}
table.table td .add {
    display: none;
}
</style>

   <?php 
	    require('../db.php');
   ?>

</head>
<body>
<header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="../Mainpage.php">Bombon Marakau</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt=""></a> -->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="../Mainpage.php">Home</a></li>
          <li><a href="../Activity/list_activity.php">Activity</a></li>
          <li><a href="history.php">History</a></li>
          <li class="dropdown"><a href="#"><span>Report</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="../Report/salesReport.php">Sales Report</a></li>
                    <li><a href="../Report/originReport.php">Origin Statistic</a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="../profile.php">Profile</a></li>
          <li><a class="nav-link scrollto" href="../login/logout.php">Logout</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

<div class="container-lg">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Bombon Marakau Sales History</h2></div>
                </div>
            </div>
            <!-- generate sales report -->
            <form action = ../Report/overallReport.php>
                <div align ="right">
                    <input type="submit" value="Generate Report" class="login-button col-sm-3">
                </div>
            </form>
            <!-- end generate report -->
            <br>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Bil. </th>
                        <th>Customer Name</th>
                        <th>Activity Name</th>
                        <th>Number of people</th>
                        <th>Date of Visit</th>
                        <th>Total Paid</th>
                        <th>Origin</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $results = mysqli_query($con, "SELECT receipt.receiptID, receipt.OrderID, receipt.Name, receipt.numberOfPeople, receipt.dateOfVisit, receipt.amount_paid, receipt.touristOrigin, orders.OrderID, orders.ActivityID, activity.activityID, activity.activityName FROM orders INNER JOIN receipt ON orders.OrderID = receipt.OrderID INNER JOIN activity ON orders.ActivityID = activity.activityID");
                $bil = 1;
                while ($row = mysqli_fetch_array($results)) 
                { 
                ?>
                <tr>
                    <td><?php echo $bil ?></td>
				    <td><?php echo $row['Name']; ?></td>
				    <!-- <td><?php echo $row['receiptID']; ?></td> -->
                    <td><?php echo $row['activityName']; ?></td>
				    <td><?php echo $row['numberOfPeople']; ?></td>
                    <td><?php echo $row['dateOfVisit']; ?></td>
                    <td>RM<?php echo $row['amount_paid']; ?></td>
                    <td><?php echo $row['touristOrigin']; ?></td>
                </tr>   
	            <?php 
                $bil++;
                } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>     
</body>
</html>