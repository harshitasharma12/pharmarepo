<?php require_once("dashboard/includes/initialize.php"); ?>
<?php
$customer_id = get_customer_id();
if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];
    $cid = $_POST['cid'];
    $row = product_select_by_id($pid);
    if (is_array($row)) {
        $pname = $row['name'];
        $price = $row['price'];
        $qty = 1;
    }

    $query = "INSERT INTO cart(customer_id, product_id,product_type,quantity)";
    $query .= " Values(";
    $query .= "'" . db_escape($db, $cid) . "',";
    $query .= "'" . db_escape($db, $pid) . "',";
    $query .= "'" . db_escape($db, "medicines") . "',";
    $query .= "'" . db_escape($db, $qty) . "'";
    // $query .= "'" . db_escape($db, $discount) . "',";
    // $query .= "'" . db_escape($db, $coupon_discount) . "',";
    // $query .= "'" . db_escape($db, $delivery_charges) . "'";
    $query .= ")";
    $result = mysqli_query($db, $query);
    if ($result == true) {
        // $result = show_details_in_cart($cid);
        echo mysqli_num_rows(get_cart_by_cid($customer_id));
    } else {
        echo "error " . $query;
    }
}
?>

<?php
if (isset($_POST['country_id'])) {
    $country_id = $_POST['country_id'];
    $string = "";
    $result =  state_by_country_id($country_id);
    if (mysqli_num_rows($result) > 0) {
        $string .= "<option>--Select--</option>";
        while ($row = mysqli_fetch_assoc($result)) {
            $string .= "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
        }
    } else {
        $string .= "<option>--Select--</option>";
    }
    echo $string;
}

if (isset($_POST['state_id'])) {
    $state_id = $_POST['state_id'];
    $string = "";
    $result =  city_by_state_id($state_id);
    if (mysqli_num_rows($result) > 0) {
        $string .= "<option>--Select--</option>";
        while ($row = mysqli_fetch_assoc($result)) {
            $string .= "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
        }
    } else {
        $string .= "<option>--Select--</option>";
    }
    echo $string;
}

if (isset($_POST['cartid'])) {
    $cartid = $_POST['cartid'];
    $result = cart_delete_by_id($cartid);
    if ($result == true) {
        if (isset($_SESSION['customer_id'])) {
            $result_array = show_details_in_cart(get_customer_id()); 
            $items=count($result_array);
            // $result=show_details_in_cart($_SESSION['customer_id']);
            // $items = mysqli_num_rows(get_cart_by_cid(get_customer_id()));
            $total = 0;
            if (is_logged_in_customer()) {
                $total =  cart_total_by_customer(get_customer_id());
                $discount = calculate_discount(get_customer_id());
                $net = $total - $discount;
            }
            $arr = array("items" => $items, "total" => $total, "discount" => $discount, "net_amount" => $net);
            echo json_encode($arr);
        } else {
            echo "error";
        }
    } else {
        echo "error" . $query;
    }
}

if (isset($_POST['cart_id']) && isset($_POST['qty'])) { //quantity update
    $cart_id = $_POST['cart_id'];
    $qty = $_POST['qty'];
    $result = cart_update_by_id($cart_id, $qty);
    if ($result == true) {
        if (is_logged_in_customer()) {
            $total =  cart_total_by_customer(get_customer_id());
            $discount = calculate_discount(get_customer_id());
            $net = $total - $discount;
            $arr = array("discount" => $discount, "total" => $total, "net_amount" => $net);
            echo json_encode($arr);
        }
    }
}

if (isset($_POST['address_id'])) {
    $address_id = $_POST['address_id'];
    if (is_logged_in_customer()) {
        $result = set_default_address($address_id, get_customer_id());
        if ($result == true) {
            return true;
        } else {
            exit;
        }
    }
}

