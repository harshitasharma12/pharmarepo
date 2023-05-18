<nav class="navbar navbar-expand-lg">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php 
            $categories = find_all_category();
            while($category = mysqli_fetch_assoc($categories)){
        ?>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-weight:600;">
            <?php echo $category['name']; ?>
          </a>
          <?php $subs = sub_category_by_category_id($category['id']);?>
          
          <div class="dropdown-menu dropdown-large">
            <div class="row g-3">
                <?php $str = "";?>

            <?php while($sub = mysqli_fetch_assoc($subs)){?>
                <?php $details = sub_sub_category_by_subcategory_id($sub['id']); ?>
                <?php if(mysqli_num_rows($details)<=0){?>
                    <?php $str .= '<h6 class="title">'."<a class='sub-links' href=\"index.php?sub_id={$sub['id']}\">".$sub['name'].'</a></h6>' ?>
                    <?php }  else {?>
              <div class="col-4">
                <h6 class="title"><?php echo $sub['name'];?></h6>
                
                <ul class="list-unstyled">
                    <?php while ($detail = mysqli_fetch_assoc($details)){?>
                  <li><a href="index.php?detail_id=<?php echo $detail['id'];?>"><?php echo $detail['name']; ?></a></li>
                  <?php } ?>
                   
                </ul>
            
              </div><!-- end col-4 -->
             
                 
               
              
                <?php } ?>
               
              <?php } ?>               
              <div class="col-4"><?php echo $str;?></div>
            </div>

          </div>
         
          <!-- dropdown-large.// -->
        </li>
      <?php } ?>


        <!-- <li class="nav-item">
          <a class="nav-link" aria-current="page" href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
        </li> -->
        
      </ul>
      
      
    </div>
  </div>
</nav>