<div class="container">
    <div class="row">
        <div class="col-md-3 col-12 col-sm-12">
            <?php require_once("sidebar.php"); ?>
        </div>
        <div class="col-md-9 col-12 col-sm-12 mt-4" style="height:900px;overflow-y:scroll;">
            <div class="row d-flex justify-content-end">
                <div class="col-md-4 col-12 col-sm-12 ">
                    <select class="form-select" aria-label="Default select example" name="filter" id="filter" data-cat="<?php echo implode(",",$filter_cat_id);?>" data-sub="<?php echo implode(",",$filter_sub_id);?>" data-detail="<?php echo implode(",",$filter_detail_id);?>"  data-brand="<?php echo implode(",",$filter_brand_id);?>">
                        <option selected>Sort By Price</option>
                        <option value="price-desc" >Price: High to Low</option>
                        <option value="price-asc" >Price: Low to High</option>                      
                    </select>
                </div>

            </div>
            <?php $is_sidebar = true; ?>
            <?php include("product.php"); ?>
        </div>
    </div>
</div>
