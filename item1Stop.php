
 <?php 
	include 'connection/connection.php';
	if(($_POST['status']) == 0)
    {
    	$status = $_POST['status'];

	    $sql = "UPDATE pesan SET relay='1' WHERE id=1";

		if ($conn->query($sql) === TRUE) {
		    echo "OK";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	

?>
