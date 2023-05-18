<div class="accordion-item" >
      <h2 class="accordion-header">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Brand
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
        <div class="accordion-body">
        <?php
              $brands = brand_select_all();
              
              while ($brand  = mysqli_fetch_assoc(($brands))) {
                
                if(in_array($brand['id'],$filter_brand_id)){

               
              ?>
              
          <div class="form-check" >
            <input class="form-check-input" type="checkbox" <?php if(in_array($brand['id'],$filter_brand_id))  echo 'checked';?> id="<?php echo $brand['id']; ?>" name="brand_id[]" value="<?php echo $brand['id']; ?>">
            <label class="form-check-label" for="flexCheckDefault">
              <?php echo $brand['name'];?>
            </label>
            
          </div>
          <?php }
        }?>
        </div>
      </div>
    </div>