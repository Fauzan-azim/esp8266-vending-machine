<?php 
	include '../connection/connection.php';
	session_start();
	$amount = $_POST['Amount'];
	$itemID = $_POST['ids'];
	$hargaitem = $_POST['Harga'];
	$itemName = $_POST['Name'];
  $buyer = $_POST['buyer'];
	$total = $amount * $hargaitem;
	
	if (empty($amount || $itemID || $hargaitem || $itemName || $total)) {
		header("Location: invoice.php?error=Missing Data");
		exit();
	}else{
		$addInvoice = mysqli_query($conn, "INSERT INTO `invoices`(`buyer`,`item_name`, `price`, `amount`, `total` ) 
			          VALUES ('$buyer','$itemName','$hargaitem','$amount', '$total')");
		
	}
	
	
 ?>
 <html>
<head>
  <title>Stock Barang</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
 
</head>

<body>
<div class="container">
			<h4>Invoice</h4>
				<div class="data-tables datatable-dark">
                <table class="table table-bordered" id="mauexport" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Invoice_id</th>
                                            <th>Buyer</th>
                                            <th>Item Name</th>
                                            <th>Price per item</th>
                                            <th>Amount</th>
                                            <th>Total</th>
                                            <th>Buy Date</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                         $getAllData = mysqli_query($conn, 'SELECT * FROM `invoices` ');
                                         $i =1;
                                         while ($data = mysqli_fetch_array($getAllData)) {

                                             $id = $data['id_invoice'];
                                             $itemName = $data['item_name'];
                                             $buyer = $data['buyer'];
                                             $price = $data['price'];
                                             $amount = $data['amount'];
                                             $total = $data['total'];
                                             $buyDate = $data['buy_date'];
                                            

                                        ?>
                                        <tr>
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo "<span>00</span>".$id;?></td>
                                            <td><?php echo $buyer;?></td>
                                            <td><?php echo $itemName;?></td>
                                            <td><?php echo "<span>Rp. </span>".$price;?></td>
                                            <td><?php echo $amount;?></td>
                                            <td><?php echo "<span>Rp. </span>".$total;?></td>
                                            <td><?php echo $buyDate;?></td>
                                        
                                        </tr>
                                         
                                        
                                        <?php
                                        

                                        }
                                        ?>
                                    </tbody>
                                </table>
					
					
				</div>
				<form method="post" action="payment.php">
					<input type="hidden" name="id-item" value="<?=$itemID;?>">
					<input type="hidden" name="amount" value="<?=$amount;?>">
					<input type="hidden" name="total" value="<?=$total;?>">
					<input type="hidden" name="buyer" value="<?=$_SESSION['mail'];?>">
					<input type="submit" name="generateQR" class="btn btn-primary" value="Generate QR Code">
				</form>
				
				<a href="control.php" type="submit" class="btn btn-primary">Buy another</a>
</div>
	
<script>
$(document).ready(function() {
    $('#mauexport').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy','pdf', 'print'
        ]
    } );
} );

</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

	

</body>

</html>
<?php
mysqli_close($conn);
?>