<?php include_once("dashboard/includes/initialize.php") ?>
<?php  
  if(is_get_request()){
    if(isset($_GET['key']) && isset($_GET['uid']) && isset($_GET['action']) && ($_GET["action"]=="verify") && !isset($_POST["action"])){
      $key = db_escape($db, $_GET["key"]);
      $username =decryption($_GET["uid"]);
      $key =$_GET["key"];
      $curDate = date("Y-m-d H:i:s");
      $query = mysqli_query($db, "SELECT * FROM `customer` WHERE `verify_key`='".$key."' and `email`='".$username."' LIMIT 1;" );
      $row = mysqli_num_rows($query);
      if($row==""){
        $_SESSION['message'] = "The link is invalid/expired. Either you did not copy the correct link from the email, or you have already used the key in which case it is deactivated.";
        $_SESSION['alert'] = "danger";
        redirect_to("login.php");
      } else {
        $row = mysqli_fetch_assoc($query);
        $expDate = $row['expDate'];
        if ($expDate >= $curDate){
          $flag = true;
          $query = " UPDATE customer set confirm = '1' WHERE email ='".$username."'";
          $result = mysqli_query($db, $query);
          if($result===true){
            $_SESSION['message'] = "The account is activated.";
            $_SESSION['alert'] = "success";
            redirect_to("login.php");
          }
        } else {
          $flag = false;
          $_SESSION['message'] = "The link is invalid/expired.";
          $_SESSION['alert'] = "danger";
          redirect_to("login.php");
        }

      }
    } else {
        redirect_to("login.php");
    }
  }  
?>

</body>

</html>