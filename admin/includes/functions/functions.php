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

?>