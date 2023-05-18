<?php  require_once("includes/initialize.php"); ?>
<?php  
  require_login();
?>
<?php  
  $role = array('2' => "Admin", '3' => "Writer");
?>
<?php  
    if(isset($_POST['btnDelete'])){
      $id = $_POST['id'];
      if(delete_news($id)){
        $_SESSION['message'] = 'News Deleted.';
        $_SESSION['alert'] = 'warning';
      }
    }
?>
<?php $page_title = 'All News List'; ?>
<?php require_once("header.php"); ?>

                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">News</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">News List</li>
                        </ol>
                         <?php echo display_errors($errors); ?>
                         <?php echo display_session_message(); ?>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-newspaper me-1"></i>
                                        News Detail 
                                        <a href="news-add.php" class="btn btn-sm btn-primary float-end"><i class="fas fa-newspaper"></i> Add New News</a>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                          <div class="col-xl-12">
                                            <table id="datatablesSimple">
                                                <thead>
                                                    <tr>
                                                        <th>SN</th>
                                                        <th>Title</th>
                                                        <th>Description</th>
                                                        <th>Created On</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>

                                                    </tr>
                                                </thead>
                                                <?php   $news_set = find_all_news();  $sn = 1;?>
                                                <tbody>
                                                  <?php while($news = mysqli_fetch_assoc($news_set)) { ?>
                                                    <tr>
                                                      <td><?php echo $sn++; ?></td>
                                                      <td><?php echo h($news['title']) ?></td>
                                                      <td><?php echo h($news['description']) ?></td>
                                                      <td><?php echo datetime_to_text($news['createdon']); ?></td>
                                                      <td>
                                                        <form action="news-add.php" method="post">
                                                          <input type="hidden" name="id" value="<?php echo $news['id'] ?>">
                                                          <button type="submit" name="btnUpdate" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></button>
                                                        </form>
                                                      </td>
                                                      <td>
                                                        <form action="" method="post">
                                                          <input type="hidden" name="id" value="<?php echo $news['id'] ?>">
                                                          <button type="submit" name="btnDelete" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this?');"><i class="fas fa-trash"></i></button>
                                                        </form>
                                                      </td>
                                                      
                                                    </tr>
                                                  <?php } ?>
                                                </tbody>
                                            </table>
                                            <?php mysqli_free_result($news_set); ?>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                        </div>
                        
                    </div>
                </main>
               <?php require_once("footer.php"); ?>