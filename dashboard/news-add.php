<?php require_once("includes/initialize.php"); ?>
<?php require_login(); ?>
<?php $page="news-add-exec.php"; ?>
<?php $page_title = 'News';  ?>
<?php require_once("header.php"); ?>
<?php 
    
    $title = "";
    $description = "";
    $action="Add";
    $id= 0;
    if (isset($_POST['btnUpdate'])){
      $id = $_POST['id'];
      $news = find_news_by_id($id);
      if(is_array($news)){
        $title = $news['title'];
        $description = $news['description'];
        $action = "Update";
      }
    } 
 ?>


                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?php echo $action. " News"; ?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"><?php echo $action; ?> new news</li>
                        </ol>
                        <?php echo display_errors($errors); ?>
                        <?php echo display_session_message(); ?>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-newspaper me-1"></i>
                                        <?php echo $action; ?> New News
                                    </div>
                                    <div class="card-body">
                                        <form id="form_profile" action="<?php echo $page; ?>" method="post" enctype="multipart/form-data">
                                         
                                          <input type="hidden" name="id" value="<?php echo $id; ?>">
                                          <input type="hidden" name="action" value="<?php echo $action; ?>" />
                                          
                                          <div class="row">
                                             
                                            <div class="col-xl-6 offset-xl-2">
                                              <div class="mb-3">
                                                <label for="name" class="form-label">Title</label>
                                                <input type="text" class="form-control" id="name" name="title" required value="<?php echo $title; ?>">
                                              </div>
                                              <div class="mb-3">
                                                <label for="name" class="form-label">Description</label>
                                                <textarea name="description" id="" cols="30" rows="10" class="form-control" required><?php echo trim($description); ?></textarea>
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