<?php require_once("includes/initialize.php"); ?>
<?php require_login(); ?>
<?php $page = "report-add-exec.php"; ?>
<?php $page_title = 'Lab Report';  ?>
<?php require_once("header.php"); ?>
<?php

if (isset($_POST['updatesubmit'])) {
    $id = $_POST['id'];
    $report = report_select_by_id($id);
    if (is_array($report)) {
        $filename = $report['filename'];
        $id = $report['id'];
        
} 
}  
?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?php echo " Update Report"; ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><?php echo 'Update'; ?> New report</li>
        </ol>
        <?php echo display_errors($errors); ?>
        <?php echo display_session_message(); ?>
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fab fa-bimobject me-1"></i>
                        <?php echo 'Update'; ?>
                    </div>
                    <div class="card-body">
                        <form id="form_profile" action="<?php echo $page; ?>" method="post" enctype="multipart/form-data">

                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <div class="row">


                                <div class="col-xl-6 offset-xl-2">


                                    <div class="mb-3">
                                        <label for="name" class="form-label">Choose File</label>
                                        <input type="file" name="file" class="form-control">
                                    </div>

                                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                    <button type="reset" class="btn btn-danger" name="reset">Reset</button>
                                </div>

                                <div class="col-md-3">
                                    <img src="uploads/reports/<?php echo $filename; ?>" class="img-fluid border">
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