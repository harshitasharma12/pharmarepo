<?php require_once("includes/initialize.php");
require_login();
$page = "country-update-exec.php";
$page_title = 'Add Country';
require_once("header.php");
if(is_get_request()) {
$id = [];
$id=$_GET['id'];
$row=country_select_id($id);
$name=$row['name'];
}
?>
  <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?php echo $page_title; ?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Add new country</li>
                        </ol>
                        <?php echo display_errors($errors); ?>
                        <?php echo display_session_message(); ?>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fa fa-check-circle me-1"></i>
                                        Add New Country
                                    </div>
                                    <div class="card-body">
                                        <form id="form_profile" action="<?php echo $page; ?>" method="post" enctype="multipart/form-data">
                                          
                                          
                                          <input type="hidden" name="MAX_FILE_SIZE" value="188743680" />
                                          
                                          <div class="row">
                                             
                                            <div class="col-xl-6 offset-xl-2">
                                                <input type="text" name="id" value="<?php echo $id;?>" hidden>
                                              <div class="mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="name" value="<?php echo $name;?>" name="name">
                                              </div>
                                              
                                              <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                              <button type="reset" class="btn btn-danger" name="reset">Reset</button>
                                            </div>

                                          </div>
                                          
                                        </form>

                                    </div>
                                </div>
                            </div>
                             
                        </div>
                        
                    </div>
                </main>
               <?php require_once("footer.php"); ?>