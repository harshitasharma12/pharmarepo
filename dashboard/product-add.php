<?php require_once("includes/initialize.php"); ?>
<?php require_login(); ?>
<?php $page = "product-add-exec.php"; ?>
<?php $page_title = 'Product';  ?>
<?php require_once("header.php"); ?>
<?php

$name = "";
$price = "";
$expire_date = "";
$prescription = "";
$description = "";
$uses_of = "";
$key_benefits = "";
$directions = "";
$safety_information = "";
$key_ingredient = "";
$category_id = "";
$sub_category_id = "";
$sub_sub_category_id = "";
$brand_id = "";
$discount = "";
$ban = "";
$warranty="";
// $return_item="";
$filename = "";
$action = "Add";
$id = 0;
if (isset($_POST['updatesubmit'])) {
    $id = $_POST['id'];
    $product = product_select_by_id($id);
    if (is_array($product)) {
        $name = $product['name'];
        $price = $product['price'];
        $expire_date = $product['expire_date'];
        $prescription = $product['prescription'];
        $description = $product['description'];
        $uses_of = $product['uses_of'];
        $key_benefits = $product['key_benefits'];
        $directions = $product['directions'];
        $safety_information = $product['safety_information'];
        $key_ingredient = $product['key_ingredient'];
        $category_id = $product['category_id'];
        $sub_category_id = $product['sub_category_id'];
        $sub_sub_category_id = $product['sub_sub_category_id'];
        $brand_id = $product['brand_id'];
        $discount = $product['discount'];
        $ban = explode(",", $product['ban']);
        $warranty=$product['warranty'];
        // $return_item=$product['return_item'];
        $filename = $product['filename'];
        $action = "update";
    }
}
?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?php echo $action . "Product"; ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><?php echo $action; ?> new Product</li>
        </ol>
        <?php echo display_errors($errors); ?>
        <?php echo display_session_message(); ?>
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fab fa-product-hunt me-1"></i>
                        <?php echo $action; ?>
                    </div>
                    <div class="card-body">
                        <form id="form_profile" action="<?php echo $page; ?>" method="post" enctype="multipart/form-data">

                            <input type="hidden" name="MAX_FILE_SIZE" value="188743680" />
                            <div class="row">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="hidden" name="action" value="<?php echo $action; ?>" />

                                <div class="row">

                                    <div class="col-xl-6 offset-xl-2">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" required value="<?php echo $name; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="floatingSelect">Medicine_type</label>
                                            <select name="medicine_type" class="form-select" id="floatingSelect">
                                                <option>Ayurveda</option>
                                                <option>Homeopathic</option>
                                                <option>Allopathic</option>
                                                <option>None</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="name" class="form-label">Price</label>
                                            <input type="text" class="form-control" id="price" name="price" required value="<?php echo $price; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="name" class="form-label">Expire Date</label>
                                            <input type="date" class="form-control" id="expire_date" name="expire_date"  value="<?php echo $expire_date; ?>">
                                        </div>

                                        <label for="name" class="form-label">Prescription</label>
                                        <div class="form-check">

                                            <input class="form-check-input" type="radio" name="prescription" id="prescription" <?php if ($prescription == "Yes") echo "checked"; ?> value="Yes">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="prescription" id="prescription" <?php if ($prescription == "No") echo "checked"; ?> value="No">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                No
                                            </label>
                                        </div>


                                        <div class="mb-3">
                                            <label for="name" class="form-label">Description</label>
                                            <textarea name="description" id="" cols="30" rows="10" class="form-control"><?php echo trim($description); ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="name" class="form-label">Uses Of</label>
                                            <textarea name="uses_of" id="" cols="30" rows="10" class="form-control"><?php echo trim($uses_of); ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="name" class="form-label">Key Benefits</label>
                                            <textarea name="key_benefits" id="product_key_benefits" cols="30" rows="10" class="form-control"><?php echo trim($key_benefits); ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="name" class="form-label">Directions</label>
                                            <textarea name="directions" id="product_directions" cols="30" rows="10" class="form-control"><?php echo trim($directions); ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="name" class="form-label">Safety Information </label>
                                            <textarea name="safety_information" id="product_safety_information" cols="30" rows="10" class="form-control"><?php echo trim($safety_information); ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="name" class="form-label">Key Ingredient</label>
                                            <textarea name="key_ingredient" id="" cols="30" rows="10" class="form-control"><?php echo trim($key_ingredient); ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="floatingSelect">Category Name</label>
                                            <select name="category_id" class="form-select" id="category_id">
                                                <option value="0">--Select--</option>
                                                <?php

                                                $result_set = find_all_category();
                                                while ($result = mysqli_fetch_array($result_set)) { ?>
                                                    <option value="<?php echo $result['id']; ?>" <?php if ($result['id'] == $category_id) echo "selected"; ?>><?php echo $result['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="floatingSelect">Sub Category Name</label>
                                            <select name="sub_category_id" class="form-select" id="sub_category_id">
                                                <option value="0">--Select--</option>

                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="floatingSelect">Sub Sub Category Name</label>
                                            <select name="sub_sub_category_id" class="form-select" id="sub_sub_category_id">
                                                <option value="0">--Select--</option>

                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="floatingSelect">Brand Name</label>
                                            <select name="brand_id" class="form-select" id="brand_id">
                                                <option value="0">--Select--</option>
                                                <?php

                                                $result_set = brand_select_all();
                                                while ($result = mysqli_fetch_array($result_set)) { ?>
                                                    <option value="<?php echo $result['id']; ?>" <?php if ($result['id'] == $brand_id) echo "selected"; ?>><?php echo $result['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="name" class="form-label">Discount</label>
                                            <input type="text" class="form-control" id="discount" name="discount" required value="<?php echo $discount; ?>">
                                        </div>

                                        <select class="form-select" name="ban[]" multiple aria-label="multiple select example">
                                            <option selected>Open this select menu</option>
                                        <?php
                                        $result_set = country_select();
                                        while ($result = mysqli_fetch_array($result_set)) { ?>
                                            <option value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
                                        <?php } ?>
                                        </select>

                                        <div class="mb-3">
                                            <label for="name" class="form-label">Warranty</label>
                                            <input type="number" class="form-control" id="warranty" name="warranty"  value="<?php echo $warranty; ?>">
                                        </div>

                                        <!-- <div class="mb-3">
                                            <label for="name" class="form-label">Returnable</label>
                                            <input type="text" class="form-control" id="return_item" name="return_item" required value="">
                                        </div> -->


                                    <div class="mb-3">
                                        <label for="name" class="form-label">Choose File</label>
                                        <input type="file" name="file" class="form-control">
                                    </div>


                                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                    <button type="reset" class="btn btn-danger" name="reset">Reset</button>
                                </div>
                                <div class="col-md-3">
                                    <img src="uploads/files/<?php echo $filename; ?>" class="img-fluid border">
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