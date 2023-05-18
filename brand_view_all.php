<?php require_once("header.php"); ?>
<div class="container">
    <div class="row mt-4">
        <div class="col-md-3 col-12 col-sm-12">
            <!-- sidebar -->
            <form action="index.php" method="post">
                <div class="d-grid gap-2 mt-4 mb-3">
                    <button name="apply_filter_brand" class="btn btn-success" style="background-color:#42855b;color:white;">
                        Filter
                    </button>
                </div>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Brand
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <?php
                                $brands = brand_select_all();
                                while ($brand  = mysqli_fetch_assoc(($brands))) { ?>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" data-id="<?php echo $brand['id']; ?>" <?php if (in_array($brand['id'], $filter_show_brand_id)) echo 'checked'; ?> id="<?php echo $brand['id']; ?>" name="show_brand_id[]" value="<?php echo $brand['id']; ?>">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            <?php echo $brand['name']; ?>
                                        </label>

                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>


        <div class="col-md-9 col-12 col-sm-12 mt-4" style="height:1800px;overflow-y:scroll;">
            <div class="row d-flex justify-content-end">
                <div class="col-md-4 col-sm-12 col-12">
                    <div class="row ">
                       <select class="form-select" aria-label="Default select example" name="filterbrand" id="filterbrand" data-brand_show="<?php echo implode(",",  $filter_show_brand_id); ?>">
                            <option selected>Sort By Price</option>
                            <option value="price-desc">Price: High to Low</option>
                            <option value="price-asc">Price: Low to High</option>
                        </select>
                    </div>
                </div>
            <?php $is_sidebar = true; ?>
            <?php $no_of_col = 4; ?>
            <?php include("product.php"); ?>
        </div>
    </div>
</div>
<?php require_once("footer.php"); ?>