<?php
session_start();
	include '../connection/connection.php';
	
	$relay1SQL = mysqli_query($conn, "SELECT Name, id, Harga FROM pesan WHERE id = 1");
	while($row = mysqli_fetch_assoc($relay1SQL) ) {
		 $itemName = $row['Name'];
		 $itemID = $row['id'];
		 $itemPrice = $row['Harga'];
	}
	$relay2SQL = mysqli_query($conn, "SELECT Name, id, Harga FROM pesan WHERE id = 2");
	while($row = mysqli_fetch_assoc($relay2SQL)) {
		 $itemName2 = $row['Name'];
		 $itemID2 = $row['id'];
		 $itemPrice2 = $row['Harga'];
	}
	$mail = $_SESSION['mail'];
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Vending Machine</title>
		
    	
  </head>
  <body>
	<div class="jumbotron jumbotron-fluid">
	  <div class="container">
	    <h1 class="display-4">Vending Machine</h1>
	    <p class="lead">This is a Group 3 IoT project for the final exam XD.</p>
	  </div>
	</div>
		  <?php
             $getAllData = mysqli_query($conn, "SELECT balance FROM login WHERE email='$mail'");
             while ($data = mysqli_fetch_assoc($getAllData)){
                 $balance = $data['balance'];}
            ?>
	  <div class="container bg-info">
	    <h1>Your Balance : <?=$balance; ?></h1> 
	     <form action="topup.php" method="post" enctype="multipart/form-data">
	            <input type="hidden" name="topupvalue" value="100000">
	            <button type="submit" name="topup" class="btn btn-primary">TOP UP</button>
	      </form>
	  </div>
	
   <main class="control-form">
     <div class="container">
       <div class="row ">
		  <div class="col-sm-2 text-center">
		    <div class="card">
		     <h5 class="card-header bg-info text-white ">Coca Cola</h5>
		      <div class="card-body">
		        <img class="card-img-top " src="../img/cola.jpeg" alt="Card image cap">
		        <button type="submit" name="orderItem" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Order</button>
		      </div>
		    </div>
		  </div>

		  <div class="col-sm-2 text-center">
		    <div class="card ">
		     <h5 class="card-header bg-info text-white">Orange Juice</h5>	
		      <div class="card-body">
		      	
		      	<img class="card-img-top" src="../img/orange.jpg" alt="Card image cap">
		        <button type="submit" name="orderItem" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">Order</button>
		      </div>
		    </div>
		  </div>

		</div>
     </div>
     <div class="modal fade" id="myModal">
	    <div class="modal-dialog">
	      <div class="modal-content">
	      
	        <!-- Modal Header -->
	        <div class="modal-header">
	          <h4 class="modal-title">Order Item</h4>
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        
	        <!-- Modal body -->
	         <form action="invoice.php" method="post" enctype="multipart/form-data" id="form1">
	            <div class="modal-body">
	            <input type="text" name="Name" value="<?=$itemName;?>" class="form-control" required>
	            <br>    
	            <input type="number" name="Amount" value="" class="form-control" placeholder="Amount" required>
	            <br>
	            <label>Price per item : </label>
	            <input type="text" name="Harga" value="<?=$itemPrice;?>" class="form-control" readonly>
	            <br>
	            <input type="hidden" name="ids" value="<?=$itemID;?>">
	            <input type="hidden" name="buyer" value="<?=$mail;?>">
	            <button type="submit" name="orderItem" class="btn btn-primary" value="ON" id="item1">Order</button>
	            </div>
	        </form>
	        <!-- Modal footer -->
	        <div class="modal-footer">
	          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	        </div>
	        
	      </div>
	    </div>
	 </div>
     <div class="modal fade" id="myModal2">
	    <div class="modal-dialog">
	      <div class="modal-content">
	      
	        <!-- Modal Header -->
	        <div class="modal-header">
	          <h4 class="modal-title">Order Item</h4>
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        
	        <!-- Modal body -->
	         <form action="invoice.php" method="post" enctype="multipart/form-data" id="form2">
	            <div class="modal-body">
	            <input type="text" name="Name" value="<?=$itemName2;?>" class="form-control" required>
	            <br>    
	            <input type="number" name="Amount" class="form-control" placeholder="Amount" required>
	            <br>	            
	            <label>Price per item : </label>
	            <input type="text" name="Harga" value="<?=$itemPrice2;?>" class="form-control" readonly>
	            <br>
	            <input type="hidden" name="ids" value="<?=$itemID2;?>">
	            <button type="submit" name="orderItem" class="btn btn-primary" value="OFF" id="item2">Order</button>
	            </div>
	        </form>
	        <!-- Modal footer -->
	        <div class="modal-footer">
	          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	        </div>
	        
	      </div>
	    </div>
	 </div>
    

    </main>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>