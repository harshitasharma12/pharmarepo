<?php  require_once("includes/initialize.php");
//   require_login();
  if(is_post_request()) {
    $doctor = [];
    $doctor['name'] = $_POST['name'] ?? '';
    $doctor['speciality_id'] = $_POST['speciality_id'] ?? '';
    $doctor['field_of_expertise'] = $_POST['field_of_expertise'] ?? '';
    $doctor['working_as'] = $_POST['working_as'] ?? '';
    $doctor['pay_price'] = $_POST['pay_price'] ?? '';
    $doctor['education'] = $_POST['education'] ?? '';
    $doctor['experience'] = $_POST['experience'] ?? '';
    $doctor['currently_working_in'] = $_POST['currently_working_in'] ?? '';
    $doctor['awards'] = $_POST['awards'] ?? '';
    $doctor['email'] = $_POST['email'] ?? '';
    $doctor['password'] = $_POST['password'] ?? '';
    $doctor['id'] = $_POST['id'] ?? '';
    $doctor['action'] = $_POST['action'];
    


    $upload_dir = "doctors";
    $id = get_max_id("doctors");
    // print_r($product); exit;
     if(!empty($_FILES['file']['name']))
    { 
       if(check_extension($_FILES['file']['name']))
       {
        
          if($_FILES["file"]["size"] < 67108864)
          {
           
           
              if($filename = upload_file($_FILES['file']['tmp_name'], $_FILES['file']['name'], $upload_dir, "0", "0", $id))
              {
                 
                  $doctor['filename']= $filename;
                  if($doctor['id']>=0 && $doctor['action']==="update")
                  { 
                       
                        $result = doctor_update($doctor);
                  } 
                  else 
                  {
                         $result = doctor_add($doctor);
                  }
                  if($result)
                  {
                      mail_for($doctor['email'], $doctor['email'], $doctor['password'], "Welcome Message", "welcome");
                      $_SESSION['message'] = 'doctor '.$doctor['action'].' successfully';
                      $_SESSION['alert'] = 'success';
                      redirect_to("doctor-list.php");
                  }
                  else 
                  {
                    $doctor = [];
                   }
              }
              else 
              {
                  $error = "File not uploaded";
                  $alert = "warning";
              }
          } 
          else 
          {
             $error = "Size exceeds";
             $alert = "warning";
          }
       } 
       else 
       {
          $error = "Invalid file";
          $alert = "danger";
       }
    } 
    else 
    {
        $doctor = [];
    } 
    $_SESSION['message'] = $error;
    $_SESSION['alert'] = $alert;
  }
  else 
  {
          $_SESSION['message'] = 'Doctor Already Exist';
          $_SESSION['alert'] = 'danger';
          redirect_to("doctor-add.php");
     
  }
?>