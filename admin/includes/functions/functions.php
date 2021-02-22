<?php 

// Title function that echo the page title if the page
// has the variable $pageTitle 
// and echo default for the other pages
 
function getTitle(){

    global $pageTitle;
    if (isset($pageTitle)){
        echo $pageTitle;
    }else {
        echo 'Default';
    }
}

function redirectHome($theMsg, $url = NULL , $seconds = 3){


    if ($url === NULL) {
  
      $url  = 'index.php';
      $link = 'HomePage';
  
    }else {
  
      if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !=='' ) {
  
        $url  = $_SERVER['HTTP_REFERER'];
        $link = 'previous Page';
      }else {
  
        $url = 'index.php';
      }
  
    }
  
    echo $theMsg;
  
    echo "<div class='alert alert-info'>You will be redirected to $link after $seconds Seconds.</div>";
  
    header("refresh: $seconds;url=$url");
  
    exit();
  
  }

  function checkItem($select, $from, $value){

    global $con;
  
    $statement = $con->prepare("SELECT $select FROM $from WHERE $select = ?");
  
    $statement->execute(array($value));
  
    $count = $statement->rowCount();
  
    return $count;
  }

?>