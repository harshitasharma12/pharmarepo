<?php  require_once("includes/initialize.php");
  require_login();
  if(is_post_request()) {

    $news = [];
     $news['title'] = $_POST['title'] ?? '';
     $news['description'] = $_POST['description'] ?? '';
     $news['id'] = $_POST['id'] ?? '';
     $news['action'] = $_POST['action'];

     if($news['id']>=0 && $news['action']==="Update"){
      $result = update_news_by_id($news);
     } else {
      $result = insert_news($news);
       
     }
     
     if($result){
      $_SESSION['message'] = 'News '.$news['action'].' successfully';
      $_SESSION['alert'] = 'success';
      redirect_to("news-list.php");
     }
  } else {

    $news = [];
    //error 

  }
?>