<?php

session_start(); //start the session

session_unset(); // unsets the data

session_destroy(); //destroys the session

header ('location: index.php');

exit();



?>