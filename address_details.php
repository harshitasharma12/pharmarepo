<?php require_once("header.php"); ?>
<?php $page = "address-add-exec.php"; ?>
<?php $page_title = 'Address';  ?>
<?php 
$customer_id=get_customer_id();
$country_id=get_customer_country();
$country=country_select_id($country_id);
// $state=state_by_country_id(get_customer_country());
$houseno = "";
$roadname = "";
// $country_id = "";
$state_id = "";
$city_id = "";
$pincode = "";
$near_place="";
$action = "Add";
$id = 0;
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $address = address_select_by_id($id);
  if (is_array($address)) {
    $customer_id=$address['customer_id'];
    $houseno = $address['houseno'];
    $roadname = $address['roadname'];
   
    $state_id = $address['state_id'];
    $city_id = $address['city'];
    $pincode = $address['pincode'];
    $near_place=$address['near_place'];
    $id = $address['id'];
    $action = "Update";
  }
} else if(isset($_POST['updatesubmit'])){
  $id = $_POST['id'];

}
?>
<section class="h-100 gradient-custom">
  <div class="container py-5">
   
        <div class="row ms-5 my-4">
          <div class="col-md-6 mx-auto">
            <div class="card mb-4 ">
              <div class="card py-3" style="border:0 ">
                <h5 class="mb-0 px-3">Fill Your Delivery Address</h5>
              </div>

              <!-- address details -->
              <div class="card-body">
                <!-- Single item -->
                
                    <form id="form_profile" action="<?php echo $page; ?>" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="id" value="<?php echo $id; ?>">
                      <input type="hidden" name="action" value="<?php echo $action; ?>" />
                      
                      <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>" />
                      <label for="floatingInput "><i class="fas fa-map-marker-alt"></i> Address</label>
                      <div class="form-floating mb-3 mt-4">
                        <input type="text" class="form-control" name="houseno" id="houseno" value="<?php echo $houseno; ?>" placeholder="Enter House no./Building no.">
                        <label for="floatingInput">House no./Building no.</label>
                      </div>
                      <div class="form-floating mb-3 mt-4">
                        <input type="text" class="form-control" name="roadname" id="roadname" value="<?php echo $roadname; ?>" placeholder="Enter Road Name/Area/Colony">
                        <label for="floatingInput">Road Name/Area/Colony</label>
                      </div>
                      <div class="row mb-4">
                        <div class="col-md-6">
                        <div class="form-floating">
                        <input type="text" class="form-control" name="country_id" id="country_id" value="<?php echo $country['name'];?>" disabled  placeholder="Country">
                        <label for="floatingInput">Country</label>

                        </div>
                            </div>
                        <div class="col-md-6">
                          <div class="form-floating">
                            <select name="state_id" class="form-select" id="state_id">
                              <option value="0">State Name</option>
                              <?php 
                               
                                  $result_set = state_by_country_id(get_customer_country());
                                  while ($result = mysqli_fetch_array($result_set)) { ?>      
                                    <option value="<?php echo $result['id']; ?>" <?php if($result['id']==$state_id) echo "selected";?>><?php echo $result['name'];?></option>
                                  <?php } ?>
                                
                            
                            </select>
                          </div>

                        </div>
                      </div>
                      <div class="row mb-4">
                        <div class="col-md-6">
                          <div class="form-floating">     
                            <select name="city_id" class="form-select" id="city_id">
                              <option value="0">City Name</option>
                              <?php 
                                if($id>0){
                                  $result_set = city_by_state_id($state_id);
                                  while ($result = mysqli_fetch_array($result_set)) { ?>      
                                    <option value="<?php echo $result['id']; ?>" <?php if($result['id']==$city_id) echo "selected";?>><?php echo $result['name'];?></option>
                                  <?php } ?>
                                
                             <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="Pincode" name="pincode" placeholder="Pincode"value="<?php echo $pincode; ?>" >
                            <label for="floatingInput">Pincode</label>
                          </div>
                        </div>
                      </div>
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nearlocation" name="near_place" placeholder="Near Location(optional)" value="<?php echo $near_place; ?>">
                        <label for="floatingInput">Near Location(optional)</label>
                      </div>
                      
                      <div class="row">
                        <div class="mx-auto col-md-6">
                        <button type="submit" class="btn btn-success" name="submit"><strong>Save Address & Continue</strong></button>
                        </div>
                      </div>
                    
                     
                    </form>
                  </div>
              
              </div> 


            </div>
        

        </div>
      </div>
</section>
<?php require_once("footer.php"); ?>