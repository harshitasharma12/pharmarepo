 <?php $customer_id = get_customer_id(); ?>
   <header class="d-flex flex-wrap justify-content-center pt-1 border-bottom">
     <a href="index.php" class="d-flex  mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
      <!--  <svg class="bi" width="40" height="32">
         <use xlink:href="#bootstrap" />
       </svg> -->
       <img src="assets/images/pharmacylogo.PNG">
     </a>

     <ul class="nav nav-pills d-flex justify-content-end align-items-center">
       <li><a href="consult.php" class="nav-link px-2" style="font-weight:600;"><i class="fas fa-user-md"></i> CONSULT</a></li>
       <li><a href="index.php" class="nav-link px-2" style="font-weight:600;"><i class="fas fa-pills"></i> PHARMACY</a></li>
       <li><a href="labtest.php" class="nav-link px-2" style="font-weight:600;"><i class="fas fa-vial"></i> LAB TESTS</a></li>
     </ul>

     <ul class="nav nav-pills d-flex justify-content-end align-items-center">
       <li class="nav-item"><a href="cart.php" class="nav-link">
           <i class="fas fa-shopping-cart "></i>
           <?php if (is_logged_in_customer()) { ?>
             <span class="badge bg-secondary" id="message"><?php echo $items; ?></span>
           <?php } ?>
         </a>
       </li>
     </ul>

     <ul class="nav nav-pills d-flex justify-content-end align-items-center">
       <!-- customer -->
       <?php if (is_logged_in_customer()) {
          $appoinments = appoinment_by_cid(get_customer_id());
          $reports = lab_report_by_cid(get_customer_id());
          $order = order_by_cid(get_customer_id());
        ?>
         <li class="nav-item mt-1" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-user-circle" style="font-size:25px;color:#66bc89;"></i></li>

         <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
           <div class="offcanvas-header">
             <h5 class="offcanvas-title" id="offcanvasRightLabel">Customer Details</h5>
             <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
           </div>
           <div class="offcanvas-body">
             <div class="row">
               <div class="col-md-6">
                 <span><i class="fas fa-user-edit"></i>&nbsp;&nbsp;<?php echo get_customer_name(); ?></span><br>
               </div>
               <div class="col-md-6">
                 <span class="d-flex justify-content-end"><a class="navbar_anchor" href="customer-add.php">EDIT</a></span>
               </div>
             </div>
             <hr class="text-success" style="padding:0px;margin:7px;">
             <div class="row">
               <span><i class="fas fa-address-card" style="font-size:21px;"></i>&nbsp;&nbsp;<?php echo get_customer_email(); ?></span><br>
             </div>
             <hr class="text-success" style="padding:0px;margin:7px;">
             <div class="row">
               <span><i class="fas fa-phone"></i>&nbsp;&nbsp;<?php echo get_customer_contact(); ?></span><br>
             </div>
             <hr class="text-success" style="padding:0px;margin:7px;">

             <?php
             //$appoinments['customer_id'] == get_customer_id()
              if (is_array($appoinments)) { ?>
               <div class="row">
                 <span><i class="fas fa-video"></i>&nbsp;&nbsp;<a class="navbar_anchor" href="booked_video_consult.php">Doctor Video Consult</a></span><br>
               </div>
               <hr class="text-success" style="padding:0px;margin:7px;">
             <?php } ?>



             <?php
              //$reports['customer_id'] == get_customer_id()
              if (is_array($reports)) { ?>
               <div class="row">
                 <span><i class="fas fa-vials"></i>&nbsp;&nbsp;<a class="navbar_anchor" href="report.php">Report</a></span><br>
               </div>
               <hr class="text-success" style="padding:0px;margin:7px;">
             <?php } ?>


             <?php
             //$order['customer_id'] == get_customer_id()
              if (is_array($order)) { ?>
               <div class="col-md-6">
                 <span><i class="fas fa-box-open"></i> <a class="navbar_anchor" href="my_orders.php">My order</a></span><br>
               </div>
               <hr class="text-success" style="padding:0px;margin:7px;">
             <?php } ?>


             <div class="row">
               <span><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;<a class="navbar_anchor" href="logout.php">Logout</a></span>
             </div>
           </div>








         </div>
       <?php } else { ?>
         <li class="nav-item mt-2"><a href="login.php"><i class="fas fa-user-circle" style="font-size:25px;color:#66bc89;"></i></a></li>
       <?php } ?>

     </ul>
   </header>
