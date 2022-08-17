<?php session_start(); ?>
<?php
    include('connection/connection.php');
    require ('Mail/phpmailer/PHPMailerAutoload.php');
    
    if(isset($_POST["register"])){
        $email = $_POST["email"];
        

        $check_query = mysqli_query($conn, "SELECT * FROM login where email ='$email'");
        $rowCount = mysqli_num_rows($check_query);

        if(!empty($email)){
            if($rowCount > 0){
                mysqli_query($conn, "UPDATE login SET status = 0 WHERE email = '$email'");
                    $otp = rand(100000,999999);
                   
                    $mail = new PHPMailer;
    
                    $mail->isSMTP();
                    $mail->Host='smtp.gmail.com';
                    $mail->Port=587;
                    $mail->SMTPAuth=true;
                    $mail->SMTPSecure='tls';
    
                    $mail->Username='crossfode22@gmail.com';
                    $mail->Password='qwerty12345??!!';
    
                    $mail->setFrom('crossfode22@gmail.com', 'OTP Verification');
                    $mail->addAddress($_POST["email"]);
    
                    $mail->isHTML(true);
                    $mail->Subject="Vending Machine OTP CODE";
                    $mail->Body="<p>Dear Customer, </p> <h3>Your verify OTP code is $otp <br></h3>
                    <br><br>
                    <p>With regrads,</p>
                    <b>Aya kicik Vending Machine</b>
                    https://www.instagram.com/";
                            if(!$mail->send()){
                                ?>
                                    <script>
                                     alert("<?php echo "Register Failed, Error occured "?>");
                                    </script>
                                <?php
                            }else{
                                 $_SESSION['otp'] = $otp;
                                 $_SESSION['mail'] = $email;
                                ?>
                                <script>
                                    alert("<?php echo "OTP sent to " . $email ?>");
                                    
                                    window.location.replace('OTPsender/verification.php');
                                </script>
                                <?php
                            }
                
            }else{
                $status = 0;
                $result = mysqli_query($conn, "INSERT INTO  login (email, status) VALUES ('$email','$status')");
    
                if($result){
                    $otp = rand(100000,999999);
                    
                    $mail = new PHPMailer;
    
                    $mail->isSMTP();
                    $mail->Host='smtp.gmail.com';
                    $mail->Port=587;
                    $mail->SMTPAuth=true;
                    $mail->SMTPSecure='tls';
    
                    $mail->Username='crossfode22@gmail.com';
                    $mail->Password='qwerty12345??!!';
    
                    $mail->setFrom('crossfode22@gmail.com', 'OTP Verification');
                    $mail->addAddress($_POST["email"]);
    
                    $mail->isHTML(true);
                    $mail->Subject="Vending Machine OTP CODE";
                    $mail->Body="<p>Dear Customer, </p> <h3>Your verify OTP code is $otp <br></h3>
                    <br><br>
                    <p>With regards,</p>
                    <b>Aya kicik Vending Machine</b>
                    https://www.instagram.com/";
    
                            if(!$mail->send()){
                                ?>
                                    <script>
                                        alert("<?php echo "Register Failed, Invalid Email "?>");
                                    </script>
                                <?php
                            }else{
                                 $_SESSION['otp'] = $otp;
                                 $_SESSION['mail'] = $email;
                                ?>
                                <script>
                                    alert("<?php echo "Register Successfully, OTP sent to " . $email ?>");
                                   
                                    window.location.replace('OTPsender/verification.php');
                                </script>
                                <?php
                            }
                }
            }
        }
    }

?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
<!------ Include the above in your HEAD tag ---------->

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="OTPsender/style.css">

    <link rel="icon" href="Favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title>Vending Machine Gateway</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="#">VENDING MACHINE</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link " href="index.php" style="font-weight:bold; color:black; text-decoration:underline">SEND OTP TO CONFIRM BUYER</a>
                </li>
            </ul>

        </div>
    </div>
</nav>

<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Send OTP code to your gmail</div>
                    <div class="card-body">
                        <form action="#" method="POST" name="register">
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <input type="submit" value="Submit" name="register">
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

</main>
</body>
</html>
<script>
    const toggle = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    toggle.addEventListener('click', function(){
        if(password.type === "password"){
            password.type = 'text';
        }else{
            password.type = 'password';
        }
        this.classList.toggle('bi-eye');
    });
</script>
