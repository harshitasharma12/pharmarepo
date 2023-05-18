<?php  require_once("includes/initialize.php");

if(isset($_POST['category_id'])){
    $category_id = $_POST['category_id'];
    $string = "";
    $result =  sub_category_by_category_id($category_id);
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $string .= "<option value='".$row['id']."'>".$row['name']."</option>";
        }
    } else{
        $string .= "<option>--Select--</option>";
    }
    echo $string;

}

if(isset($_POST['sub_category_id'])){
    $sub_category_id = $_POST['sub_category_id'];
    $string = "";
    $result =  sub_sub_category_by_subcategory_id($sub_category_id);
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $string .= "<option value='".$row['id']."'>".$row['name']."</option>";
        }
    } else{
        $string .= "<option>--Select--</option>";
    }
    echo $string;

}


if(isset($_POST['country_id'])){
    $country_id = $_POST['country_id'];
    $string = "";
    $result =  state_by_country_id($country_id);
    if(mysqli_num_rows($result)>0){
        $string .= "<option>--Select--</option>";
        while($row = mysqli_fetch_assoc($result)){
            $string .= "<option value='".$row['id']."'>".$row['name']."</option>";
        }
    } else{
        $string .= "<option>--Select--</option>";
    }
    echo $string;

}




?>


   
        

  

