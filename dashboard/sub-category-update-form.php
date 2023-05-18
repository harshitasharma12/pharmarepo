<?php require_once("includes/initialize.php");
require_login();
$page = "sub-category-update-exec.php";
$page_title = 'Add Sub Category';
require_once("header.php");
if(is_get_request()) {
$id = [];
$id=$_GET['id'];
$row=sub_category_by_id($id);
$name=$row['name'];
$category_id=$row['category_id'];
}
?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?php echo $page_title; ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Add new sub category</li>
        </ol>
        <?php echo display_errors($errors); ?>
        <?php echo display_session_message(); ?>
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa fa-check-circle me-1"></i>
                        Add New Sub Category
                    </div>
                    <div class="card-body">
                        <form id="form_profile" action="<?php echo $page; ?>" method="post" enctype="multipart/form-data">


                            <input type="hidden" name="MAX_FILE_SIZE" value="188743680" />

                            <div class="row">

                                <div class="col-xl-4 offset-xl-2">
                                    <input type="text" name="id" value="<?php echo $id; ?>" hidden>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
                                    </div>

                                  
                                        <div class="mb-3">
                                            <label for="floatingSelect">Category Name</label>
                                            <select name="category" class="form-select" id="floatingSelect">
                                                <?php
                                                $sql = "SELECT DISTINCT(name),id from category";
                                                $result_set = mysqli_query($db, $sql);
                                                while ($result = mysqli_fetch_array($result_set)) { ?>
                                                    <option value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
                                                <?php } ?>
                                            </select>
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