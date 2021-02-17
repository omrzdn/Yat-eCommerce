<?php
   session_start();
   
   if(isset($_SESSION['Username'])){

    $pageTitle = 'Dashboard';

    include 'init.php';
    
     echo"wellcome";
    include 'includes/templates/footer.php';

   }else{

       header('location:index.php');

       exit();

   }