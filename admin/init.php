<?php

//Routes
$tpl = 'includes/templates/';
$css = 'layout/css/';
$js = 'layout/js/';
$lan= 'includes/languages/';
$func = 'includes/functions/';  //functions directory


//important files

 include $func . 'functions.php';
 include $lan.'english.php';
 include 'connect.php';
 include $tpl.'header.php';
  if(!isset($nonavbar)){
    include $tpl.'navbar.php';
 }
