<?php include_once("dashboard/includes/initialize.php") ?>
<?php $errors = array("dd" => "abc"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Register - Customer</title>
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
            <div class="col-md-12 col-12 mx-auto mt-5">
                <div class="card">
                    <div class="card-body" style="box-shadow:5px 6px 10px grey">
                        <div class="row">
                            <div class="col-md-5 d-flex justify-content-center align-items-center">
                                <?php require_once("owl-carousel-login.php"); ?>

                            </div>
                            <div class="col-md-7 col-12">
                                <span class="fs-3">Sign Up</span><br>
                                <span style="font-size:17px;">Fill the below details to join Trust care</span>
                               
                                <?php if(array_key_exists("error",$_SESSION)){
                                     $errors =$_SESSION["error"];
                                     
                                    ?>
                                    
                                 <?php }?>
                                <form action="register-exec.php" method="post">
                                   
                                    <?php echo display_session_message(); ?>
                                    <div class="row">
                                        <div class="col-md-6 col-6">
                                            <div class="form-floating mb-3">
                                              
                                                <input type="text" class="form-control" id="first_name" name="first_name" required placeholder="First Name">
                                                <label for="floatingInput">First Name</label>
                                                <?php if(!empty($errors) && array_key_exists("first_name", $errors)){?>
                                                <span id="error" style="color:red;"><?php echo $errors["first_name"];?></span>
                                               
                                                <?php }?>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="last_name" name="last_name" required placeholder="Last Name">
                                                <label for="floatingInput">Last Name</label>
                                                <?php if(!empty($errors) && array_key_exists("last_name", $errors)){?>
                                                <span id="error" style="color:red;"><?php echo $errors["last_name"];?></span>
                                                <?php }?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7 col-7">
                                            <div class="form-floating mb-3">
                                                <input type="email" class="form-control" id="email" name="email" required placeholder="Email Address ">
                                                <label for="floatingInput">Email address</label>
                                                <?php if(!empty($errors) && array_key_exists("email", $errors)){?>
                                                <span id="error" style="color:red;"><?php echo $errors["email"];?></span>
                                                <?php }?>
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-5">
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" id="password" name="password" required placeholder="password">
                                                <label for="floatingInput">Password</label>
                                                <?php if(!empty($errors) && array_key_exists("password", $errors)){?>
                                                <span id="error" style="color:red;"><?php echo $errors["password"];?></span>
                                                <?php }?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 col-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="contact" minlength="10" maxlength="10" name="contact"  required placeholder="Contact Number" >
                                                
                                                <label for="floatingInput">Contact Number</label>
                                                <?php if(!empty($errors) && array_key_exists("contact", $errors)){?>
                                                <span id="error" style="color:red;"><?php echo $errors["contact"];?></span>
                                                <?php }?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-6">
                                            <div class="form-floating">
                                                <select name="country_id" class="form-select" id="country_id">
                                                    <option value="0">Country</option>
                                                    <?php
                                                    $result_set = country_select();
                                                    while ($result = mysqli_fetch_array($result_set)) { ?>
                                                        <option value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="d-grid gap-2 mt-4">
                                        <button class="btn btn-success" type="submit">Register</button>
                                    </div>
                                   
                                </form>
                               
                                <p class="mt-3 text-center">Have an account?<a href="login.php" class="text-success" style="text-decoration:none;"> Login</a></p>
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
<?php $_SESSION["error"] = ""; ?>
</html>