<?php require_once("includes/initialize.php"); ?>
<?php require_login(); ?>
<?php $page = "labtest-add-exec.php"; ?>
<?php $page_title = 'Lab Test';  ?>
<?php require_once("header.php"); ?>
<?php
$name = "";
$also_known = "";
$report = "";
$price = "";
$about = "";
$test_include="";
$test_name="";
$gender = "";
$age_group = "";
$sample = "";
$action = "Add";
$id = 0;
if (isset($_POST['updatesubmit'])) {
    $id = $_POST['id'];
    $labtest = labtest_select_by_id($id);
    if (is_array($labtest)) {
        $name = $labtest['name'];
        $also_known = $labtest['also_known'];
        $report = $labtest['report'];
        $price = $labtest['price'];
        $about = $labtest['about'];
        $test_include=$labtest['test_include'];
        $test_name=$labtest['test_name'];
        $gender = $labtest['gender'];
        $age_group = $labtest['age_group'];
        $sample = $labtest['sample'];
        $id = $labtest['id'];
        $action = "Update";
    }
}
?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?php echo $action . "Lab test"; ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><?php echo $action; ?> New Lab Test</li>
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
                                        <label for="name" class="form-label">Lab Test Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required value="<?php echo $name; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Also Known as</label>
                                        <input type="text" class="form-control" id="also_known" name="also_known"  value="<?php echo $also_known; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">report</label>
                                        <input type="text" class="form-control" id="report" name="report" required value="<?php echo $report; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">price</label>
                                        <input type="text" class="form-control" id="price" name="price" required value="<?php echo $price; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Number of Test Included</label>
                                        <input type="text" class="form-control" id="test_include" name="test_include" required value="<?php echo $test_include; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Test Name</label>
                                        <textarea name="test_name" id="labtest_test_name" cols="30" rows="10" class="form-control"><?php echo trim($test_name); ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">About</label>
                                        <textarea name="about" id="" cols="30" rows="10" class="form-control"><?php echo trim($about); ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">gender</label>
                                        <input type="text" class="form-control" id="gender" name="gender" required value="<?php echo $gender; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">age_group</label>
                                        <input type="text" class="form-control" id="age_group" name="age_group" required value="<?php echo $age_group; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">sample</label>
                                        <input type="text" class="form-control" id="sample" name="sample" required value="<?php echo $sample; ?>">
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