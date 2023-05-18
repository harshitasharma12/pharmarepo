<?php if (isset($_GET['detail_id']) || (isset($_GET['brand_id']))) { ?>
  <form action="index.php" method="post">
    <div class="d-grid gap-2 mt-4 mb-3">
      <button name="apply_brand" class="btn btn-success" style="background-color:#42855b;color:white;">
        Filter
      </button>
    </div>
    <div class="accordion" id="accordionExample">
      <?php require_once("brands.php"); ?>
    </div>
  </form>
<?php } else {

?>

  <form action="index.php" method="post">
    <div class="d-grid gap-2 mt-4 mb-3">
      <button name="apply_filter" class="btn btn-success" style="background-color:#42855b;color:white;">
        Filter
      </button>
    </div>
    <div class="accordion" id="accordionExample">
      <?php

      $categories = find_all_category();

      while ($category = mysqli_fetch_assoc($categories)) {
      ?>


        <div class="accordion-item ">
          <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo "category-" . $category['id']; ?>" aria-expanded="true" aria-controls="<?php echo "category-" . $category['id']; ?>">
              <?php echo $category['name']; ?>
            </button>
          </h2>
          <div id="<?php echo "category-" . $category['id']; ?>" class="accordion-collapse collapse <?php if (in_array($category['id'], $filter_cat_id)) echo 'show'; ?>" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <?php
              $subs = sub_category_by_category_id($category['id']);
              while ($sub = mysqli_fetch_assoc(($subs))) {
              ?>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" data-id="<?php echo $sub['id']; ?>" <?php if (in_array($sub['id'], $filter_sub_id)) echo 'checked'; ?> id="<?php echo $sub['id']; ?>" name="sub_id[]" value="<?php echo $sub['id']; ?>">

                  <label class="form-check-label" for="flexCheckDefault">
                    <?php echo $sub['name'] ?>
                  </label>
                </div>


              <?php } ?>
            </div>
          </div>
        </div>


      <?php } ?>


    </div>
  </form>
<?php } ?>