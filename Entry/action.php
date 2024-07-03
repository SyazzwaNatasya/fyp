<?php
	session_start();
	require '../db.php';

	// Add products into the cart table
	if (isset($_POST['aid'])) {
	  $aid = $_POST['aid'];
	  $pname = $_POST['pname'];
	  $pdetails = $_POST['pdetails'];
	  $pprice = $_POST['pprice'];
	  $pqty = $_POST['pqty'];
	  $total_price = $pprice * $pqty;

	  $stmt = $con->prepare('SELECT activityID FROM checkout WHERE activityID=?');
	  $stmt->bind_param('i',$aid);
	  $stmt->execute();
	  $res = $stmt->get_result();
	  $r = $res->fetch_assoc();
	  $code = $r['activityID'] ?? '';

	  if (!$code)
	   {
		$checkoutID = uniqid('A');
			// Add to checkout/cart table
			$query    = "INSERT into checkout (checkoutID, activityID, quantity, total_price) 
			VALUES ('$checkoutID', '$aid', '$pqty', '$total_price')";
       		$result   = mysqli_query($con, $query);

			// // Add to order table  
			// $sql    = "INSERT into orders (orderID, activityID, quantity, total_price) 
			// VALUES ('$checkoutID', '$aid', '$pqty', '$total_price')";
       		// $result   = mysqli_query($con, $sql);


	    echo '<div class="alert alert-success alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item added to your cart!</strong>
						</div>';
	  } 
	  else 
	  {
	    echo '<div class="alert alert-danger alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item already added to your cart!</strong>
						</div>';
	  }
	  
	}

	// Get no.of items available in the cart table
	if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
	  $stmt = $con->prepare('SELECT * FROM checkout');
	  $stmt->execute();
	  $stmt->store_result();
	  $rows = $stmt->num_rows;

	  echo $rows;
	}

	// Remove single items from cart
	if (isset($_GET['remove'])) {
	  $ID = $_GET['remove'];

	  // Remove from cart
	  $stmt = $con->prepare('DELETE FROM checkout WHERE ID=?');
	  $stmt->bind_param('i',$ID);
	  $stmt->execute();

	//   $stmt = $con->prepare('DELETE FROM orders WHERE ID=?');
	//   $stmt->bind_param('i',$ID);
	//   $stmt->execute();

	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'Item removed from the cart!';
	  header('location:cart.php');
	}

	// Remove all items at once from cart
	if (isset($_GET['clear'])) {

	  $stmt = $con->prepare('DELETE FROM checkout');
	  $stmt->execute();

	 // $stmt = $con->prepare('DELETE FROM orders');
	 // $stmt->execute();

	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'All Item removed from the cart!';
	  header('location:cart.php');
	}

	if (isset($_GET['order'])) {
		
	  }

	// Set total price of the product in the cart table
	if (isset($_POST['quantity'])) {
	  $qty = $_POST['quantity'];
	  $aid = $_POST['aid'];
	  $pprice = $_POST['pprice'];

	  $tprice = $qty * $pprice;

	  $stmt = $con->prepare('UPDATE checkout SET quantity=?, total_price=? WHERE checkoutID=?');
	  $stmt->bind_param($qty,$tprice,$aid);
	  $stmt->execute();

	//   $stmt = $con->prepare('UPDATE orders SET quantity=?, total_price=? WHERE orderID=?');
	//   $stmt->bind_param($qty,$tprice,$aid);
	//   $stmt->execute();
	}

	// Checkout and save customer info in the orders table
	if (isset($_POST['action']) && isset($_POST['action']) == 'order') {
	  $checkoutID = $_POST['checkoutID'];
	  $name = $_POST['name'];
	  $email = $_POST['email'];
	  $numberOfPeople = $_POST['numberOfPeople'];
	  $dateOfVisit = $_POST['dateOfVisit'];
	  $touristOrigin = $_POST['touristOrigin'];
	  $activity = $_POST['products'];
	  $grand_total = $_POST['grand_total'];
	  $payment_method = $_POST['pmode'];

	  $data = '';

	  $result = mysqli_query($con,"SELECT checkoutID FROM checkout ORDER BY checkoutID DESC LIMIT 1");
	  $cek= mysqli_fetch_array($result);
  
	  $checkoutID = $cek["checkoutID"];

	  $stmt = $con->prepare('UPDATE checkout SET checkoutID=?');
	  $stmt->bind_param("s",$checkoutID);
	  $stmt->execute();

	  $sql = mysqli_query($con,"INSERT INTO orders (OrderID, ActivityID, quantity, total_price) SELECT checkoutID, activityID, quantity, total_price FROM checkout");
	  $row= mysqli_fetch_array($result);
	
	  $query    = "INSERT into receipt (OrderID, Name, Email, amount_paid, numberOfPeople, dateOfVisit, touristOrigin, payment_method) 
		VALUES ('$checkoutID', '$name', '$email', '$grand_total', '$numberOfPeople', '$dateOfVisit', '$touristOrigin', '$payment_method')";
      $result   = mysqli_query($con, $query);
	  $stmt2 = $con->prepare('DELETE FROM checkout');
	  $stmt2->execute();
	  $data .= '<div class="text-center">
								<h1 class="display-4 mt-2 text-danger">Thank You!</h1>
								<h2 class="text-success">Your Order Placed Successfully!</h2>
								<h4 class="bg-danger text-light rounded p-2">Items Purchased : ' . $activity . '</h4>
								<h4>Your Name : ' . $name . '</h4>
								<h4>Your E-mail : ' . $email . '</h4>
								<h4>Total Amount Paid : ' . number_format($grand_total,2) . '</h4>
								<h4>Number Of People : ' . $numberOfPeople . '</h4>
								<h4>Date of Visit : ' . $dateOfVisit . '</h4>
								<h4>Origin : ' . $touristOrigin . '</h4>
								<h4>Payment Mode : ' . $payment_method . '</h4>
								<button class="btn btn-info btn-block addItemBtn"><a href="index.php">Done</a></button>
						  </div>';
	  echo $data;
	}
?>	