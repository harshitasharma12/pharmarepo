<?php

function url_for($script_path) {
  // add the leading '/' if not present
  if($script_path[0] != '/') {
    $script_path = "/" . $script_path;
  }
  return WWW_ROOT . $script_path;
}

function u($string="") {
  return urlencode($string);
}

function raw_u($string="") {
  return rawurlencode($string);
}

function h($string="") {
  return htmlspecialchars($string);
}

function error_404() {
  header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
  exit();
}

function error_500() {
  header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
  exit();
}

function redirect_to($location) {
  header("Location: " . $location);
  exit;
}

function is_post_request() {
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function is_get_request() {
  return $_SERVER['REQUEST_METHOD'] == 'GET';
}

function display_errors($errors=array()) {
  $output = '';
  if(!empty($errors)) {
    $output .= "<div class=\"errors\">";
    //$output .= "Please fix the following errors:";
    $output .= "<ul>";
    foreach($errors as $error) {
      $output .= "<li>" . h($error) . "</li>";
    }
    $output .= "</ul>";
    $output .= "</div>";
  }
  return $output;
}

function get_and_clear_session_message() {
  $msg=false;
  if(isset($_SESSION['message']) && $_SESSION['message'] != '') {
    $msg = $_SESSION['message'];
    unset($_SESSION['message']);
  }
  if(isset($_SESSION['alert']) && $_SESSION['alert'] != '' && !empty($msg)) {
    $alert = $_SESSION['alert'];
    $msg ='<div class="alert alert-'.$alert.' alert-dismissible fade show" role="alert">'.$msg .'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    unset($_SESSION['alert']);
  }
   return $msg;
}

function display_session_message($version="5") {
  $msg = get_and_clear_session_message($version);
  if(!is_blank($msg)) {
    return '<div id="message">' . ($msg) . '</div>';
  }
}

function datetime_to_text($datetime=""){
  $unixdatetime= strtotime($datetime);
  if($unixdatetime>0)
    return date("d-m-Y ",$unixdatetime); 
  else 
    return "NA";
}

function clean_string($string="", $reverse=true){
    if($string!=""){
      if($reverse){
        $string = str_replace("-", " ", $string);
        $string = ucwords($string);
      } else {
        $string = str_replace(" ", "-", $string);
        $string = strtolower($string);
      }
      return $string;
    }
  }

function get_title(){
  global $page_title;
  if(!isset($page_title)){
    return "TRUST CARE";
  } else {
    return "TRUST CARE :: ".$page_title;
  }
}

function get_max_id($table_name){
    global $db;
    $query = "select max(id) as 'id' from ".$table_name;
    $result = mysqli_query($db,$query);
    confirm_result_set($result); 
    if(mysqli_num_rows($result)>0){
      $row = mysqli_fetch_assoc($result);
      if(is_null($row['id']))
        return 1;
      else 
        $unique_id =   $row['id'];
        $unique_id = intval($unique_id)+1;
        return $unique_id;
    }
  }

function upload_file($tmp_name, $file_name, $upload_dir,$width,$height, $unique_id, $genrate_filename=false){
        $upload_dir = check_upload_dir($upload_dir);

        $target_file = get_target_file($file_name, $unique_id, $genrate_filename);
        if(!empty($target_file) || !$target_file){
          $upload_dir = "uploads/".$upload_dir;
          
          if(move_uploaded_file($tmp_name,$upload_dir."/".$target_file)){
          return $target_file;
        } else {
          return false;
        }
        }
    }

  function check_extension($file_name){
     
    $file_parts = pathinfo($file_name);
      $file_extensions = Array("jpg","png","jpeg","gif");
      if (in_array($file_parts['extension'], $file_extensions)){
          return true;
      } else {
          return false;
      }
  }

  function check_extension_for_pdf($file_name){
     
    $file_parts = pathinfo($file_name);
      $file_extensions = Array("pdf");
      if (in_array($file_parts['extension'], $file_extensions)){
          return true;
      } else {
          return false;
      }
  }

function check_upload_dir($upload_dir){
      if(file_exists("uploads/".$upload_dir)){
      return $upload_dir;
      }
    else {
      mkdir("uploads/".$upload_dir, 0777, true);
      if(file_exists("uploads/".$upload_dir)){
        return $upload_dir;
        }
    }
  } 

    function get_target_file($file_name, $unique_id, $genrate_filename=false){
    $target_file="";
    $info = new SplFileInfo($file_name);
    $extension = $info->getExtension();
    $filename = $info->getBasename('.'.$info->getExtension());
    $filename = clean_string($filename, false);
    if($genrate_filename){
      $target_file = $genrate_filename."_".$unique_id."_".$filename.".".$extension;
    } else {
      $target_file = $unique_id."-".$filename.".".$extension;
    }
    
    if(!empty($target_file)){
      return $target_file;
    } else {
      return false;
    }
  }

  function delete_file($dir_type, $file_name){
    $path = "uploads/".$dir_type."/";
    $file_name=strtolower($file_name);
    if($file_name!="na.png" && $file_name!="na" && $file_name!=""){
      $path .= $file_name;
      if(file_exists($path)){
        if(unlink(realpath($path))){
          return true;
        } else {
          return false;
        }
      } else {
        return true;
      }
    } else {
      return true;
    }
  }


  function Size($bytes=0, $path=false)
  {
    if($path){
      $bytes = sprintf('%u', filesize($path));  
    }
      
      if ($bytes > 0)
      {
          $unit = intval(log($bytes, 1024));
          $units = array('B', 'KB', 'MB', 'GB');
          if (array_key_exists($unit, $units) === true)
          {
              return sprintf('%d %s', $bytes / pow(1024, $unit), $units[$unit]);
          }
      }

      return $bytes;
  }

  function encryption($data) {
    return base64_encode(base64_encode(base64_encode(strrev($data))));
  }

  // Function for decryption
  function decryption($data) {
    return strrev(base64_decode(base64_decode(base64_decode($data))));
  }

  ///////////////////////////// mail functions ///////////////////////////
   function sent_mail($message=false, $subject="", $recipient="", $recipient_name=""){
    $to = $recipient;


    $headers = "From: harshita.sharma3345@gmail.com\r\n";
    //$headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";
    //$headers .= "CC: susan@example.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    if (mail($to, $subject, $message, $headers)) {
        return "Your message has been sent.";
      } else {
        return "There was a problem sending the email.";
      }
  }

  function mail_for($user_id, $recipient, $password, $subject, $template) {
    $mail_template = "mail/".$template."-template.php";
    ob_start();
    include($mail_template);
    $output = ob_get_contents();
    ob_end_clean();
    //echo $output; exit;
    // $recipient="sunny.singla.sam@gmail.com"
    sent_mail($output, $subject, $recipient, $password);
    return true;
  }
?>
