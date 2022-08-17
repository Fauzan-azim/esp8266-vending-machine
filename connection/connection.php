<?php 

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "vendingmachine";

$conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);

	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}



// class db{
// 	public $dbhost;
// 	public $dbUser;
// 	public $dbPass;
// 	public $dbName;
// 	public $conn;
	
// 	public function _construct($dbhost, $dbUser, $dbPass ,$dbName){
// 		 $this->dbhost = $dbhost;
// 		 $this->dbUser = $dbUser;
// 		 $this->dbPass = $dbPass;
// 		 $this->dbName = $dbName;
// 	}

// 	public function connect()
// 		{
// 			$this->link = new mysqli($this->dbhost,$this->dbUser,$this->dbPass,$this->dbName);
// 			if (mysqli_connect_error())
// 			{
// 				echo mysqli_connect_error();
// 				exit();
// 			}
// 			else
// 				return $this->link;

// 		}
// }
?>