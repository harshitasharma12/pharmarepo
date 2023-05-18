<?php require_once("includes/initialize.php"); ?>

<?php $page = "timeslot-add-exec.php"; ?>
<?php $page_title = 'Timeslot';  ?>
<?php require_once("header.php"); ?>
<?php
$from = "";
$to = "";
$doctor_id = $_SESSION['admin_id'];
$action = "Add";
$id = 0;
if (isset($_POST['updatesubmit'])) {
    $id = $_POST['id'];
    $timeslot = timeslot_select_by_id($id);
    if (is_array($timslot)) {
      
        $from = $timselot['from'];
        $to = $timselot['to'];
        $id = $brand['id'];
        $action = "Update";
    }
}
?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?php echo $action . "Product"; ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><?php echo $action; ?> New Brand</li>
        </ol>
        <?php echo display_errors($errors); ?>
        <?php echo display_session_message(); ?>
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fab fa-bimobject me-1"></i>
                        <?php echo $action; ?>
                    </div>
                    <div class="card-body">
                        <form id="form_profile" action="<?php echo $page; ?>" method="post" enctype="multipart/form-data">

                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="action" value="<?php echo $action; ?>" />

                            <div class="row">

                                <div class="col-xl-6 offset-xl-2">

                                    <div class="mb-3">
                                        <label for="name" class="form-label">From</label>
                                        <input type="time" class="form-control" id="from" name="from" required value="<?php echo $from; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">to</label>
                                        <input type="time" class="form-control" id="to" name="to" required value="<?php echo $to; ?>">
                                    </div>

                                   <input type="hidden" name="doctor_id" id="doctor_id" value="<?php echo $doctor_id ;?>">

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