if (isset($_POST['lid'])) {
    $lid = $_POST['lid'];
    $cid = $_POST['cid'];
    $row = labtest_select_by_id($lid);
    if (is_array($row)) {
        $pname = $row['name'];
        $price = $row['price'];
        $qty = 1;
    }

    $query = "INSERT INTO cart(customer_id, product_id,product_type,quantity)";
    $query .= " Values(";
    $query .= "'" . db_escape($db, $cid) . "',";
    $query .= "'" . db_escape($db, $lid) . "',";
    $query .= "'" . db_escape($db, "labtest") . "',";
    $query .= "'" . db_escape($db, $qty) . "'";
    $query .= ")";
    $result = mysqli_query($db, $query);
    if ($result == true) {
        $result = get_cart_by_cid($cid);
        echo mysqli_num_rows($result);
    } else {
        echo "error " . $query;
    }
}

if (isset($_POST['filter'])) {
  
    $no_of_col = 4;
    
    $arr_cart_product  = array();
    $items = 0;
    if (isset($_SESSION['customer_id'])) {
        $customer_id = get_customer_id();
        $cart_products = show_details_in_cart($_SESSION['customer_id']);
        foreach ($cart_products as $key => $cart_product) {

            $arr_cart_product[] = $cart_product['product_id'];
        }
        $items = count($arr_cart_product);
    }
    $pricefilter = $_POST['filter'];
    $filter_cat_id = [];
    $filter_sub_id=[];
    $filter_detail_id=[];
    $filter_brand_id=[];
    if(strlen(trim($_POST['cat_id']))>0){
        $filter_cat_id= explode(",",$_POST['cat_id']);
    }
    if(strlen(trim($_POST['sub_id']))>0){
        $filter_sub_id= explode(",",$_POST['sub_id']);
    }
    if(strlen(trim($_POST['detail_id']))>0){
        $filter_detail_id= explode(",",$_POST['detail_id']);
    }
    if(strlen(trim($_POST['brand_id']))>0){
        $filter_brand_id= explode(",",$_POST['brand_id']);
    }
   
    $pricefilter = $pricefilter == 'price-desc' ? 'DESC' : 'ASC';
    $result = product_select_all($filter_cat_id, $filter_sub_id, $filter_detail_id,$filter_brand_id, $pricefilter, true);;

    while ($product = mysqli_fetch_assoc($result)) {
        require("product-card.php");
    }
}

if (isset($_POST['filterbrand'])) {
  
    $no_of_col = 4;
    
    $arr_cart_product  = array();
    $items = 0;
    if (isset($_SESSION['customer_id'])) {
        $customer_id = get_customer_id();
        $cart_products = show_details_in_cart($_SESSION['customer_id']);
        foreach ($cart_products as $key => $cart_product) {

            $arr_cart_product[] = $cart_product['product_id'];
        }
        $items = count($arr_cart_product);
    }
    $pricefilter = $_POST['filterbrand'];
    $filter_show_brand_id=[];
    if(strlen(trim($_POST['show_brand_id']))>0){
        $filter_show_brand_id= explode(",",$_POST['show_brand_id']);
    }
   
    $pricefilter = $pricefilter == 'price-desc' ? 'DESC' : 'ASC';
    $result = product_brand_select_all($filter_show_brand_id, $pricefilter,true);

    while ($product = mysqli_fetch_assoc($result)) {
        require("product-card.php");
    }
}

if(isset($_POST['input']))
{
    $input=$_POST['input'];
    $query="SELECT * FROM product WHERE name LIKE'{$input}%'";
    $result=mysqli_query($db,$query);
    if(mysqli_num_rows($result)>0){?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                while($row=mysqli_fetch_assoc($result)){
                $id=$row['id'];
                $name=$row['name'];
                $price=$row['price'];
                }?>

                <tr>
                    <td><?php echo $id;?></td>
                    <td><?php echo $name;?></td>
                    <td><?php echo $price;?></td>
                </tr>
            </tbody>
    </table>
   <?php }else{
        echo "<h6 class='text-danger text-center mt-3'>No Data Found</h6>";
    }
}

?>

   