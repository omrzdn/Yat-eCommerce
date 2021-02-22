<?php
    session_start();
    
    $pageTitle = 'Login';
    
   if(isset($_SESSION['Username'])){
    header('location:dashboard.php');
   }
    include 'init.php';

    //Note: I converted the next 2 lines to commented code becuase they are already included in init.php
    
    // include $tpl.'header.php';
    // include 'includes/languages/english.php';

    //check if user name come from http request

     if($_SERVER['REQUEST_METHOD']=='POST'){
        $username=$_POST['username'];
        $password=$_POST['pass'];
        $hash_pass=sha1($password);
        
    //check if the user exist in database and he is admin

     $stmt = $con->prepare("SELECT UserID, Username, Password FROM users where Username = ?  AND Password = ?  AND GroupID = 1 LIMIT 1");
     $stmt->execute(array( $username, $hash_pass));
     $row = $stmt->fetch();

    //num of rows

     $count = $stmt->rowCount();
     
    //if count > 0 this mean database have record about this user
      if($count>0){

        $_SESSION['Username'] = $username; //register session name
        $_SESSION['ID'] = $row['UserID']; //Register Session ID
         header('location:dashboard.php');//redirect to dashboard if username is found 
         exit();
      }
    


     }
?>

<form class="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
    <h4 class="text-center">Admin Login</h4>
    <input class="form-control" type="text" name="username" placeholder="UserName" autocomplete="off">
    <input class="form-control" type="password" name="pass" placeholder="Password" autocomplete="new-password">
    <input class="btn btn-primary btn-block" type="submit" value="Login">
</form>

<?php
    include $tpl.'footer.php';
?>