<?php include_once("dashboard/includes/initialize.php") ?>
<?php  
  if(is_post_request()){
    $username = db_escape($db, $_POST['username']);
    $user = find_customer($username);
     
    if(is_array($user)){
      $email = $user['email'];
      $name = $user['first_name']." ".$user['last_name'];
      $expFormat = mktime(date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y"));
        $expDate = date("Y-m-d H:i:s",$expFormat);
        $key = encryption($email);
        //$addKey = substr(md5(uniqid(rand(),1)),3,10);
        //$key = $key . $addKey;

        mysqli_query($db,"INSERT INTO `password_reset_temp` (`username`, `key`, `expDate`)VALUES ('".$username."', '".$key."', '".$expDate."');");
        mail_for($username, $email, $key, "Password Reset","reset-password");
        $_SESSION['message'] = "A link is sent to your registered email address. You can reset your password from that link within 24 hrs.";
        $_SESSION['alert'] = "success";
        redirect_to("forgot-password.php");
    } else {
      $_SESSION['message'] = "Invalid Username, please check your username";
      $_SESSION['alert'] = "danger";
      redirect_to("forgot-password.php");
    }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Forgot Password - Customer</title>
    <link href="assets/css/custom.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-12 mx-auto mt-5">
                <div class="card">
                    <div class="card-body" style="box-shadow:5px 6px 10px grey">
                        <div class="row">
                            <div class="col-md-6  col-12 d-flex justify-content-center align-items-center">
                            <?php require_once("owl-carousel-login.php");?>

                            </div>
                            <div class="col-md-6 col-12">
                                <span class="fs-3">Forgot Password</span><br>
                                <!-- <span style="font-size:17px;">Get access to your orders, lab tests & doctor consultations</span> -->
                                <form action="" method="post">
                                    <?php echo display_session_message(); ?>
                                    <div class="form-floating mb-3 mt-3">
                                        <input type="email" class="form-control" id="floatingInput" placeholder="Enter Your Email" name="username">
                                        <label for="floatingInput">Email address</label>

                                    </div>
                                    <!-- <div class="form-floating">
                                        <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                                        <label for="floatingPassword">Password</label>
                                    </div> -->

                                    <div class="d-grid gap-2 mt-4">
                                        <button class="btn btn-success" type="submit">Reset Password</button>
                                    </div>
                                </form>
                                <p class="mt-3 text-center">New on Trust Care?<a href="register.php" class="text-success" style="text-decoration:none;"> Sign Up</a></p>
                                <!-- <p class="mt-3 text-center"><a href="forgot-password.php" class="text-success" style="text-decoration:none;"> Forgot Password !!</a></p> -->
                                <p class="text-center" style="font-size:12px;">By logging in, you agree to our
                                    <a href="TAC.php" style="color:black;">Terms and Conditions</a> & <a href="privacy.php" style="color:black">Privacy Policy</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <script src="js/scripts.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>