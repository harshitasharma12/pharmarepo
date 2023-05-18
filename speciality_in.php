    <div class="col-md-6 col-12">
        <div class="card mt-3 " style="box-shadow:3px 2px 5px grey;">
            <div class="card-body" >
            <a href="list_of_doctors.php?id=<?php echo $result['id'];?>" style="text-decoration:none;color:black;"> 
               <div class="row">
                    <div class="col-md-2 col-2">
                    <img src="dashboard/uploads/speciality/<?php echo $result['filename']; ?>" class="card-img-top mx-auto d-block w-100 mt-3" alt="..." style="height:40px;">
                    </div>
                    <div class="col-md-10 col-10">
                        <div class="row">
                        <span class="word-wrap:normal;" style="font-size:14px;"><?php echo $result['name'];?></span> 
                        </div>
                        <div class="row">
                            <span class="word-wrap:normal;" style="font-size:14px;"><?php echo $result['description'];?></span>
                        </div>
                        <hr>
                    </div>
                   
                    
               </div>
              

               <!-- 2 row -->
               <div class="row">
                <div class="col-md-12 col-sm-12">
                    <span class="word-wrap:normal px-2" style="font-size:14px;"><?php echo $result['includes'];?></span>
                </div>
               </div>
               </a>
            </div>
        </div>
    </div>
