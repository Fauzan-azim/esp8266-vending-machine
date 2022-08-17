<?php 
	session_start();
	include '../connection/connection.php';
	// $conn = mysqli_connect("localhost", "root", "", "vendingmachine");
	$stat = $_GET['stat'];
	$id = $_GET['id'];
	$amount =$_GET['amount'];
	$total = $_GET['total'];
	$buyer = $_GET['buyer'];
	
	if ($stat == "ON") {
		$sql = "UPDATE `pesan` SET `relay`= 0 WHERE `id` =1";

		if (mysqli_query($conn, $sql)) {
		  echo "Ordered";

		} else {
		  echo "Error updating record: " . mysqli_error($conn);
		}

		$sql2 = "UPDATE `login` SET `balance` = balance - '$total' WHERE `email` = '$buyer'";	
			if (mysqli_query($conn, $sql2)) {
			  echo "updated";
			  header("Location: test.php");
			  $_SESSION['mail'] ;

			} else {
			  echo "Error updating record: " . mysqli_error($conn);
			}
	}

	else{
		mysqli_query($conn,"UPDATE `pesan` SET `relay`=1 WHERE `id` =1");
		echo "Order";
	}
	
	
	
 ?>
