<?php
session_start(); 
/* using Google qr code API */
	$id = $_POST['id-item'];
	$amount = $_POST['amount'];
	$buyer= $_POST['buyer'];
	$total = $_POST['total'];
	//generate QR Code
	if ($id == 1) {
		$urlPayment = 'http://localhost/vendMach_OTP/Control/relay1.php?id='.$id.'&amount='.$amount.'&total='.$total.'&buyer='.$buyer.'&stat=ON';
	}else if ($id == 2) {
		$urlPayment = 'http://localhost/vendMach_OTP/Control/relay2.php?id='.$id.'&amount='.$amount.'&total='.$total.'&buyer='.$buyer.'&stat=ON';
	}	
//generate qr code
 	 
 ?>
<!DOCTYPE html>
<html>
<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script type="text/javascript" src="../QRscanner/instascan.min.js"></script>
	<script type="text/javascript" src="../QRscanner/jquery.min.js"></script>
	<title>Payment - QR Code</title>
		

</head>
<body>
	<div class="container mt-5">
		
	  <div class="row">
	    
	      <?php if(isset($_POST['generateQR'])) {?>
	      	<div class="col">
		  		<div class="card-header bg-transparent"><h5 class="text-center">Scan QR Code to Pay</h5></div>
					<div class="card-body">   <?php
					      include "../phpqrcode/qrlib.php"; 
					      /*create folder*/
					     $tempdir="img-qrcode/";
					      if (!file_exists($tempdir))
					      mkdir($tempdir, 0755);
					     $file_name=date("Ymd").rand().".png";   
					     $file_path = $tempdir.$file_name;
					     QRcode::png($urlPayment, $file_path, "H", 6, 4);
					      /* param (1)qrcontent,(2)filename,(3)errorcorrectionlevel,(4)pixelwidth,(5)margin */
					      echo "<p class='result'>Result :</p>";
					      echo "<p><img src='".$file_path."' /></p>";
					   
					     ?>
					</div>
			
		    </div>
		   

	    <?php 	} else{?>
				<h2>404 Not Found</h2>
			
	   <?php 	 }?>
	    <div class="col">
		    	<div class="card-header bg-transparent"><h5 class="text-center">Scan QR here instead</h5></div>
		    	<div class="card-body">
		    		<video id="preview" width="400" height="400"></video>	
		    	</div>
		    </div>
	  </div>
				
	</div>
</body>
<script type="text/javascript">
		let scanner = new Instascan.Scanner({video: document.getElementById('preview')});
		scanner.addListener('scan' , function (content) {
			alert("Your payment is fullfilled");
			window.location.href = content;
		});
		Instascan.Camera.getCameras().then(function(cameras){
			if (cameras.length > 0) {
				scanner.start(cameras[0]);
			}else{
				console.error('No Camera found');
			}
		}).catch(function (e){
			console.error(e);
		});
	</script>
</html>