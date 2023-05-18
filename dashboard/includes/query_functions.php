<?php

function run_by_sql($sql)
{
  global $db;
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}


// Admins

// Find all admins, ordered last_name, first_name
function find_all_admins()
{
  global $db;

  $sql = "SELECT * FROM admins ";
  $sql .= "ORDER BY last_name ASC, first_name ASC";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function find_admin_by_id($id)
{
  global $db;

  $sql = "SELECT * FROM admins ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $admin = mysqli_fetch_assoc($result); // find first
  mysqli_free_result($result);
  return $admin; // returns an assoc. array
}

function find_admin_by_username($username)
{
  global $db;

  $sql = "SELECT * FROM admins ";
  $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  confirm_result_set($result);
  $admin = mysqli_fetch_assoc($result); // find first
  mysqli_free_result($result);
  return $admin; // returns an assoc. array
}

function find_doctor_by_username($username)
{
  global $db;

  $sql = "SELECT * FROM doctors ";
  $sql .= "WHERE email='" . db_escape($db, $username) . "' ";
  $result = mysqli_query($db, $sql);
  //echo $sql;exit;
  confirm_result_set($result);
  $doctor = mysqli_fetch_assoc($result); // find first
  mysqli_free_result($result);
  return $doctor; // returns an assoc. array
}





// News Functions

function insert_news($news)
{
  global $db;

  $errors = validate_news($news);
  if (!empty($errors)) {
    return $errors;
  }


  $sql = "INSERT INTO news ";
  $sql .= "(title, description) ";
  $sql .= "VALUES (";
  $sql .= "'" . db_escape($db, $news['title']) . "', ";
  $sql .= "'" . db_escape($db, $news['description']) . "'";
  $sql .= ")";
  echo $sql;
  $result = mysqli_query($db, $sql);
  // For INSERT statements, $result is true/false
  if ($result) {
    return true;
  } else {
    // INSERT failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function update_news_by_id($news)
{
  global $db;

  $errors = validate_news($news);
  if (!empty($errors)) {
    return $errors;
  }

  $sql = "UPDATE news set title = ";
  $sql .= " '" . db_escape($db, $news['title']) . "'";
  $sql .= " , description = '" . db_escape($db, $news['description']) . "'";
  $sql .= " WHERE id = ";
  $sql .= "'" . db_escape($db, $news['id']) . "'";
  $result = mysqli_query($db, $sql);

  // For UPDATE statements, $result is true/false
  if ($result) {
    return true;
  } else {
    // UPDATE failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function validate_news($news)
{
  $errors = [];

  // subject_id
  if (is_blank($news['title'])) {
    $errors[] = "News Title cannot be blank.";
  }
  if (is_blank($news['description'])) {
    $errors[] = "News Description cannot be blank.";
  }

  return $errors;
}

function find_all_news()
{
  global $db;

  $sql = "SELECT * FROM news ";
  $sql .= "ORDER BY id DESC";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function delete_news($id)
{
  global $db;

  $sql = "DELETE FROM news  ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);

  // For DELETE statements, $result is true/false
  if ($result) {
    return true;
  } else {
    // DELETE failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function find_news_by_id($id)
{
  global $db;

  $sql = "SELECT * FROM news ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $news = mysqli_fetch_assoc($result); // find first
  mysqli_free_result($result);
  return $news; // returns an assoc. array
}



// USERS Functions

function find_user_by_username($username)
{
  global $db;

  $sql = "SELECT * FROM office_login ";
  $sql .= "WHERE type='" . db_escape($db, $username) . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $admin = mysqli_fetch_assoc($result); // find first
  mysqli_free_result($result);
  return $admin; // returns an assoc. array
}


function change_password($username, $password)
{
  global $db;
  if ($password['role'] === "1") {
    $user = find_admin_by_username($username);
  } else if($password['role'] === "2"){
    $user = find_doctor_by_username($username);
  } else if($password['role'] === "3"){
    $user = find_customer($username);
  }

  if (isset($password['reset_password'])) {
    if ($password['password'] !== $password['confirm_password']) {
      $errors[] = "confirm password is not matched with new password";
    }
  } else if($password['role'] === "2") {
    if (!password_verify($password['current_password'], $user['hpassword'])) {
      $errors[] = "current password is incorrect";
    } else if ($password['password'] !== $password['confirm_password']) {
      $errors[] = "confirm password is not matched with new password";
    }
  } else if($password['role'] === "3"){
     if (!password_verify($password['current_password'], $user['hpassword'])) {
      $errors[] = "current password is incorrect";
    } else if ($password['password'] !== $password['confirm_password']) {
      $errors[] = "confirm password is not matched with new password";
    }
  }



  if (!empty($errors)) {
    return $errors;
    exit;
  } else {
    $new_password = password_hash($password['password'], PASSWORD_BCRYPT);
    if ($password['role'] === "1") {
      $sql = "UPDATE admins set hpassword = ";
      $sql .= " '" . db_escape($db, $new_password) . "'";
      $sql .= " , password = '" . db_escape($db, $password['password']) . "'";
      $sql .= " WHERE username = ";
      $sql .= "'" . db_escape($db, $username) . "'";
    } else if ($password['role'] === "2") {
      $sql = "UPDATE doctors set hpassword = ";
      $sql .= " '" . db_escape($db, $new_password) . "'";
      $sql .= " WHERE email = ";
      $sql .= "'" . db_escape($db, $username) . "'";
    } else if ($password['role'] === "3") {
      $sql = "UPDATE customer set hpassword = ";
      $sql .= " '" . db_escape($db, $new_password) . "', ";
      $sql .= " password = '" . db_escape($db, $password['password']) . "'";
      $sql .= " WHERE email = ";
      $sql .= "'" . db_escape($db, $username) . "'";
    }
    $result = mysqli_query($db, $sql);

    // For UPDATE statements, $result is true/false
    if ($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }
}

function insert_user($user)
{
  global $db;

  /* $errors = validate_admin($admin);
      if (!empty($errors)) {
        return $errors;
      }*/

  $hashed_password = password_hash($user['password'], PASSWORD_BCRYPT);
  $sql = "INSERT INTO office_login ";
  $sql .= "(type, password, confirm, hpassword) ";
  $sql .= "VALUES (";
  $sql .= "'" . db_escape($db, $user['name']) . "',";
  $sql .= "'" . db_escape($db, $user['password']) . "',";
  $sql .= "'" . db_escape($db, "0") . "',";
  $sql .= "'" . db_escape($db, $hashed_password) . "'";

  $sql .= ")";
  $result = mysqli_query($db, $sql);

  // For INSERT statements, $result is true/false
  if ($result) {
    return true;
  } else {
    // INSERT failed
    echo $sql;
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function change_password_validate($admin)
{
  
  if (is_blank($admin['password'])) {
    $errors["password"] = "Password cannot be blank.";
  } elseif (!has_length($admin['password'], array('min' => 12))) {
    $errors["password"] = "Password must contain 12 or more characters";
  } elseif (!preg_match('/[A-Z]/', $admin['password'])) {
    $errors["password"] = "Password must contain at least 1 uppercase letter";
  } elseif (!preg_match('/[a-z]/', $admin['password'])) {
    $errors["password"] = "Password must contain at least 1 lowercase letter";
  } elseif (!preg_match('/[0-9]/', $admin['password'])) {
    $errors["password"] = "Password must contain at least 1 number";
  } elseif (!preg_match('/[^A-Za-z0-9\s]/', $admin['password'])) {
    $errors["password"] = "Password must contain at least 1 symbol";
  }

  return $errors;
}

function validate_user($admin)
{

  global $errors;
  // $password_required = $options['password'] ?? true;
  
  if (is_blank($admin['first_name'])) {
    $errors["first_name"] = "First name cannot be blank.";
  } elseif (!has_length($admin['first_name'], array('min' => 2, 'max' => 255))) {
    $errors["first_name"] = "First name must be between 2 and 255 characters.";
  }


  if (is_blank($admin['last_name'])) {
    $errors["last_name"] = "Last name cannot be blank.";
  } elseif (!has_length($admin['last_name'], array('min' => 2, 'max' => 255))) {
    $errors["last_name"] = "Last name must be between 2 and 255 characters.";
  }

  if (is_blank($admin['email'])) {
    $errors["email"] = "Email cannot be blank.";
  } elseif (!has_length($admin['email'], array('max' => 255))) {
    $errors["email"] = "Last name must be less than 255 characters.";
  } elseif (!has_valid_email_format($admin['email'])) {
    $errors["email"] = "Email must be a valid format.";
  }

  // if (is_blank($admin['username'])) {
  //   $errors[] = "Username cannot be blank.";
  // } elseif (!has_length($admin['username'], array('min' => 8, 'max' => 255))) {
  //   $errors[] = "Username must be between 8 and 255 characters.";
  // }
  // elseif (!has_unique_username($admin['username'], $admin['id'] ?? 0)) {
  //   $errors[] = "Username not allowed. Try another.";
  // }

  
    if (is_blank($admin['password'])) {
      $errors["password"] = "Password cannot be blank.";
    } elseif (!has_length($admin['password'], array('min' => 12))) {
      $errors["password"] = "Password must contain 12 or more characters";
    } elseif (!preg_match('/[A-Z]/', $admin['password'])) {
      $errors["password"] = "Password must contain at least 1 uppercase letter";
    } elseif (!preg_match('/[a-z]/', $admin['password'])) {
      $errors["password"] = "Password must contain at least 1 lowercase letter";
    } elseif (!preg_match('/[0-9]/', $admin['password'])) {
      $errors["password"] = "Password must contain at least 1 number";
    } elseif (!preg_match('/[^A-Za-z0-9\s]/', $admin['password'])) {
      $errors["password"] = "Password must contain at least 1 symbol";
    }

    if (is_blank($admin['contact'])) {
      $errors["contact"] = "Contact cannot be blank.";
    }elseif(!preg_match('/[1-9]{1}[0-9]{9}+$/', $admin['contact'])){
      $errors["contact"] = "Don't match as a phone Number";
    }

    // if (is_blank($admin['confirm_password'])) {
    //   $errors[] = "Confirm password cannot be blank.";
    // } elseif ($admin['password'] !== $admin['confirm_password']) {
    //   $errors[] = "Password and confirm password must match.";
    // }
    return $errors;
  }

  
  function update_validate_user($admin)
  {
  
    // $password_required = $options['password'] ?? true;
    
    if (is_blank($admin['first_name'])) {
      $errors["first_name"] = "First name cannot be blank.";
    } elseif (!has_length($admin['first_name'], array('min' => 2, 'max' => 255))) {
      $errors["first_name"] = "First name must be between 2 and 255 characters.";
    }
  
  
    if (is_blank($admin['last_name'])) {
      $errors["last_name"] = "Last name cannot be blank.";
    } elseif (!has_length($admin['last_name'], array('min' => 2, 'max' => 255))) {
      $errors["last_name"] = "Last name must be between 2 and 255 characters.";
    }
  
    
      if (is_blank($admin['contact'])) {
        $errors["contact"] = "Contact cannot be blank.";
      }elseif(!preg_match('/[1-9]{1}[0-9]{9}+$/', $admin['contact'])){
        $errors["contact"] = "Don't match as a phone Number";
      }
  
      return $errors;
    }
  


function find_all_users()
{
  global $db;

  $sql = "SELECT * FROM office_login ";
  $sql .= " ORDER by type ASC ";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}



function find_user_by_id($id)
{
  global $db;


  $sql = "SELECT * FROM office_login ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
  // echo $sql;
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $result_set = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $result_set; // returns an assoc. array
}

function confirm_user_by_id($id)
{
  global $db;
  $sql = "UPDATE office_login set confirm = !confirm ";
  $sql .= " WHERE id = '" . db_escape($db, $id) . "'";
  $sql .= "LIMIT 1";
  echo $sql;
  $result = mysqli_query($db, $sql);

  // For UPDATE statements, $result is true/false
  if ($result) {
    return true;
  } else {
    // UPDATE failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function find_confirm_status($id)
{
  global $db;
  $user = find_user_by_id($id);
  if (is_array($user)) {
    if ($user['confirm'] === "1") {
      return true;
    } else {
      return false;
    }
  } else {
    return false;
  }
}

function get_user_name($id)
{
  global $db;
  $user = find_user_by_id($id);
  if (is_array($user)) {
    return $user['name'];
  } else {
    return "NA";
  }
}

// Upload Functions

function insert_upload($upload)
{
  global $db;

  $errors = validate_upload($upload);
  if (!empty($errors)) {
    return $errors;
  }


  $sql = "INSERT INTO uploadform ";
  $sql .= "(type_id, title, filename, upload_date) ";
  $sql .= "VALUES (";
  $sql .= "'" . db_escape($db, $upload['type_id']) . "', ";
  $sql .= "'" . db_escape($db, $upload['title']) . "', ";
  $sql .= "'" . db_escape($db, $upload['filename']) . "',";
  $sql .= " now() ";
  $sql .= ")";

  $result = mysqli_query($db, $sql);
  // For INSERT statements, $result is true/false
  if ($result) {
    return true;
  } else {
    // INSERT failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function update_upload_by_id($upload)
{
  global $db;

  $errors = validate_upload($upload);
  if (!empty($errors)) {
    return $errors;
  }

  $sql = "UPDATE uploadform set title = ";
  $sql .= " '" . db_escape($db, $upload['title']) . "'";
  $sql .= " , filename = '" . db_escape($db, $upload['filename']) . "'";
  $sql .= " WHERE id = ";
  $sql .= "'" . db_escape($db, $upload['id']) . "'";
  $result = mysqli_query($db, $sql);

  // For UPDATE statements, $result is true/false
  if ($result) {
    return true;
  } else {
    // UPDATE failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function validate_upload($upload)
{
  $errors = [];

  // subject_id
  if (is_blank($upload['title'])) {
    $errors[] = "Upload Title cannot be blank.";
  }
  if (is_blank($upload['filename'])) {
    $errors[] = "Upload Description cannot be blank.";
  }

  return $errors;
}

function find_all_upload($user_id = false)
{
  global $db;

  $sql = "SELECT uploadform.*, office_login.type as 'type' FROM uploadform, office_login ";
  if ($user_id) {
    $sql .= " WHERE type_id = '$user_id'";
    $sql .= " AND office_login.id = uploadform.type_id";
  } else {
    $sql .= " WHERE office_login.id = uploadform.type_id ";
  }
  $sql .= " ORDER BY id DESC";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function delete_upload($id)
{
  global $db;

  $sql = "DELETE FROM uploadform  ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);

  // For DELETE statements, $result is true/false
  if ($result) {
    return true;
  } else {
    // DELETE failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function find_upload_by_id($id)
{
  global $db;

  $sql = "SELECT * FROM uploadform ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $upload = mysqli_fetch_assoc($result); // find first
  mysqli_free_result($result);
  return $upload; // returns an assoc. array
}



//category
function insert_category($category)
{
  global $db;
  $sql = "INSERT INTO category(name)";
  $sql .= "Values(";
  $sql .= "'" . db_escape($db, $category['name']) . "'";
  $sql .= ")";
  //echo $sql; exit;
  if (category_by_name($category) == false) {
    $result = mysqli_query($db, $sql);
    if ($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  } else {
    redirect_to("category-add-exec.php");
  }
}

function category_by_name($category)
{
  global $db;
  $sql = "SELECT * FROM category WHERE name='" . db_escape($db, $category['name']) . "'";
  // $sql.=" AND contact='" . db_escape($db, $customer['contact']) . "'";
  $result = mysqli_query($db, $sql);
  if (mysqli_num_rows($result) > 0) {
    return true;
  } else {
    return false;
  }
}

// category select query
function find_all_category()
{
  global $db;
  $sql = "SELECT * FROM category";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function insert_sub_category($sub_category)
{
  global $db;
  $sql = "INSERT INTO sub_category(name,category_id)";
  $sql .= "Values(";
  $sql .= "'" . db_escape($db, $sub_category['name']) . "',";
  $sql .= "'" . db_escape($db, $sub_category['category']) . "'";
  $sql .= ")";
  $result = mysqli_query($db, $sql);
  if (sub_category_by_name($sub_category) == false) {
    $result = mysqli_query($db, $sql);
    if ($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  } else {
    redirect_to("sub-category-add-exec.php");
  }
}

function sub_category_by_name($sub_category)
{
  global $db;
  $sql = "SELECT * FROM sub_category WHERE name='" . db_escape($db, $sub_category['name']) . "'";
  // $sql.=" AND contact='" . db_escape($db, $customer['contact']) . "'";
  $result = mysqli_query($db, $sql);
  if (mysqli_num_rows($result) > 0) {
    return true;
  } else {
    return false;
  }
}


function subsub_category_add($sub_sub_category)
{
  global $db;
  $sql = "INSERT INTO sub_sub_category (name,sub_category_id)";
  $sql .= "VALUES(";
  $sql .= "'" . db_escape($db, $sub_sub_category['name']) . "', ";
  $sql .= "'" . db_escape($db, $sub_sub_category['sub_category_id']) . "'";
  $sql .= ")";
  $result = mysqli_query($db, $sql);
  //echo $sql;exit;
  if (sub_sub_category_by_name($sub_sub_category) == false) {
    $result = mysqli_query($db, $sql);
    if ($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  } else {
    redirect_to("sub-sub-category-add-exec.php");
  }
}

function sub_sub_category_by_name($sub_sub_category)
{
  global $db;
  $sql = "SELECT * FROM sub_sub_category WHERE name='" . db_escape($db, $sub_sub_category['name']) . "'";
  // $sql.=" AND contact='" . db_escape($db, $customer['contact']) . "'";
  $result = mysqli_query($db, $sql);
  if (mysqli_num_rows($result) > 0) {
    return true;
  } else {
    return false;
  }
}

function sub_category_select_all()
{
  global $db;
  $sql = "SELECT sub_category.id,sub_category.name as sub_category_name,sub_category.category_id,";
  $sql .= "category.name as category_name ";
  $sql .= "FROM sub_category,category ";
  $sql .= "where sub_category.category_id=category.id";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function order_detail_select_all()
{
  global $db;
  $sql = "SELECT * from order_details";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function order_product_select_all()
{
  global $db;
  $sql = "SELECT * from order_product";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  confirm_result_set($result);
  return $result;
}

function sub_sub_category_select_all()
{
  global $db;
  $sql = "SELECT sub_sub_category.name,sub_sub_category.sub_category_id,sub_category.id,sub_category.name as sub_category_name";
  $sql .= " from sub_category,sub_sub_category";
  $sql .= " where sub_sub_category.sub_category_id=sub_category.id";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  confirm_result_set($result);
  return $result;
}
function sub_category_delete($id)
{
  global $db;
  $sql = "DELETE FROM sub_category ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "'";
  $result = mysqli_query($db, $sql);
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function sub_sub_category_delete($id)
{
  global $db;
  $sql = "DELETE FROM sub_sub_category ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "'";
  $result = mysqli_query($db, $sql);
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function category_delete($id)
{
  global $db;
  $sql = "DELETE FROM category ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "'";
  $result = mysqli_query($db, $sql);
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function sub_category_by_id($id)
{
  global $db;
  $sql = "SELECT * FROM sub_category ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $row = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $row;
}

function category_by_sub_cat($id)
{
  global $db;
  $sql = "SELECT * FROM sub_category ";
  $sql .= "WHERE id IN(" . implode(",", $id) . ")";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $cat = [];
  while ($row = mysqli_fetch_assoc($result)) {
    array_push($cat, $row['category_id']);
  }
  return $cat;
}

function sub_category_by_detail_id($detail_id)
{
  global $db;
  $sql = "SELECT * FROM sub_sub_category ";
  $sql .= "WHERE id IN(" . implode(",", $detail_id) . ")";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $sub_id = [];
  while ($row = mysqli_fetch_assoc($result)) {
    array_push($sub_id, $row['sub_category_id']);
  }
  return $sub_id;
}


function sub_sub_category_by_id($id)
{
  global $db;
  $sql = "SELECT * FROM sub_sub_category ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $row = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $row;
}

function sub_category_by_category_id($cat_id)
{
  global $db;
  $sql = "SELECT * FROM sub_category ";
  $sql .= "WHERE category_id='" . db_escape($db, $cat_id) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}



function sub_sub_category_by_subcategory_id($subcat_id)
{
  global $db;
  $sql = "SELECT * FROM sub_sub_category ";
  $sql .= "WHERE sub_category_id='" . db_escape($db, $subcat_id) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function detail_id_by_sub_id($subcat_id)
{
  global $db;
  $sql = "SELECT * FROM sub_sub_category ";
  $sql .= "WHERE sub_category_id IN(" . implode(",", $subcat_id) . ")";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $detail_id = [];
  while ($row = mysqli_fetch_assoc($result)) {
    array_push($detail_id, $row['id']);
  }
  return $detail_id;
}


function category_by_id($id)
{
  global $db;
  $sql = "SELECT * FROM category ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $row = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $row;
}
function sub_category_update($sub_category)
{
  global $db;
  $sql = "UPDATE sub_category set name = ";
  $sql .= " '" . db_escape($db, $sub_category['name']) . "', ";
  $sql .= "category_id = '" . db_escape($db, $sub_category['category']) . "'";
  $sql .= " WHERE id = ";
  $sql .= "'" . db_escape($db, $sub_category['id']) . "'";
  $result = mysqli_query($db, $sql);
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function subsub_category_update($sub_sub_category)
{
  global $db;
  $sql = "UPDATE sub_sub_category set name = ";
  $sql .= " '" . db_escape($db, $sub_sub_category['name']) . "', ";
  $sql .= "sub_category_id = '" . db_escape($db, $sub_sub_category['sub_category_id']) . "'";
  $sql .= " WHERE id = ";
  $sql .= "'" . db_escape($db, $sub_sub_category['id']) . "'";
  $result = mysqli_query($db, $sql);
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function category_update($category)
{
  global $db;
  $sql = "UPDATE category set name = ";
  $sql .= " '" . db_escape($db, $category['name']) . "'";
  $sql .= " WHERE id = ";
  $sql .= "'" . db_escape($db, $category['id']) . "'";
  $result = mysqli_query($db, $sql);
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

//  product update
function product_update($product)
{
  global $db;
  $sql = "UPDATE product set name = ";
  $sql .= " '" . db_escape($db, $product['name']) . "',";
  $sql .= "medicine_type= '" . db_escape($db, $product['medicine_type']) . "',";
  $sql .= "price= '" . db_escape($db, $product['price']) . "',";
  $sql .= "expire_date= '" . db_escape($db, $product['expire_date']) . "',";
  $sql .= "description= '" . db_escape($db, $product['description']) . "',";
  $sql .= "uses_of= '" . db_escape($db, $product['uses_of']) . "',";
  $sql .= "key_benefits= '" . db_escape($db, $product['key_benefits']) . "',";
  $sql .= "directions= '" . db_escape($db, $product['directions']) . "',";
  $sql .= "safety_information= '" . db_escape($db, $product['safety_information']) . "',";
  $sql .= "key_ingredient= '" . db_escape($db, $product['key_ingredient']) . "',";
  $sql .= "prescription= '" . db_escape($db, $product['prescription']) . "',";
  $sql .= "category_id= '" . db_escape($db, $product['category_id']) . "',";
  $sql .= "sub_category_id= '" . db_escape($db, $product['sub_category_id']) . "',";
  $sql .= "sub_sub_category_id= '" . db_escape($db, $product['sub_sub_category_id']) . "',";
  $sql .= "brand_id= '" . db_escape($db, $product['brand_id']) . "',";
  $sql .= "discount= '" . db_escape($db, $product['discount']) . "',";
  $sql .= "ban = '" . implode(",", $product['ban']) . "',";
  $sql .= "warranty= '" . db_escape($db, $product['warranty']) . "',";
  // $sql .= "return_item= '" . db_escape($db, $product['return_item']) . "',";
  $sql .= "filename= '" . db_escape($db, $product['filename']) . "'";
  $sql .= " WHERE id = ";
  $sql .= "'" . db_escape($db, $product['id']) . "'";
  $result = mysqli_query($db, $sql);
  // echo  $sql;exit;
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function doctor_update($doctor)
{
  global $db;
  $sql = "UPDATE doctors set name = ";
  $sql .= " '" . db_escape($db, $doctor['name']) . "',";
  $sql .= "speciality_id= '" . db_escape($db, $doctor['speciality_id']) . "',";
  $sql .= "field_of_expertise= '" . db_escape($db, $doctor['field_of_expertise']) . "',";
  $sql .= "working_as= '" . db_escape($db, $doctor['working_as']) . "',";
  $sql .= "pay_price= '" . db_escape($db, $doctor['pay_price']) . "',";
  $sql .= "education= '" . db_escape($db, $doctor['education']) . "',";
  $sql .= "experience= '" . db_escape($db, $doctor['experience']) . "',";
  $sql .= "currently_working_in= '" . db_escape($db, $doctor['currently_working_in']) . "',";
  $sql .= "awards= '" . db_escape($db, $doctor['awards']) . "'";
  $sql .= " WHERE id = ";
  $sql .= "'" . db_escape($db, $doctor['id']) . "'";
  $result = mysqli_query($db, $sql);
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}


function labtest_update($labtest)
{
  global $db;
  $sql = "UPDATE labtest set name = ";
  $sql .= " '" . db_escape($db, $labtest['name']) . "',";
  $sql .= "also_known= '" . db_escape($db, $labtest['also_known']) . "',";
  $sql .= "report= '" . db_escape($db, $labtest['report']) . "',";
  $sql .= "price= '" . db_escape($db, $labtest['price']) . "',";
  $sql .= "test_include= '" . db_escape($db, $labtest['test_include']) . "',";
  $sql .= "test_name= '" . db_escape($db, $labtest['test_name']) . "',";
  $sql .= "about= '" . db_escape($db, $labtest['about']) . "',";
  $sql .= "gender= '" . db_escape($db, $labtest['gender']) . "',";
  $sql .= "age_group= '" . db_escape($db, $labtest['age_group']) . "',";
  $sql .= "sample= '" . db_escape($db, $labtest['sample']) . "',";
  $sql .= "filename= '" . db_escape($db, $labtest['filename']) . "'";
  $sql .= " WHERE id = ";
  $sql .= "'" . db_escape($db, $labtest['id']) . "'";
  $result = mysqli_query($db, $sql);
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function report_update($report)
{
  global $db;
  $sql = "UPDATE lab_report set filename = ";
  $sql .= " '" . db_escape($db, $report['filename']) . "'";
  $sql .= " WHERE id = ";
  $sql .= "'" . db_escape($db, $report['id']) . "'";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function report_select_all()
{
  global $db;
  $sql = "SELECT * from lab_report";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  confirm_result_set($result);
  return $result;
}

function report_by_customer_id($customer_id)
{
  global $db;
  $sql = " SELECT lab_report.*, order_product.product_name";
  $sql .= " FROM `lab_report`,order_product, order_details ";
  $sql .= " WHERE lab_report.order_no = order_product.order_id ";
  $sql .= " AND lab_report.order_no = order_details.order_no ";
  $sql .= " AND order_product.order_id = order_details.order_no ";
  $sql .= " and order_details.customer_id = '" . db_escape($db, $customer_id) . "'";
  $sql .= " and order_product.product_type='labtest' ";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  confirm_result_set($result);
  return $result;
}


// function report_add($report)
// {
//   global $db;
//   $sql = "INSERT INTO lab_report(filename)";
//   $sql .= "Values(";
//   $sql .= "'" . db_escape($db, $report['filename']) . "'";
//   $sql .= ")";
//   $result = mysqli_query($db, $sql);
//   echo $sql;exit;
//   if ($result) {
//     return true;
//   } else {
//     echo mysqli_error($db);
//     db_disconnect($db);
//     exit;
//   }
// }

function speciality_update($speciality)
{
  global $db;
  $sql = "UPDATE product set name = ";
  $sql .= " '" . db_escape($db, $speciality['name']) . "',";
  $sql .= "description= '" . db_escape($db, $speciality['description']) . "',";
  $sql .= "includes= '" . db_escape($db, $speciality['includes']) . "',";
  $sql .= " WHERE id = ";
  $sql .= "'" . db_escape($db, $speciality['id']) . "'";
  $result = mysqli_query($db, $sql);
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function product_add($product)
{
  global $db;
  $sql = "INSERT INTO product(name,medicine_type,price,expire_date,description,uses_of,key_benefits,directions,safety_information,key_ingredient,prescription,category_id,sub_category_id,sub_sub_category_id,brand_id,discount,ban,warranty,filename)";
  $sql .= "Values(";
  $sql .= "'" . db_escape($db, $product['name']) . "',";
  $sql .= "'" . db_escape($db, $product['medicine_type']) . "',";
  $sql .= "'" . db_escape($db, $product['price']) . "',";
  $sql .= "'" . db_escape($db, $product['expire_date']) . "',";
  $sql .= "'" . db_escape($db, $product['description']) . "',";
  $sql .= "'" . db_escape($db, $product['uses_of']) . "',";
  $sql .= "'" . db_escape($db, $product['key_benefits']) . "',";
  $sql .= "'" . db_escape($db, $product['directions']) . "',";
  $sql .= "'" . db_escape($db, $product['safety_information']) . "',";
  $sql .= "'" . db_escape($db, $product['key_ingredient']) . "',";
  $sql .= "'" . db_escape($db, $product['prescription']) . "',";
  $sql .= "'" . db_escape($db, $product['category_id']) . "',";
  $sql .= "'" . db_escape($db, $product['sub_category_id']) . "',";
  $sql .= "'" . db_escape($db, $product['sub_sub_category_id']) . "',";
  $sql .= "'" . db_escape($db, $product['brand_id']) . "',";
  $sql .= "'" . db_escape($db, $product['discount']) . "',";
  $sql .= "'" . implode(",", $product['ban']) . "',";
  $sql .= "'" . db_escape($db, $product['warranty']) . "',";
  // $sql .= "'" . db_escape($db, $product['return_item']) . "',";
  $sql .= "'" . db_escape($db, $product['filename']) . "'";
  $sql .= ")";

  if (product_notduplicate($product) == false) {
    $result = mysqli_query($db, $sql);
    if ($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  } else {
    redirect_to("product-add-exec.php");
  }
}

function product_notduplicate($product)
{
  global $db;
  $sql = "SELECT * FROM product WHERE name='" . db_escape($db, $product['name']) . "'";
  // $sql.=" AND filename='" . db_escape($db, $product['filename']) . "'";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  if (mysqli_num_rows($result) > 0) {
    return true;
  } else {
    return false;
  }
}

function doctor_add($doctor)
{
  global $db;
  $new_password = password_hash($doctor['password'], PASSWORD_BCRYPT);
  $sql = "INSERT INTO doctors(name,speciality_id,field_of_expertise,working_as,pay_price,education,experience,currently_working_in,awards,filename,email,hpassword)";
  $sql .= "Values(";
  $sql .= "'" . db_escape($db, $doctor['name']) . "',";
  $sql .= "'" . db_escape($db, $doctor['speciality_id']) . "',";
  $sql .= "'" . db_escape($db, $doctor['field_of_expertise']) . "',";
  $sql .= "'" . db_escape($db, $doctor['working_as']) . "',";
  $sql .= "'" . db_escape($db, $doctor['pay_price']) . "',";
  $sql .= "'" . db_escape($db, $doctor['education']) . "',";
  $sql .= "'" . db_escape($db, $doctor['experience']) . "',";
  $sql .= "'" . db_escape($db, $doctor['currently_working_in']) . "',";
  $sql .= "'" . db_escape($db, $doctor['awards']) . "',";
  $sql .= "'" . db_escape($db, $doctor['filename']) . "',";
  $sql .= "'" . db_escape($db, $doctor['email']) . "',";
  $sql .= "'" . db_escape($db, $new_password) . "'";
  $sql .= ")";
  if (doctor_by_email($doctor) == false) {
    $result = mysqli_query($db, $sql);
    if ($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  } else {
    redirect_to("doctor-add-exec.php");
  }
}

function doctor_by_email($doctor)
{
  global $db;
  $sql = "SELECT * FROM doctors WHERE email='" . db_escape($db, $doctor['email']) . "'";
  // $sql.=" AND contact='" . db_escape($db, $customer['contact']) . "'";
  $result = mysqli_query($db, $sql);
  if (mysqli_num_rows($result) > 0) {
    return true;
  } else {
    return false;
  }
}


function labtest_add($labtest)
{
  global $db;
  $sql = "INSERT INTO labtest(name,also_known,report,price,test_include,test_name,about,gender,age_group,sample,filename)";
  $sql .= "Values(";
  $sql .= "'" . db_escape($db, $labtest['name']) . "',";
  $sql .= "'" . db_escape($db, $labtest['also_known']) . "',";
  $sql .= "'" . db_escape($db, $labtest['report']) . "',";
  $sql .= "'" . db_escape($db, $labtest['price']) . "',";
  $sql .= "'" . db_escape($db, $labtest['test_include']) . "',";
  $sql .= "'" . db_escape($db, $labtest['test_name']) . "',";
  $sql .= "'" . db_escape($db, $labtest['about']) . "',";
  $sql .= "'" . db_escape($db, $labtest['gender']) . "',";
  $sql .= "'" . db_escape($db, $labtest['age_group']) . "',";
  $sql .= "'" . db_escape($db, $labtest['sample']) . "',";
  $sql .= "'" . db_escape($db, $labtest['filename']) . "'";
  $sql .= ")";
  if (labtest_by_name($labtest) == false) {
    $result = mysqli_query($db, $sql);
    if ($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  } else {
    redirect_to("labtest-add-exec.php");
  }
}

function labtest_by_name($labtest)
{
  global $db;
  $sql = "SELECT * FROM labtest WHERE name='" . db_escape($db, $labtest['name']) . "'";
  // $sql.=" AND filename='" . db_escape($db, $product['filename']) . "'";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  if (mysqli_num_rows($result) > 0) {
    return true;
  } else {
    return false;
  }
}


function speciality_add($speciality)
{
  global $db;
  $sql = "INSERT INTO speciality_doctors(name,description,includes,filename)";
  $sql .= "VALUES(";
  $sql .= "'" . db_escape($db, $speciality['name']) . "',";
  $sql .= "'" . db_escape($db, $speciality['description']) . "',";
  $sql .= "'" . db_escape($db, $speciality['includes']) . "',";
  $sql .= "'" . db_escape($db, $speciality['filename']) . "'";
  $sql .= ")";
  if (speciality_by_name($speciality) == false) {
    $result = mysqli_query($db, $sql);
    if ($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  } else {
    redirect_to("speciality-add-exec.php");
  }
}

function speciality_by_name($speciality)
{
  global $db;
  $sql = "SELECT * FROM speciality_doctors WHERE name='" . db_escape($db, $speciality['name']) . "'";
  // $sql.=" AND filename='" . db_escape($db, $product['filename']) . "'";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  if (mysqli_num_rows($result) > 0) {
    return true;
  } else {
    return false;
  }
}


function product_select_by_id($id)
{
  global $db;
  $sql = "SELECT * FROM product ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "'";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  confirm_result_set($result);
  $row = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $row;
}

function is_pre_required($product_id)
{
  $product = product_select_by_id($product_id);
  if ($product['prescription'] == "Yes") {
    return true;
  } else {
    return false;
  }
}

function product_delete($id)
{
  global $db;
  $sql = "DELETE FROM product ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "'";
  $result = mysqli_query($db, $sql);
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function report_delete($id)
{
  global $db;
  $sql = "DELETE FROM report ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "'";
  $result = mysqli_query($db, $sql);
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function labtest_delete($id)
{
  global $db;
  $sql = "DELETE FROM labtest ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "'";
  $result = mysqli_query($db, $sql);
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function speciality_delete($id)
{
  global $db;
  $sql = "DELETE FROM speciality_doctors ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "'";
  $result = mysqli_query($db, $sql);
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function doctor_delete($id)
{
  global $db;
  $sql = "DELETE FROM doctors ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "'";
  $result = mysqli_query($db, $sql);
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function product_select_all($category_id = false, $sub_id = false, $detail_id = false, $brand_id = false, $filter = false, $for_public = false)
{
  global $db;
  $sql = "SELECT product.id,product.name,product.ban,product.prescription,product.medicine_type,product.price,product.expire_date,";
  $sql .= "product.description,product.prescription,product.category_id,";
  $sql .= "category.name as category_name,product.sub_category_id,product.discount,product.available,";
  $sql .= "sub_category.name as sub_category_name,product.brand_id,brand.name as brand_name,product.filename ";
  $sql .= "FROM product,category,sub_category,brand ";
  $sql .= " where product.category_id =category.id ";
  $sql .= " AND product.brand_id=brand.id";
  if ($for_public == true) {
    $sql .= " AND product.available = '0'";  //Available only for public
  }
  $sql .= " AND product.sub_category_id=sub_category.id";
  if (is_array($category_id) && (count($category_id) > 0)) {
    $sql .= " AND product.category_id IN(" . implode(",", $category_id) . ")";
  }
  if (is_array($sub_id) && (count($sub_id) > 0)) {
    $sql .= " AND product.sub_category_id IN(" . implode(",", $sub_id) . ")";
  }
  if (is_array($detail_id) && (count($detail_id) > 0)) {
    $sql .= " AND product.sub_sub_category_id IN(" . implode(",", $detail_id) . ")";
  }
  if (is_array($brand_id) && (count($brand_id) > 0)) {
    $sql .= " AND product.brand_id IN(" . implode(",", $brand_id) . ")";
  }
  if ($filter) {
    $sql .= " ORDER by product.price " . $filter;
  }
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  confirm_result_set($result, $sql);
  return $result;
}

function product_brand_select_all($show_brand_id = false, $filter = false, $for_public = false)
{
  global $db;
  $sql = "SELECT product.id,product.name,product.prescription,product.ban,product.medicine_type,product.price,product.expire_date,";
  $sql .= "product.description,product.prescription,product.category_id,product.sub_sub_category_id,sub_sub_category.id,";
  $sql .= "category.name as category_name,product.sub_category_id,product.discount,product.available,";
  $sql .= "sub_category.name as sub_category_name,product.brand_id,brand.name as brand_name,product.filename ";
  $sql .= "FROM product,category,sub_category,brand,sub_sub_category ";
  $sql .= " where product.category_id =category.id ";
  $sql .= " AND product.sub_category_id =sub_category.id ";
  $sql .= " AND product.sub_sub_category_id =sub_sub_category.id ";
  $sql .= " AND product.brand_id = brand.id ";
  if (is_array($show_brand_id) && (count($show_brand_id) > 0)) {
    $sql .= " AND product.brand_id IN(" . implode(",", $show_brand_id) . ")";
  }
  if ($for_public == true) {
    $sql .= " AND product.available = '0'";  //Available only for public
  }
  if ($filter) {
    $sql .= " ORDER by product.price " . $filter;
  }
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  confirm_result_set($result, $sql);
  return $result;
}

function doctor_select_all($id = false)
{
  global $db;
  $sql = "SELECT doctors.id,doctors.name,doctors.speciality_id,speciality_doctors.name as speciality_name";
  $sql .= ",doctors.pay_price,doctors.education,doctors.awards,doctors.field_of_expertise,doctors.experience,doctors.filename,doctors.working_as,doctors.currently_working_in";
  $sql .= " FROM doctors,speciality_doctors ";
  $sql .= " where doctors.speciality_id=speciality_doctors.id ";
  // echo $sql; exit;
  if ($id == true) {
    $sql .= " AND doctors.id=$id";
  }
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  confirm_result_set($result);
  return $result;
}

function labtest_select_all()
{
  global $db;
  $sql = "SELECT * from labtest";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  confirm_result_set($result);
  return $result;
}

function lab_report_by_cid($cid)
{
  global $db;
  $sql = "SELECT * FROM lab_report ";
  $sql .= "WHERE customer_id='" . db_escape($db, $cid) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $row = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $row;
}

function order_by_cid($cid)
{
  global $db;
  $sql = "SELECT * FROM order_details ";
  $sql .= "WHERE customer_id='" . db_escape($db, $cid) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $row = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $row;
}
function show_customer_appoinment($customer_id)
{
  global $db;
  $sql = "SELECT appoinment.id,appoinment.doctors_id,appoinment.customer_id,appoinment.slot_id,";
  $sql .= "appoinment.google_id,appoinment.date,doctors.id,doctors.name as doctors_name,doctors.speciality_id,doctors.pay_price,";
  $sql .= "doctors.education,doctors.experience,doctors.filename,speciality_doctors.id,speciality_doctors.name as speciality_name,";
  $sql .= "time_slot.id,time_slot.from_time as from_time,time_slot.to_time as to_time,appoinment.remarks";
  $sql .= " from appoinment,doctors,speciality_doctors,time_slot";
  $sql .= " where appoinment.doctors_id=doctors.id";
  $sql .= " AND appoinment.slot_id=time_slot.id";
  $sql .= " AND doctors.speciality_id=speciality_doctors.id";
  $sql .= " AND appoinment.customer_id=$customer_id";
  $result = mysqli_query($db, $sql);
  //echo $sql;exit;
  confirm_result_set($result);
  return $result;
}

// brand
function brand_select_by_id($id)
{
  global $db;
  $sql = "SELECT * FROM brand ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $row = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $row;
}

function get_brand_id_by_detail_id($filter_detail_id)
{
  global $db;
  $sql = "SELECT DISTINCT(brand_id) FROM product ";
  $sql .= "WHERE sub_sub_category_id IN(" . implode(",", $filter_detail_id) . ")";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $brand = [];
  while ($row = mysqli_fetch_assoc($result)) {
    array_push($brand, $row['brand_id']);
  }
  return $brand;
}

function report_select_by_id($id)
{
  global $db;
  $sql = "SELECT * FROM lab_report ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "'";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  confirm_result_set($result);
  $row = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $row;
}


function googlemeet_select_by_id($id)
{
  global $db;
  $sql = "SELECT * FROM appoinment ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $row = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $row;
}

function labtest_select_by_id($id)
{
  global $db;
  $sql = "SELECT * FROM labtest ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $row = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $row;
}




function doctor_select_by_id($id)
{
  global $db;
  $sql = "SELECT * FROM doctors ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $row = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $row;
}

function speciality_select_by_id($id)
{
  global $db;
  $sql = "SELECT * FROM speciality_doctors ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $row = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $row;
}

function brand_update($brand)
{
  global $db;
  $sql = "UPDATE brand set name = ";
  $sql .= " '" . db_escape($db, $brand['name']) . "',";
  $sql .= "filename= '" . db_escape($db, $brand['filename']) . "'";
  $sql .= " WHERE id = ";
  $sql .= "'" . db_escape($db, $brand['id']) . "'";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function meet_update($meet)
{
  global $db;
  $sql = "UPDATE appoinment set google_id = ";
  $sql .= " '" . db_escape($db, $meet['googlemeet']) . "'";
  $sql .= " WHERE id = ";
  $sql .= "'" . db_escape($db, $meet['id']) . "'";
  $result = mysqli_query($db, $sql);
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function timeslot_update($timeslot)
{
  global $db;
  $sql = "UPDATE time_slot set ";
  $sql .= "from_time= '" . db_escape($db, $timeslot['from']) . "',";
  $sql .= "to_time= '" . db_escape($db, $timeslot['to']) . "',";
  $sql .= "doctor_id= '" . db_escape($db, $timeslot['doctor_id']) . "'";
  $sql .= " WHERE id = ";
  $sql .= "'" . db_escape($db, $timeslot['id']) . "'";
  $result = mysqli_query($db, $sql);
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function brand_add($brand)
{
  global $db;
  $sql = "INSERT INTO brand(name,filename)";
  $sql .= "Values(";
  $sql .= "'" . db_escape($db, $brand['name']) . "',";
  $sql .= "'" . db_escape($db, $brand['filename']) . "'";
  $sql .= ")";
  $result = mysqli_query($db, $sql);
  if (brand_by_name($brand) == false) {
    $result = mysqli_query($db, $sql);
    if ($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  } else {
    redirect_to("brand-add-exec.php");
  }
}

function brand_by_name($brand)
{
  global $db;
  $sql = "SELECT * FROM brand WHERE name='" . db_escape($db, $brand['name']) . "'";
  // $sql.=" AND contact='" . db_escape($db, $customer['contact']) . "'";
  $result = mysqli_query($db, $sql);
  if (mysqli_num_rows($result) > 0) {
    return true;
  } else {
    return false;
  }
}




function timeslot_add($timeslot)
{
  global $db;
  $sql = "INSERT INTO time_slot(from_time,to_time,doctor_id)";
  $sql .= "Values(";
  $sql .= "'" . db_escape($db, $timeslot['from']) . "',";
  $sql .= "'" . db_escape($db, $timeslot['to']) . "',";
  $sql .= "'" . db_escape($db, $timeslot['doctor_id']) . "'";
  $sql .= ")";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function brand_delete($id)
{
  global $db;
  $sql = "DELETE FROM brand ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "'";
  $result = mysqli_query($db, $sql);
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function timeslot_delete($id)
{
  global $db;
  $sql = "DELETE FROM time_slot ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "'";
  $result = mysqli_query($db, $sql);
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function brand_select_all()
{
  global $db;
  $sql = "SELECT * FROM brand";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function select_order_detail($order)
{
  global $db;
  $sql = "SELECT * FROM order_detail where id='" . db_escape($db, $order) . "'";;
  $result = mysqli_query($db, $sql);
  echo $sql;
  exit;
  confirm_result_set($result);
  $row = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $row;
}

function timeslot_select_all($doctor_id)
{
  global $db;
  $sql = "SELECT * FROM time_slot";
  $sql .= " WHERE doctor_id='" . db_escape($db, $doctor_id) . "'";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  confirm_result_set($result);

  return $result;
}

function appoinment_by_id($id)
{
  global $db;
  $sql = "SELECT * FROM appoinment ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $row = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $row;
}

function appoinment_by_cid($cid)
{
  global $db;
  $sql = "SELECT * FROM appoinment ";
  $sql .= "WHERE customer_id='" . db_escape($db, $cid) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $row = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $row;
}

function timeslot_by_doctorid($doctorid)
{
  global $db;
  $sql = "SELECT * FROM time_slot ";
  $sql .= "WHERE doctor_id='" . db_escape($db, $doctorid) . "'";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  confirm_result_set($result);
  return $result;
}

function appoinment_select_all($doctor_id = false)
{
  global $db;
  $sql = "SELECT appoinment.id as appoinment_id,appoinment.doctors_id,appoinment.slot_id,appoinment.remarks,";
  $sql .= "doctors.name,doctors.id,time_slot.id,time_slot.from_time,time_slot.to_time,appoinment.google_id,appoinment.customer_id,customer.id";
  $sql .= " FROM appoinment,doctors,time_slot,customer";
  $sql .= " where appoinment.doctors_id=doctors.id";
  $sql .= " AND time_slot.id=appoinment.slot_id";
  $sql .= " AND appoinment.customer_id=customer.id";
  if ($doctor_id == true) {
    $sql .= " AND appoinment.doctors_id=$doctor_id";
  }
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  confirm_result_set($result);
  return $result;
}

function speciality_select_all()
{
  global $db;
  $sql = "SELECT * FROM speciality_doctors";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}




// customer
function customer_select_by_id($id)
{
  global $db;
  $sql = "SELECT * FROM customer ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $row = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $row;
}

function customer_select_by_contact($contact)
{
  global $db;
  $sql = "SELECT * FROM customer ";
  $sql .= "WHERE contact='" . db_escape($db, $contact) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  // echo $sql;exit;
  $row = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $row;
}

function get_address_of_customer($customer)
{
  global $db;
  $sql = "SELECT customer.country_id,customer_address.state_id,customer_address.city,";
  $sql .= "country.id,state.id,city.id, ";
  $sql .= " CONCAT(houseno,',',roadname,',',near_place,',',country.name,',',state.name,',',city.name,',',pincode) as address ";
  $sql .= " FROM customer,customer_address,country,state,city ";
  $sql .= " WHERE customer_address.id='" . db_escape($db, $customer) . "' ";
  $sql .= " AND customer.country_id=country.id";
  $sql .= " AND customer_address.state_id=state.id";
  $sql .= " AND customer_address.city=city.id";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  confirm_result_set($result);
  $row = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $row;
}

function customer_select_all()
{
  global $db;
  $sql = "SELECT * FROM customer";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function customer_add($customer)
{
  global $db;
  $new_password = password_hash($customer['password'], PASSWORD_BCRYPT);
  $sql = "INSERT INTO customer(first_name,last_name,email,password,hpassword,contact,country_id)";
  $sql .= "Values(";
  $sql .= "'" . db_escape($db, $customer['first_name']) . "',";
  $sql .= "'" . db_escape($db, $customer['last_name']) . "',";
  $sql .= "'" . db_escape($db, $customer['email']) . "',";
  $sql .= "'" . db_escape($db, $customer['password']) . "',";
  $sql .= "'" . db_escape($db, $new_password) . "',";
  $sql .= "'" . db_escape($db, $customer['contact']) . "',";
  $sql .= "'" . db_escape($db, $customer['country_id']) . "'";
  // $sql .= "'" . db_escape($db, $customer['verify_key']) . "',";
  // $sql .= "'" . db_escape($db, $customer['expDate']) . "'";
  $sql .= ")";
  if (customer_by_email($customer['email']) == false) {
    $result = mysqli_query($db, $sql);
    if ($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  } else {
    redirect_to("register-exec.php");
  }
}

function customer_by_email($email)
{
  global $db;
  $sql = "SELECT * FROM customer WHERE email='" . db_escape($db, $email) . "'";
  // $sql.=" AND contact='" . db_escape($db, $customer['contact']) . "'";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  if (mysqli_num_rows($result) > 0) {
    return true;
  } else {
    return false;
  }
}


function customer_update($customer)
{
  global $db;
  $sql = "UPDATE customer set first_name = ";
  $sql .= " '" . db_escape($db, $customer['first_name']) . "',";
  $sql .= "last_name= '" . db_escape($db, $customer['last_name']) . "',";
  $sql .= "contact= '" . db_escape($db, $customer['contact']) . "',c";
  $sql .= "country_id= '" . db_escape($db, $customer['country_id']) . "'";
  $sql .= " WHERE id = ";
  $sql .= "'" . db_escape($db, $customer['id']) . "'";
  $result = mysqli_query($db, $sql);
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

//  find customer 
function find_customer($email)
{
  global $db;

  $sql = "SELECT * FROM customer ";
  $sql .= "WHERE email='" . db_escape($db, $email) . "' ";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  // echo $sql;exit;
  $customer = mysqli_fetch_assoc($result); // find first
  mysqli_free_result($result);
  return $customer; // returns an assoc. array
}


function get_cart_by_cid($cid)
{
  global $db;

  $sql = "SELECT * FROM cart ";
  $sql .= "WHERE customer_id='" . db_escape($db, $cid) . "' ";
  $result = mysqli_query($db, $sql);

  //echo $sql; exit; 
  confirm_result_set($result);
  return $result;
}

function show_details_in_cart($customer_id)
{
  global $db;
  $result_array = array();
  $result1 = get_cart_by_product_type($customer_id, "medicines");
  while ($row = mysqli_fetch_assoc($result1)) {
    $result_array[] = $row;
  }
  $result2 = get_cart_by_product_type($customer_id, "labtest");
  while ($row = mysqli_fetch_assoc($result2)) {
    $result_array[] = $row;
  }
  return $result_array;
}

function generate_id($table_name = "order_details", $col_name = "order_no", $length = 6)
{
  global $db;
  $new_id = substr(str_shuffle(str_repeat($x = '0123456789', ceil($length / strlen($x)))), 1, $length);
  $query = "SELECT * FROM {$table_name} WHERE {$col_name} = '$new_id'";
  $result = mysqli_query($db, $query);
  confirm_result_set($result);
  if (mysqli_num_rows($result) > 0) {
    generate_id($table_name);
  } else {
    return $new_id;
  }

  return $new_id;
}

function get_cart_by_product_type($customer_id, $product_type)
{
  global $db;
  if ($product_type == "labtest") {
    $sql = "SELECT cart.id, cart.customer_id,cart.product_id, cart.quantity,cart.product_type, ";
    $sql .= " (cart.quantity*labtest.price) as amount ,labtest.price,labtest.filename, 'labtest' as dir,";
    $sql .= " labtest.name, labtest.discount as discount,'0' as prescription FROM cart,customer,labtest ";
    $sql .= " WHERE cart.customer_id='" . db_escape($db, $customer_id) . "'";
    $sql .= " AND cart.product_id=labtest.id";
    $sql .= " AND cart.customer_id = customer.id";
    $sql .= " AND cart.product_type = 'labtest'";
  } else if ($product_type == "medicines") {
    $sql = "SELECT cart.id, cart.customer_id,cart.product_id,cart.quantity,cart.product_type,";
    $sql .= " (cart.quantity*product.price) as amount ,product.prescription,product.price,product.filename, 'files' as dir, ";
    $sql .= " product.name, product.discount as discount,product.prescription from cart,customer,product ";
    $sql .= " WHERE cart.customer_id='" . db_escape($db, $customer_id) . "'";
    $sql .= " AND cart.product_id=product.id";
    $sql .= " AND cart.customer_id = customer.id";
    $sql .= " AND cart.product_type = 'medicines'";
  }


  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  confirm_result_set($result);
  return $result;
}

function calculate_discount($customer_id)
{
  global $db;
  $query = "SELECT round(sum(product.discount*(cart.quantity*product.price)/100),2) as ";
  $query .= " discount FROM `cart`, product WHERE cart.product_id = product.id ";
  $query .= " AND customer_id = '" . db_escape($db, $customer_id) . "'";
  $query .= " AND cart.product_type = '" . db_escape($db, 'medicines') . "'";
  $query .= " UNION ";
  $query .= "SELECT round(sum(labtest.discount*(cart.quantity*labtest.price)/100),2) as ";
  $query .= " discount FROM `cart`, labtest WHERE cart.product_id = labtest.id ";
  $query .= " AND customer_id = '" . db_escape($db, $customer_id) . "'";
  $query .= " AND cart.product_type = '" . db_escape($db, 'labtest') . "'";
  $result = mysqli_query($db, $query);
  confirm_result_set($result);
  $discount = 0;
  while ($row = mysqli_fetch_assoc($result)) {
    $discount += $row['discount'];
  }
  return $discount;
}

function card_by_cid_pid($cid, $pid)
{
  global $db;
  $sql = "SELECT * from cart where customer_id=$cid ";
  $sql = "AND product_id=$pid";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function cart_delete_by_id($cartid)
{
  global $db;
  $sql = "DELETE FROM cart ";
  $sql .= "WHERE id='" . db_escape($db, $cartid) . "'";
  $result = mysqli_query($db, $sql);
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}


//  country
function country_add($country)
{
  global $db;
  $query = "INSERT INTO country(name)";
  $query .= "Values(";
  $query .= "'" . $country['name'] . "'";
  $query .= ")";
  if (country_by_name($country) == false) {
    $result = mysqli_query($db, $query);
    if ($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  } else {
    redirect_to("country-add-exec.php");
  }
}

function country_by_name($country)
{
  global $db;
  $sql = "SELECT * FROM country WHERE name='" . db_escape($db, $country['name']) . "'";
  // $sql.=" AND filename='" . db_escape($db, $product['filename']) . "'";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  if (mysqli_num_rows($result) > 0) {
    return true;
  } else {
    return false;
  }
}

function country_select()
{
  global $db;
  $query = "SELECT * from country";
  $result = mysqli_query($db, $query);
  return $result;
}

function country_select_id($id)
{
  global $db;
  $query = "SELECT * FROM country WHERE id='" . $id . "'";
  $result = mysqli_query($db, $query);
  $row = mysqli_fetch_array($result);
  // echo $query;exit;
  return $row;
}

function country_update($country)
{
  global $db;
  $query = "UPDATE country set name='" . $country['name'] . "'";
  $query .= "WHERE id='" . $country['id'] . "'";
  $result = mysqli_query($db, $query);
  if ($result == true) {
    return true;
  } else {
    return false;
  }
}

function country_delete($id)
{
  global $db;
  $query = "DELETE from city where state_id in (";
  $query .= " SELECT id from state where country_id = '" . $id . "'";
  $query .= ")";
  $result = mysqli_query($db, $query); //district deleted
  if ($result == true) {
    $query = "DELETE from state where country_id =  '" . $id . "'";
    $result = mysqli_query($db, $query); //states deleted
    if ($result == true) {
      $query = "DELETE from country where id =  '" . $id . "'";
      $result = mysqli_query($db, $query);   //country deleted
      if ($result == true) {
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  } else {
    return false;
  }
}

// state
function state_add($state)
{
  global $db;
  $query = "INSERT INTO state(name,country_id)";
  $query .= "Values(";
  $query .= "'" . $state['name'] . "',";
  $query .= "'" . $state['country_id'] . "'";
  $query .= ")";
  if (state_by_name($state) == false) {
    $result = mysqli_query($db, $query);
    if ($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  } else {
    redirect_to("state-add-exec.php");
  }
}

function state_by_name($state)
{
  global $db;
  $sql = "SELECT * FROM state WHERE name='" . db_escape($db, $state['name']) . "'";
  // $sql.=" AND filename='" . db_escape($db, $product['filename']) . "'";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  if (mysqli_num_rows($result) > 0) {
    return true;
  } else {
    return false;
  }
}


function state_select()
{
  global $db;
  $query = "SELECT state.id,state.name,state.country_id,country.name as country_name";
  $query .= " from state,country ";
  $query .= " WHERE state.country_id=country.id";
  $result = mysqli_query($db, $query);
  return $result;
}

function state_delete($id)
{
  global $db;
  $query = " DELETE from city where state_id = '" . $id . "'";
  $result = mysqli_query($db, $query);
  if ($result == true) {
    $query = "DELETE from state where id='" . $id . "'";
    $result = mysqli_query($db, $query);
    if ($result == true) {
      return true;
    } else {
      return false;
    }
  } else {
    return false;
  }
}

// city
function city_add($city)
{
  global $db;
  $query = "INSERT INTO city(name,state_id)";
  $query .= "Values(";
  $query .= "'" . $city['name'] . "',";
  $query .= "'" . $city['state_id'] . "'";
  $query .= ")";
  if (city_by_name($city) == false) {
    $result = mysqli_query($db, $query);
    if ($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  } else {
    redirect_to("city-add-exec.php");
  }
}

function city_by_name($city)
{
  global $db;
  $sql = "SELECT * FROM city WHERE name='" . db_escape($db, $city['name']) . "'";
  // $sql.=" AND filename='" . db_escape($db, $product['filename']) . "'";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  if (mysqli_num_rows($result) > 0) {
    return true;
  } else {
    return false;
  }
}


function city_select()
{
  global $db;
  $query = "SELECT city.id,city.name,state.country_id,country.name as country_name,city.state_id,state.name as state_name";
  $query .= " from state,country,city ";
  $query .= " WHERE city.state_id=state.id";
  $query .= " AND state.country_id=country.id";
  $result = mysqli_query($db, $query);
  // echo $query;exit;
  return $result;
}

function city_delete($id)
{
  global $db;
  $query = "DELETE from city where id='" . $id . "'";
  $result = mysqli_query($db, $query);
  if ($result == true) {
    return true;
  } else {
    return false;
  }
}

function state_by_country_id($country_id)
{
  global $db;
  $query = "SELECT * from state";
  $query .= " WHERE country_id ='" . $country_id . "'";
  $result = mysqli_query($db, $query);
  // echo $query; exit;
  return $result;
}

// address
function address_update($address)
{
  global $db;
  $sql = "UPDATE address set houseno = ";
  $sql .= " '" . db_escape($db, $address['houseno']) . "',";
  $sql .= "roadname= '" . db_escape($db, $address['roadname']) . "',";
  // $sql .= "country_id= '" . db_escape($db, $address['country_id']) . "',";
  $sql .= "state-id= '" . db_escape($db, $address['state_id']) . "',";
  $sql .= "city_id= '" . db_escape($db, $address['city_id']) . "'";
  $sql .= "pincode= '" . db_escape($db, $address['pincode']) . "'";
  $sql .= "near_place= '" . db_escape($db, $address['near_place']) . "'";
  $sql .= " WHERE id = ";
  $sql .= "'" . db_escape($db, $address['id']) . "'";
  $result = mysqli_query($db, $sql);
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function address_select_by_id($id)
{
  global $db;
  $sql = "SELECT * FROM customer_address ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $row = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $row;
}


function address_add($address)
{
  global $db;
  $sql = "INSERT INTO customer_address(customer_id,houseno,roadname,state_id,city,pincode,near_place)";
  $sql .= "Values(";
  $sql .= "'" . db_escape($db, $address['customer_id']) . "',";
  $sql .= "'" . db_escape($db, $address['houseno']) . "',";
  $sql .= "'" . db_escape($db, $address['roadname']) . "',";
  // $sql .= "'" . db_escape($db, $address['country_id']) . "',";
  $sql .= "'" . db_escape($db, $address['state_id']) . "',";
  $sql .= "'" . db_escape($db, $address['city_id']) . "',";
  $sql .= "'" . db_escape($db, $address['pincode']) . "',";
  $sql .= "'" . db_escape($db, $address['near_place']) . "'";
  $sql .= ")";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function city_by_state_id($state_id)
{
  global $db;
  $query = "SELECT * from city";
  $query .= " WHERE state_id ='" . $state_id . "'";
  $result = mysqli_query($db, $query);
  return $result;
}

function address_by_cid($id)
{
  global $db;
  $sql = "SELECT customer_address.id as address_id,customer_address.customer_id,customer_address.houseno,customer_address.roadname,customer.country_id,country.id,country.name as country_name,";
  $sql .= "customer.id,customer_address.state_id,state.id,state.name as state_name,customer_address.city,city.id,city.name as city_name,";
  $sql .= "customer_address.pincode,customer_address.near_place";
  $sql .= " FROM customer_address,country,state,city,customer";
  $sql .= " where customer_id= $id";
  $sql .= " AND customer.country_id=country.id";
  $sql .= " AND customer_address.state_id=state.id";
  $sql .= " AND customer_address.city=city.id";
  $sql .= " AND customer_address.customer_id=customer.id";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  confirm_result_set($result);
  return $result;
}


function cart_total_by_customer($customer_id)
{
  global $db;
  $sql = "SELECT sum(cart.quantity*product.price) as total FROM cart,product ";
  $sql .= "WHERE cart.product_id=product.id AND customer_id='$customer_id'";
  $sql .= " AND cart.product_type='medicines'";
  $sql .= " UNION SELECT sum(cart.quantity*labtest.price) as total FROM cart,labtest ";
  $sql .= " WHERE cart.product_id=labtest.id AND customer_id='$customer_id' AND cart.product_type='labtest'";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  $total = 0;
  while ($row = mysqli_fetch_assoc($result)) {
    $total += $row['total'];
  }
  return $total;
}

function cart_total_in_placed_order($order_id)
{
  global $db;
  $sql = "SELECT  order_details.order_no,order_details.order_date,order_product.order_id,order_product.payment_mode";
  $sql .= " FROM order_product,order_details ";
  $sql .= "WHERE order_details.order_no='" . db_escape($db, $order_id) . "'";
  $sql .= " AND order_product.order_id=order_details.order_no";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  $row = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $row;
}


function cart_update_by_id($cart_id, $qty)
{
  global $db;
  $query = "UPDATE cart set quantity = '" . db_escape($db, $qty) . "'";
  $query .= " WHERE id='" . db_escape($db, $cart_id) . "'";
  $result = mysqli_query($db, $query);
  if ($result) {
    return true;
  } else {
    return false;
  }
}

function set_default_address($address_id, $customer_id)
{
  global $db;
  $query = "UPDATE customer set default_address_id = '" . db_escape($db, $address_id) . "'";
  $query .= " WHERE id='" . db_escape($db, $customer_id) . "'";
  $result = mysqli_query($db, $query);
  if ($result) {
    return true;
  } else {
    return false;
  }
}

function order_detail($order)
{
  global $db;
  $sql = "INSERT INTO order_details(order_no,customer_id,customer_name,customer_contact,address)";
  $sql .= "Values(";
  $sql .= "'" . db_escape($db, $order['order_no']) . "',";
  $sql .= "'" . db_escape($db, $order['customer_id']) . "',";
  $sql .= "'" . db_escape($db, $order['customer_name']) . "',";
  $sql .= "'" . db_escape($db, $order['customer_contact']) . "',";
  $sql .= "'" . db_escape($db, $order['address']) . "'";
  $sql .= ")";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function order_product($order_detail)
{
  global $db;
  $flag = false;
  $sql = "";
  if ($order_detail['product_type'] == "medicines") {

    if (is_pre_required($order_detail['product_id'])) {
      //$order_detail['filename']=$order_detail['filename'];
      $sql = "INSERT INTO order_product(order_id,product_id,product_name,product_type,quantity,price,discount,filename,payment_mode)";
      $flag = true;
    } else {
      $sql = "INSERT INTO order_product(order_id,product_id,product_name,product_type,quantity,price,discount,payment_mode)";
      $flag = false;
      //$order_detail['filename']="NA";
    }
  } else {
    $sql = "INSERT INTO order_product(order_id,product_id,product_name,product_type,quantity,price,discount,payment_mode)";
    $flag = false;
    //$order_detail['filename']="NA";
  }


  $sql .= "Values(";
  $sql .= "'" . db_escape($db, $order_detail['order_id']) . "',";
  $sql .= "'" . db_escape($db, $order_detail['product_id']) . "',";
  $sql .= "'" . db_escape($db, $order_detail['product_name']) . "',";
  $sql .= "'" . db_escape($db, $order_detail['product_type']) . "',";
  $sql .= "'" . db_escape($db, $order_detail['quantity']) . "',";
  $sql .= "'" . db_escape($db, $order_detail['price']) . "',";
  $sql .= "'" . db_escape($db, $order_detail['discount']) . "',";
  if ($flag == true) {
    $sql .= "'" . db_escape($db, $order_detail['filename']) . "',";
  }

  $sql .= "'" . db_escape($db, $order_detail['payment_mode']) . "'";

  $sql .= ")";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db) . $sql;
    db_disconnect($db);
    exit;
  }
}

function insert_report($report)
{
  global $db;
  $sql = "INSERT INTO lab_report(order_no,customer_id,product_name,order_date)";
  $sql .= "Values(";
  $sql .= "'" . db_escape($db, $report['order_no']) . "',";
  $sql .= "'" . db_escape($db, $report['customer_id']) . "',";
  $sql .= "'" . db_escape($db, $report['product_name']) . "',";
  $sql .= "'" . db_escape($db, $report['order_date']) . "'";
  $sql .= ")";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function delete_cart_by_customer($customer_id)
{
  global $db;
  $query = "DELETE from cart where customer_id='" . $customer_id . "'";
  $result = mysqli_query($db, $query);
  // echo $query;exit;
  if ($result == true) {
    return true;
  } else {
    return false;
  }
}

function doctor_by_speciality($speciality_id)
{
  global $db;
  $sql = "SELECT * from doctors where speciality_id='" . db_escape($db, $speciality_id) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function appoinment_insert($appoint)
{
  global $db;
  $sql = "INSERT INTO appoinment(doctors_id,customer_id,slot_id,remarks,google_id)";
  $sql .= "VALUES(";
  $sql .= "'" . db_escape($db, $appoint['doctor_id']) . "',";
  $sql .= "'" . db_escape($db, $appoint['customer_id']) . "',";
  $sql .= "'" . db_escape($db, $appoint['date']) . "',";
  $sql .= "'" . db_escape($db, 'Will be Updated after the consultation') . "',";
  $sql .= "'" . db_escape($db, 'Will be Update soon') . "'";
  $sql .= ")";
  $result = mysqli_query($db, $sql);
  //echo $sql;exit;
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function app_del($id)
{
  global $db;

  $sql = "DELETE FROM appoinment  ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;

  // For DELETE statements, $result is true/false
  if ($result) {
    return true;
  } else {
    // DELETE failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function change_status($appoint)
{
  global $db;
  $query = "UPDATE time_slot set status= !status WHERE id='" . $appoint['date'] . "'";
  $result = mysqli_query($db, $query);
  if ($result == true) {
    return true;
  } else {
    return false;
  }
}

function change_status_manually($id)
{
  global $db;
  $query = "UPDATE time_slot set status= !status WHERE id='" . $id . "'";
  $result = mysqli_query($db, $query);
  if ($result == true) {
    return true;
  } else {
    return false;
  }
}

function change_status_alltimeslot()
{
  global $db;
  $query = "UPDATE time_slot set status= '0'";
  $result = mysqli_query($db, $query);
  if ($result == true) {
    return true;
  } else {
    return false;
  }
}

function status_update($status)
{
  global $db;
  $sql = "UPDATE order_details set status = ";
  $sql .= " '" . db_escape($db, $status['status_id']) . "'";
  $sql .= " WHERE id = ";
  $sql .= "'" . db_escape($db, $status['order_id']) . "'";
  $result = mysqli_query($db, $sql);

  // echo $sql;exit;
  if ($result == true) {
    return true;
  } else {
    return false;
  }
}

function return_reason($return)
{
  global $db;
  $sql = "UPDATE order_details set status = ";
  $sql .= " '" . db_escape($db, $return['cancel_id']) . "',";
  $sql .= "return_reason= '" . db_escape($db, $return['return_reason']) . "'";
  $sql .= " WHERE id = ";
  $sql .= "'" . db_escape($db, $return['order_id']) . "'";
  $result = mysqli_query($db, $sql);

  // echo $sql;exit;
  if ($result == true) {
    return true;
  } else {
    return false;
  }
}


function availablity($id)
{
  global $db;
  $sql = "UPDATE product set available= NOT available WHERE id='" . $id . "'";
  $result = mysqli_query($db, $sql);
  if ($result == true) {
    return true;
  } else {
    return false;
  }
}

function timeslot_select_by_id($id)
{
  global $db;
  $query = "SELECT * from time_slot";
  $query .= " WHERE id ='" . $id . "'";
  $result = mysqli_query($db, $query);
  return $result;
}

function pricefilter($pricefilter)
{
  global $db;
  $sql = "SELECT * FROM product ORDER BY price $pricefilter";
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $row;
}

// cancel order
function time_diff($order_id)
{
  global $db;
  $sql = "SELECT TIMESTAMPDIFF(HOUR, order_date, now()) as hours FROM order_details ";
  $sql .= " WHERE id = '" . db_escape($db, $order_id) . "'";
  // echo $sql; exit;
  $result = mysqli_query($db, $sql);
  if ($result) {
    $row = mysqli_fetch_assoc($result);

    return $row['hours'];
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}
function can_cancel_order($order_id)
{
  global $db;
  $hours = 0;
  $hours = time_diff($order_id);
  if ($hours <= 24) {
    // echo $hours; exit;
    return true;
  } else {
    return false;
  }
}

function can_return_order($order_id)
{
  global $db;
  $hours = 0;
  $hours = time_diff($order_id);
  if ($hours <= 72) {
    // echo $hours; exit;
    return true;
  } else {
    return false;
  }
}

function my_order($customer_id)
{
  global $db;
  $days = "2";
  $sql = "SELECT *, date_add(order_date, INTERVAL " . $days . " DAY) as sample_date FROM order_details";
  $sql .= " WHERE order_details.customer_id='" . db_escape($db, $customer_id) . "'";
  $sql .= " ORDER by id desc";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}
function order_list($status_id = "1")
{
  global $db;
  $sql = "SELECT * from order_details";
  $sql .= " Where order_details.status='" . db_escape($db, $status_id) . "'";
  $sql .= " ORDER by id desc";
  // echo $sql;exit;
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}
function get_order_status_byID($status_id)
{
  global $db;
  $sql = "SELECT * from order_status where id = '" . db_escape($db, $status_id) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $row = mysqli_fetch_assoc($result);
  return $row;
}

function get_order_status_name($status_id)
{
  $status = get_order_status_byID($status_id);
  return $status['status_name'];
}

function contact_add($contact)
{
  global $db;
  $sql = "INSERT INTO contact(name,phone_number,email,query)";
  $sql .= "VALUES(";
  $sql .= "'" . db_escape($db, $contact['name']) . "', ";
  $sql .= "'" . db_escape($db, $contact['phone']) . "',";
  $sql .= "'" . db_escape($db, $contact['email']) . "',";
  $sql .= "'" . db_escape($db, $contact['query']) . "'";
  $sql .= ")";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function prescription_add($prescription)
{
  global $db;
  $sql = "INSERT INTO order_product(filename)";
  $sql .= "Values(";
  $sql .= "'" . db_escape($db, $prescription['filename']) . "'";
  $sql .= ")";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function report_select_by_orderid($order_id)
{
  global $db;
  $sql = " SELECT order_product.product_type,order_details.order_no,order_details.customer_id";
  $sql .= ",order_details.order_date,order_product.order_id,order_product.product_name";
  $sql .= " FROM order_details,order_product";
  $sql .= " where order_details.order_no='" . db_escape($db, $order_id) . "'";
  $sql .= " AND order_product.order_id=order_details.order_no";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  confirm_result_set($result);
  return $result;
}

function order_by_orderno($order_id)
{
  global $db;

  $sql = " SELECT  order_details.id,order_details.customer_name,order_details.order_no,order_details.address,order_details.return_reason,order_product.filename  FROM order_details,order_product ";
  $sql .= " where order_details.order_no='" . db_escape($db, $order_id) . "'";
  $sql .= " AND order_details.order_no=order_product.order_id";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  confirm_result_set($result);
  return mysqli_fetch_assoc($result);
}

function order_product_by_orderno($order_id)
{
  global $db;
  $sql = " SELECT * FROM order_product ";
  $sql .= " where order_id='" . db_escape($db, $order_id) . "'";
  $sql.=" AND status='0'";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  confirm_result_set($result);
  return $result;
}

function order_product_by_orderno_all($order_id)
{
  global $db;
  $sql = " SELECT * FROM order_product ";
  $sql .= " where order_id='" . db_escape($db, $order_id) . "'";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  confirm_result_set($result);
  return $result;
}

function update_status_order_product($order_product)
{
  global $db;
  $sql = "UPDATE order_product set remarks = ";
  $sql .= " '" . db_escape($db, $order_product['reason']) . "'";
  $sql .= " , status = '3'";
  $sql .= " WHERE id = ";
  $sql .= "'" . db_escape($db, $order_product['order_product_id']) . "'";
  // echo $sql; exit;
  $result = mysqli_query($db, $sql);

  // For UPDATE statements, $result is true/false
  if ($result) {
    return true;
  } else {
    // UPDATE failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}




function order_history_add($order_history)
{
  global $db;
  $sql = "INSERT INTO order_history(order_no,current_status_id)";
  $sql .= "Values(";
  $sql .= "'" . db_escape($db, $order_history['order_no']) . "',";
  $sql .= "'" . db_escape($db, $order_history['status_id']) . "'";
  $sql .= ")";
  $result = mysqli_query($db, $sql);
  // echo $sql;exit;
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}



// remarks
function remarks_update($remarks)
{
  global $db;
  $sql = "UPDATE appoinment set remarks = ";
  $sql .= " '" . db_escape($db, $remarks['remarks']) . "'";
  $sql .= " WHERE id = ";
  $sql .= "'" . db_escape($db, $remarks['id']) . "'";
  $result = mysqli_query($db, $sql);
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function change_password_customer($username, $password)
{
  global $db;
  $user = customer_passwordchange_by_email($username);
  if (isset($password['reset_password'])) {
    if ($password['password'] !== $password['confirmpassword']) {
      $errors[] = "confirm password is not matched with new password";
    }
  } else {
    if (!password_verify($password['oldpassword'], $user['hpassword'])) {
      $errors[] = "current password is incorrect" . $password['oldpassword'];
    } else if ($password['password'] !== $password['confirmpassword']) {
      $errors[] = "confirm password is not matched with new password";
    }
    // }



    if (!empty($errors)) {
      return $errors;
      exit;
    } else {
      $new_password = password_hash($password['password'], PASSWORD_BCRYPT);
      $sql = "UPDATE customer set hpassword = ";
      $sql .= " '" . db_escape($db, $new_password) . "',";
      $sql .= "password= '" . db_escape($db, $password['password']) . "'";
      $sql .= " WHERE email = ";
      $sql .= "'" . db_escape($db, $username) . "'";
    }

    $result = mysqli_query($db, $sql);
    //  echo $sql;exit;
    // For UPDATE statements, $result is true/false
    if ($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }
}
function customer_passwordchange_by_email($email)
{
  global $db;
  $sql = "SELECT * FROM customer WHERE email='" . db_escape($db, $email) . "'";
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $row;
}

function price_after_discountproduct($id)
{
  global $db;
  $sql = "SELECT round((sum(product.price*product.discount)/100)) as ";
  $sql .= " discount FROM  product WHERE id='" . db_escape($db, $id) . "'";
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $row;
}

function price_after_discountlabtest($id)
{
  global $db;
  $sql = "SELECT round((sum(labtest.price*labtest.discount)/100)) as ";
  $sql .= " discount FROM  labtest WHERE id='" . db_escape($db, $id) . "'";
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $row;
}

