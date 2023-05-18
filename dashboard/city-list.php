<?php  require_once("includes/initialize.php"); ?>
<?php  
  if(!is_admin()){
    redirect_to("401.html");
  }
?>
<?php $page_title = 'All City List'; ?>
<?php require_once("header.php"); ?>

                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">City</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">All <Sub></Sub>City</li>
                        </ol>
                         <?php echo display_errors($errors); ?>
                         <?php echo display_session_message(); ?>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fa fa-check-circle me-1"></i>
                                       City Details 
                                        <a href="city-add.php" class="btn btn-sm btn-primary float-end"><i class="fa fa-check-circle"></i> Add New City</a>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                          <div class="col-xl-12">
                                            <table id="datatablesSimple">
                                                <thead>
                                                    <tr>
                                                        <th>SN</th>
                                                        <th>City Name</th>
                                                        <th>Country name</th>
                                                        <th>State Name</th>
                                                        <th>Delete</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <?php   
                                                $result = city_select();  
                                                $sn = 1;?>
                                                <tbody>
                                                  <?php while($city = mysqli_fetch_assoc($result)) { ?>
                                                    <tr>
                                                      <td><?php echo $sn++; ?></td>
                                                      <td><?php echo ($city['name']) ?></td>
                                                      <td><?php echo ($city['country_name']) ?></td>
                                                      <td><?php echo ($city['state_name']) ?></td>
                                                      <td><a href="city-delete.php?id=<?php echo $city['id'];?>" class="btn btn-danger">Delete</a></td>
                                                    </tr>
                                                  <?php } ?>
                                                </tbody>
                                            </table>
                                            <?php mysqli_free_result($result); ?>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                        </div>
                        
                    </div>
                </main>
               <?php require_once("footer.php"); ?>

