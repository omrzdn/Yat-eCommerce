<?php 
/*
=======================================
== Manage Members Page
== You Can add | edit | delete Members from here 
=======================================
*/

session_start();
 $pageTitle = 'Members';  
if(isset($_SESSION['Username'])){

 

 include 'init.php';
 $do = isset($_GET['do']) ? $_GET['do'] : 'manage';
 //start manage page
 if ($do == 'manage'){
     //manage page

 }elseif($do =='edit'){ //edit page 


// check if get request user id is numeric and get the integer value of it 
   
    $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
 //select all data depending on this id  
    $stmt = $con->prepare("SELECT * FROM users where UserID = ? LIMIT 1");

// excecute query
     $stmt->execute(array($userid));
//fetch data
     $row = $stmt->fetch();
// the row count
     $count = $stmt->rowCount();
// if there is such an id show the form
     if($stmt->rowCount() > 0){
         
    ?>
    <h1 class="text-center">Edit Member</h1>

    <div class="container">
        <form class="form-horizontal">
            <!--start username field -->
            <div class="form-group">
                <label class="col-sm-2 control-label">Username </label>
                <div class="col-sm-10"> 
                <input type="text" name="username" class="form-control" value="<?php echo $row['Username'] ?>" autocomplete="off"/>
                </div>
            </div>
            <!--End Username Field -->
            <!--start Password field -->
            <div class="form-group">
                <label class="col-sm-2 control-label">Password </label>
                <div class="col-sm-10"> 
                <input type="password" name="password" class="form-control" autocomplete="new-password"/>
                </div>
            </div>
            <!--End Passsword Field -->
            <!--start Email field -->
            <div class="form-group">
                <label class="col-sm-2 control-label">Email </label>
                <div class="col-sm-10"> 
                <input type="email" name="email" class="form-control" value="<?php echo $row['Email'] ?>" />
                </div>
            </div>
            <!--End Email Field -->
            <!--start Full Name field -->
            <div class="form-group">
                <label class="col-sm-2 control-label">Full Name </label>
                <div class="col-sm-10"> 
                <input type="text" name="full" value="<?php echo $row['FullName'] ?>" class="form-control" />
                </div>
            </div>
            <!--End Full Name Field -->
            <!--start Submit field -->
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10"> 
                <input type="submit" value="save" class="btn btn-primary" />
                </div>
            </div>
            <!--End Submit Field -->

        </form>
    </div>




<?php

// else show error message

} else {
    echo 'there is no such id';
}

}
 include 'includes/templates/footer.php';

}else{

    header('location:index.php');

    exit();

}



?>