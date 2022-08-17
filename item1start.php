<?php 
	
	include 'connection/connection.php';


	$SQL = mysqli_query($conn, "SELECT relay FROM pesan WHERE id = 1");
	while($row = mysqli_fetch_assoc($SQL)) {
	 $relay1 = $row["relay"];
	}
	//response to NodeMCU 
	echo $relay1;
	
 ?>