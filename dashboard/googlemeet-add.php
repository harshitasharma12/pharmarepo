<?php require_once("includes/initialize.php"); ?>
<?php require_login(); ?>
<?php $page = "googlemeet-add-exec.php"; ?>
<?php $page_title = 'Google meet ';  ?>
<?php require_once("header.php"); 
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $row=appoinment_by_id($id);
    $googlemeet=$row['google_id'];
}
?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?php echo "Update Google Meet"; ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><?php echo "Update "; ?> new Google Meet</li>
        </ol>
        <?php echo display_errors($errors); ?>
        <?php echo display_session_message(); ?>
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fab fa-product-hunt me-1"></i>
                        <?php echo  "Update "; ?>
                    </div>
                    <div class="card-body">
                        <form id="form_profile" action="googlemeet-add-exec.php" method="post" enctype="multipart/form-data">

                            <div class="row">

                                <div class="col-xl-6 offset-xl-2">

                                    <input type="hidden" name="id" value="<?php echo $id;?>">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Google meet link</label>
                                        <input type="text" class="form-control" id="googlemeet" name="googlemeet" required value="<?php echo $googlemeet; ?>">
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
