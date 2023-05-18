<?php require_once("includes/initialize.php"); ?>
<?php require_login(); ?>
<?php $page = "sub-sub-category-add-exec.php"; ?>
<?php $page_title = 'Sub Sub Category';  ?>
<?php require_once("header.php"); ?>
<?php
$name = "";
$sub_category_id = "";
$action = "Add";
$id = 0;
if (isset($_POST['updatesubmit'])) {
    $id = $_POST['id'];
    $sub_sub_category = sub_sub_category_by_id($id);
    if (is_array($sub_sub_category)) {
        $name = $sub_sub_category['name'];
        $sub_category_id = $sub_sub_category['sub_category_id'];
        $id = $sub_sub_category['id'];
        $action = "Update";
    }
}
?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?php echo $action . "Sub_Sub_Category"; ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><?php echo $action; ?> New Sub Sub Category</li>
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
                                        <label for="name" class="form-label">Name:</label>
                                        <input type="text" class="form-control" id="name" name="name" required value="<?php echo $name; ?>">
                                    </div>

                                    <div class="mb-3">
                                    <label for="floatingSelect">Subcategory Name</label>
                                        <select name="sub_category_id" class="form-select" id="sub_category_id">
                                            <?php
                                           
                                            $result_set = sub_category_select_all();
                                            while ($result = mysqli_fetch_array($result_set)) { ?>
                                                <option value="<?php echo $result['id']; ?>"><?php echo $result['sub_category_name']; ?></option>
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