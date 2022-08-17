<?php 
session_start();
include '../connection/connection.php';
	// $conn = mysqli_connect("localhost", "root", "", "vendingmachine");
	$topupvalue = $_POST['topupvalue'];
	$mail = $_SESSION['mail'];
    
	if (isset($_POST['topup'])) {
		$sql = "UPDATE `login` SET `balance`= '$topupvalue' WHERE `email` ='$mail'";

		if (mysqli_query($conn, $sql)) {
		  echo "Ordered";

		} else {
		  echo "Error updating record: " . mysqli_error($conn);
		}
	}
 ?>