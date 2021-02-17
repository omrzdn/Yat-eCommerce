<?php 

// $do='';

$do = isset($_GET['do']) ? $_GET['do'] : 'manage';

// if (isset($_GET['do'])) {
//     $do= $_GET['do'];
// } else {
//     $do= 'manage';
// }

//If the page is main page

if ($do == 'manage') {
    echo 'Welcome, you are in the Manage Category Page';
    echo '<a href="page.php?do=add">Add New Category +</a>';

} elseif ($do == 'add') {

    echo 'Welcome You are in add category page';
} else if ($do == 'insert'){

    echo 'Welcome to the Insert Category Page';
} else {
    echo 'Error There is no page with this name';
}



?>