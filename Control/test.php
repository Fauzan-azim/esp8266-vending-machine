<?php
	session_start();
	include '../connection/connection.php';
	$buyer = $_SESSION['mail'];

    $sql = mysqli_query($conn, "SELECT amount FROM invoices WHERE buyer= '$buyer'");
    while ($row = mysqli_fetch_assoc($sql)){
         $duration = $row['amount'];
         
    }
    echo $duration;


 ?>
