<?php include_once("dashboard/includes/initialize.php") ?>
<?php  
  if(is_get_request()){
    if(isset($_GET['key']) && isset($_GET['uid']) && isset($_GET['action']) && ($_GET["action"]=="reset") && !isset($_POST["action"])){
      $key = db_escape($db, $_GET["key"]);
      $username =decryption($_GET["uid"]);
      $key =$_GET["key"];
      $curDate = date("Y-m-d H:i:s");
      $query = mysqli_query($db, "SELECT * FROM `password_reset_temp` WHERE `key`='".$key."' and `username`='".$username."' LIMIT 1;" );
      $row = mysqli_num_rows($query);
      if($row==""){
        $_SESSION['message'] = "The link is invalid/expired. Either you did not copy the correct link from the email, or you have already used the key in which case it is deactivated.";
        $_SESSION['alert'] = "danger";
        redirect_to("forgot-password.php");
      } else {
        $row = mysqli_fetch_assoc($query);
        $expDate = $row['expDate'];
        if ($expDate >= $curDate){
          $flag = true;
        } else {
          $flag = false;
          $_SESSION['message'] = "The link is invalid/expired.";
          $_SESSION['alert'] = "danger";
          redirect_to("forgot-password.php");
        }

      }
    } else {
        redirect_to("reset-password.php");
    }
  } elseif (is_post_request()) {
    if(isset($_POST["username"]) && isset($_POST["action"]) &&  ($_POST["action"]=="update")){
      $password['password'] = db_escape($db, $_POST['password']);
      $password['confirm_password'] = db_escape($db, $_POST['cpassword']);
      $password['reset_password'] =1;
       $password['role'] ="3";
      $username = db_escape($db, $_POST['username']);

      $result = change_password($username, $password);
      if($result===true){
        $_SESSION['message'] = "Password change successfully";
        $_SESSION['alert'] = "success";
        mysqli_query($db,"DELETE FROM `password_reset_temp` WHERE `username`='".$username."';");
        redirect_to("login.php");
      } else {
        $_SESSION['message']  = display_errors($result);
        $_SESSION['alert'] = "danger";
      }
      redirect_to("reset-password.php");
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
    <title>Reset Password - Customer</title>
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
                                <span class="fs-3">Reset Password</span><br>
                                <!-- <span style="font-size:17px;">Get access to your orders, lab tests & doctor consultations</span> -->
                                     <?php if($flag===true): ?>
                                <form action="" method="post">
                                     <input type="hidden" name="username" value="<?php echo $username; ?>">
        <input type="hidden" name="action" value="update" />
                                    <?php echo display_session_message(); ?>
                                    <div class="form-floating mb-3 mt-3">
                                        <input type="password" class="form-control" id="floatingInput" placeholder="Enter Your Password" name="password">
                                        <label for="floatingInput">Password</label>

                                    </div>
                                    <div class="form-floating">
                                        <input type="password" class="form-control" name="cpassword" id="floatingPassword" placeholder="Confirm Password">
                                        <label for="floatingPassword">Confirm Password</label>
                                    </div>

                                    <div class="d-grid gap-2 mt-4">
                                        <button class="btn btn-success" type="submit">Submit</button>
                                    </div>
                                </form>
                            <?php endif; ?>
                                <p class="mt-3 text-center">New on Trust Care?<a href="register.php" class="text-success" style="text-decoration:none;"> Sign Up</a></p>
                                <p class="mt-3 text-center"><a href="forgot-password.php" class="text-success" style="text-decoration:none;"> Forgot Password !!</a></p>
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