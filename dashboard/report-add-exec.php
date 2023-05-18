<?php require_once("includes/initialize.php");
require_login();
if (is_post_request()) {
  $report = [];
  $report['id'] = $_POST['id'] ?? '';
 
  $upload_dir = "reports";
  $id = get_max_id("lab_report");
  // print_r($product); exit;
  if (!empty($_FILES['file']['name'])) {
    if (check_extension_for_pdf($_FILES['file']['name'])) {

      if ($_FILES["file"]["size"] < 67108864) {


        if ($filename = upload_file($_FILES['file']['tmp_name'], $_FILES['file']['name'], $upload_dir, "0", "0", $id)) {

          $report['filename'] = $filename;

          $result = report_update($report);

          if ($result) {
            $_SESSION['message'] = 'Report Updated successfully';
            $_SESSION['alert'] = 'success';
            redirect_to("report-list.php");
          } else {
            $product = [];
          }
        } else {
          $error = "File not uploaded";
          $alert = "warning";
        }
      } else {
        $error = "Size exceeds";
        $alert = "warning";
      }
    } else {
      $error = "Invalid file";
      $alert = "danger";
    }
  } else {
    //update
    $result = report_update($report);
    if ($result) {
      $error = "Upload Added successfully";
      $alert = "success";
    }
    $upload = [];
  }
  $_SESSION['message'] = $error;
  $_SESSION['alert'] = $alert;
}
