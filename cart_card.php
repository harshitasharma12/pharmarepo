<?php require_once("dashboard/includes/initialize.php");?>
<div class="card-body" id="<?php echo "card-" . $row['id']; ?>">
  <!-- Single item -->
  <div class="row">
    <div class="col-lg-3 col-md-12 col-3 col-sm-3">
      <!-- Image -->
      <div class="">
        <img src="dashboard/uploads/<?php echo $row['dir']; ?>/<?php echo $row['filename']; ?>" height="100" width="100" />
        <a href="#!">
          <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
        </a>
      </div>

    </div>

    <div class="col-lg-5 col-md-6 col-sm-5 col-5">
      <!-- Data -->
      <p><strong><?php echo $row['name']; ?></strong></p>
      <!-- quantity -->
      <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
        <button class="btn btn-link px-2 subOne" data-sub="<?php echo $row['id']; ?>">
          <i class="fas fa-minus btn-success"></i>
        </button>

        <input id="<?php echo "cart-" . $row['id']; ?>" min="0" name="quantity" value="<?php echo $row['quantity']; ?>" type="text" class="form-control form-control-sm" style="width:50px;" />

        <button class="btn btn-link px-2 addOne" data-add="<?php echo $row['id']; ?>" />
        <i class="fas fa-plus btn-success"></i>
        </button>
      </div>


    </div>


    <div class="col-lg-4 col-md-6 col-4 col-sm-4 cart-items ">
      <div class="row ">
        <div class="col-md-6 col-12 col-sm-12">
          <!-- trash button-->
          <button type="button" class="btn btn-success btn-sm me-1 mb-2 deleteBtn " data-mdb-toggle="tooltip" title="Remove item" data-cartid="<?php echo $row['id']; ?>">
            <i class="fas fa-trash"></i>
          </button>



        </div>
        <div class="col-md-6 col-12 col-sm-12 ">

          <!-- Price -->
          <p class="text-start text-md-center">
            <input type="hidden" id='<?php echo "product_" . $row['id']; ?>' value="<?php echo $row['price']; ?>">
            <strong class="productPrice" id='<?php echo "text_" . $row['id']; ?>'><?php echo $row['amount']; ?></strong>
          </p>
        </div>
      </div>

      <?php if ($row['prescription'] == 'Yes') { ?>
        <div class="row">
          <div class="col-md-12 col-12 col-sm-12 mt-4 ">
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
              Upload Prescription
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Prescription Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="prescription-upload.php" method="POST" enctype="multipart/form-data">
                      <div class="mb-3">
                        <label for="name" class="form-label">Choose File</label>
                        <input type="file" name="file" class="form-control">
                      </div>

                      <div class="modal-footer">
                        <button name="submit" class="btn btn-outline-success">Submit</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>


    </div>
  </div>
  <!-- Single item -->

  <hr class="my-2" />

</div>