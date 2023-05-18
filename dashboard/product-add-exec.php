<?php  require_once("includes/initialize.php");
  require_login();
  if(is_post_request()) {
    
    $product = [];
    $product['name'] = $_POST['name'] ?? '';
    $product['medicine_type'] = $_POST['medicine_type'] ?? '';
    $product['price'] = $_POST['price'] ?? '';
    $product['expire_date'] = $_POST['expire_date'] ?? '';
    $product['description'] = $_POST['description'] ?? '';
    $product['uses_of'] = $_POST['uses_of'] ?? '';
    $product['key_benefits'] = $_POST['key_benefits'] ?? '';
    $product['directions'] = $_POST['directions'] ?? '';
    $product['safety_information'] = $_POST['safety_information'] ?? '';
    $product['key_ingredient'] = $_POST['key_ingredient'] ?? '';
    $product['prescription'] = $_POST['prescription'] ?? '';
    $product['category_id'] = $_POST['category_id'] ?? '';
    $product['sub_category_id'] = $_POST['sub_category_id'] ?? '';
    $product['sub_sub_category_id'] = $_POST['sub_sub_category_id'] ?? '';
    $product['brand_id'] = $_POST['brand_id'] ?? '';
    $product['discount'] = $_POST['discount'] ?? '';
    $product['ban'] = $_POST['ban'] ?? '';
    $product['warranty'] = $_POST['warranty'] ?? '';
    // $product['return_item'] = $_POST['return_item'] ?? '';
    $product['id'] = $_POST['id'] ?? '';
    $product['action'] = $_POST['action'];

    // print_r($product);
    $upload_dir = "files";
    $id = get_max_id("product");
    // print_r($product); exit;
     if(!empty($_FILES['file']['name']))
    { 
       if(check_extension($_FILES['file']['name']))
       {
        
          if($_FILES["file"]["size"] < 67108864)
          {
           
           
              if($filename = upload_file($_FILES['file']['tmp_name'], $_FILES['file']['name'], $upload_dir, "0", "0", $id))
              {
                 
                  $product['filename']= $filename;
                  if($product['id']>=0 && $product['action']==="update")
                  { 
                       
                        $result = product_update($product);
                  } 
                  else 
                  {
                         $result = product_add($product);
                  }
                  if($result)
                  {
                      $_SESSION['message'] = 'Product '.$product['action'].' successfully';
                      $_SESSION['alert'] = 'success';
                      redirect_to("product-list.php");
                  }
                  else 
                  {
                    $product = [];
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
    else {
      //update
      $result = product_update($product);
      if($result){
        $error = "Upload Added successfully";
        $alert="success";  

      }
      $upload = [];
    } 
    $_SESSION['message'] = $error;
    $_SESSION['alert'] = $alert;
  }
  else
  {
    $_SESSION['message'] = 'Product Already Exist';
    $_SESSION['alert'] = 'danger';
    redirect_to("product-add.php");
  }
?>