<?php require_once("includes/initialize.php"); ?>
<?php require_login(); ?>
<?php $page="upload-add-exec.php"; ?>
<?php $page_title = 'Add File';  ?>
<?php require_once("header.php"); ?>


                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?php echo $page_title; ?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Add new File</li>
                        </ol>
                        <?php echo display_errors($errors); ?>
                        <?php echo display_session_message(); ?>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-upload me-1"></i>
                                        Add New File
                                    </div>
                                    <div class="card-body">
                                        <form id="form_profile" action="<?php echo $page; ?>" method="post" enctype="multipart/form-data">
                                          
                                          
                                          <input type="hidden" name="MAX_FILE_SIZE" value="188743680" />
                                           <input type="hidden" name="type_id" value="<?php echo $_SESSION['admin_id'] ?>" />
                                          <div class="row">
                                           
                                            <div class="col-xl-6 offset-xl-2">
                                               <div class="mb-3">
                                                 <label for="name" class="form-label">Title</label>
                                                 <input type="text" class="form-control" id="name" name="title" required >
                                               </div>
                                               <div class="mb-3">
                                                 <label for="name" class="form-label">Choose File</label>
                                                 <input type="file" name="file" class="form-control">
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