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

     $query = '';
        $headline = 'Manage Members';

        if (isset($_GET['page']) && $_GET['page'] == 'pending') {

            $query = 'AND RegStatus = 0';

            $headline = 'Pending Members';
        }

      //Select All Users From Databse Except Admins

      $stmt = $con->prepare("SELECT * FROM users WHERE GroupID != 1 $query ORDER BY UserID DESC ");
      $stmt->execute();
      $rows = $stmt->fetchAll();

    ?>

      <h1 class="text-center"><? echo $headline; ?></h1>
      <div class="container">
        <div class="table-responsive">
          <table class="main-table text-center table table-bordered">
            <tr>
              <td>#ID</td>
              <td>Avatar</td>
              <td>Username</td>
              <td>EMail</td>
              <td>FullName</td>
              <td>Registerd Date</td>
              <td>Control</td>
            </tr>
            <?php

            foreach ($rows as $row) {

              echo '<tr>';

                echo  '<td>'. $row['UserID'] .'</td>';
                echo  '<td>';
                if (empty($row['avatar'])) {

                    echo "no image";
                }else {
                    echo '<img src="upload/avatars/'.
                    $row['avatar'].'" alt="" />';
                }
                echo '</td>';
                echo  '<td>'. $row['Username'].'</td>';
                echo  '<td>'. $row['Email'].'</td>';
                echo  '<td>'. $row['FullName'].'</td>';
                echo  '<td>'. $row['Date'].'</td>';
                echo '<td>
                        <a href="members.php?do=edit&userID='. $row["UserID"].' "class="btn btn-success"><i class="fa fa-edit"></i>Edit</a>
                        <a href="members.php?do=delete&userID='. $row["UserID"].' "class="btn btn-danger confirm"><i class="fas fa-times"></i>Delete</a>';

                    if ($row['RegStatus'] == 0) {

                            echo '<a href="members.php?do=activate&userID='. $row["UserID"].' "class="btn btn-info activate"><i class="fas fa-times"></i>Activate</a>';
                    }
                echo '</td>';
              echo "</tr>";

            }
            ?>
          </table>
        </div>

        <a href='members.php?do=add' class="btn btn-primary"><i class="fa fa-plus"></i>New Member</a>

      </div>

  <? }elseif($do == 'add') { //add members ?>

      <h1 class="text-center">Add New Member</h1>
      <div class="container">
          <form class="form-horizontal" action="?do=insert" method="POST" enctype="multipart/form-data">
              <!-- Start Full Name Field -->
              <div class="form-group form-group-lg">
                  <label class="col-sm-2 control-label">Full Name</label>
                  <div class="col-sm-10 col-md-6">
                      <input
                        type="text"
                        name="full"
                        class="form-control"
                        placeholder="Type Your Full Name Here"
                        required/>
                  </div>
              </div>
              <!-- End Full Name Field -->
              <!-- Start Username Field -->
              <div class="form-group form-group-lg">
                  <label class="col-sm-2 control-label">Username</label>
                  <div class="col-sm-10 col-md-6">
                      <input
                        type="text"
                        name="username"
                        class="form-control"
                        placeholder="Username Must be between 4 - 20 chrachters"
                        required
                        autocomplete="off"/>
                  </div>
              </div>
              <!-- End Username Field -->
              <!-- Start Email Field -->
              <div class="form-group form-group-lg">
                  <label class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-10 col-md-6">
                      <input
                        type="email"
                        name="email"
                        class="form-control"
                        placeholder="Type Your Email Here Please."
                        required/>
                  </div>
              </div>
              <!-- End Email Field -->
              <!-- Start Password Field -->
              <div class="form-group form-group-lg">
                  <label class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-10 col-md-6">
                      <input
                        type="password"
                        name="password"
                        class="password form-control"
                        autocomplete="off"
                        placeholder="Type Your Password Here"
                        required/>
                      <i class="show-pass fa fa-eye fa-2x"></i>
                  </div>
              </div>
              <!-- End Password Field -->
              <!-- Start Avatar Field -->
              <div class="form-group form-group-lg">
                  <label class="col-sm-2 control-label">User Avatar</label>
                  <div class="col-sm-10 col-md-6">
                      <input
                        type="file"
                        name="avatar"
                        class="form-control"
                        autocomplete="off"
                        required/>
                  </div>
              </div>
              <!-- End Avatar Field -->
              <!-- Start Submit Field -->
              <div class="form-group form-group-lg">
                  <div class="col-sm-offset-2 col-sm-10">
                      <input type="submit" value="Add member" class="btn btn-primary btn-lg" />
                  </div>
              </div>
              <!-- End Submit Field -->
          </form>
      </div>






    }elseif($do == 'insert') { //insert page

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

              echo "<h1 class='text-center'>Insert Member</h1>";
              echo "<div class='container'>";

              //upload files

              $avatarName = $_FILES['avatar']['name'];
              $avatarSize = $_FILES['avatar']['size'];
              $avatarTmp = $_FILES['avatar']['tmp_name'];
              $avatarType = $_FILES['avatar']['type'];

              //List if allow Extensions
              $avatarAllowedExtension = array('jpeg', 'jpg', 'png', 'gif');

              $tmp = explode('.' ,$avatarName);
              $avatarExtension = strtolower(end($tmp));

              if (!in_array($avatarExtension,$avatarAllowedExtension)) {

                echo "this extension is not allowed";
              }

              //Get var from form
              $password = $_POST['password'];
              $user     = $_POST['username'];
              $email    = $_POST['email'];
              $name     = $_POST['full'];
              $hashedpass = sha1($password);
              //validte the form

              $formErrors = array();

              //empty($user) ? $formErrors[] = 'Username Can\'t be empty';

              if (empty($user)) {

                $formErrors[] = 'Username Can\'t be <strong>empty</strong>';
              }

              if (empty($password)) {

                $formErrors[] = 'password Can\'t be <strong>empty</strong>';
              }

              if (strlen($user) < 4) {
                $formErrors[] = 'Username Can\'t be lower than 4 charchters';
              }

              if (strlen($user) > 20) {
                $formErrors[] = 'Username Can\'t be lower than 4 charchters';
              }

              if (empty($email)) {

                $formErrors[] = 'email can\'t be empty';
              }

              if (empty($name)) {

                $formErrors[] = 'Full name can\'t be empty';
              }
              foreach ($formErrors as $error) {

                echo '<div class="alert alert-danger">' . $error . '</div>';
              }

              if (empty($formErrors)) {

                  $avatar = rand(0, 100000) . '_' . $avatarName;

                  move_uploaded_file($avatarTmp, "upload/avatars/" . $avatar);

                // Check if users exists on not

                $check = checkItem('Username', 'users', $user);

                if ($check == 1) {

                  $theMsg = '<div class="alert alert-danger"> sorry this username is already token</div>';
                  redirectHome($theMsg, 'back');

                }else {


                  // Insert user info in database

                  $stmt = $con->prepare('INSERT INTO users(Username, Password, Email, FullName,RegStatus, Date, avatar)
                                          VALUES(:username, :password, :email, :fullname, 1,now(), :zavatar )');

                  $stmt->execute([

                    ':username' => $user,
                    ':password' => $hashedpass,
                    ':email'    => $email,
                    ':fullname' => $name,
                    'zavatar'   => $avatar
                  ]);
                  // Echo Success Message

                  $theMsg = '<div class="alert alert-success">' . $stmt->rowCount() . ' User Inserted</div>';

                  redirectHome($theMsg);

                }

              }
            }else {

              $theMsg = '<div class="alert alert-danger">You can\'t browse this page directly</div>';

              redirectHome($theMsg, 'back');
            }
 }elseif($do =='edit'){ //edit page


// check if get request user id is numeric and get the integer value of it

    $userid = isset($_GET['userID']) && is_numeric($_GET['userID']) ? intval($_GET['userID']) : 0;
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

    ?>

    <h1 class="text-center">Edit Member</h1>

    <div class="container">
        <form class="form-horizontal" action="?do=update" method="POST">

            <input type="hidden" name="userID" value="<?php echo $userid ?>">
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
                <input type="hidden" name="oldpassword" value="<? echo $row['Password'];?>"/>
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

}elseif ($do == 'update') { // Update Page ?>

        <h1 class='text-center'>Update Page</h1>
        <div class="container">

      <?php
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $id     = $_POST['userID'];
        $user   = $_POST['username'];
        $email  = $_POST['email'];
        $name   = $_POST['full'];

        //password trick

        $pass = empty($_POST['newpassword']) ? $pass = $_POST['oldpassword'] : $pass = sha1($_POST['newpassword']) ;

        //validte the form

        $formErrors = array();

        //empty($user) ? $formErrors[] = 'Username Can\'t be empty';

        if (empty($user)) {

          $formErrors[] = 'Username Can\'t be <strong>empty</strong>';
        }

        if (strlen($user) < 4) {
          $formErrors[] = 'Username Can\'t be lower than 4 charchters';
        }

        if (empty($email)) {

          $formErrors[] = 'email can\'t be empty';
        }

        if (empty($name)) {

          $formErrors[] = 'Full name can\'t be empty';
        }
        foreach ($formErrors as $error) {

          echo '<div class="alert alert-danger">' . $error . '</div>';
        }

        if (empty($formErrors)) {

          // Update The Database With This Info
          $stmt = $con->prepare("UPDATE users SET Username = ?, Email = ?, FullName = ?, Password = ? WHERE UserID = ? ");
          $stmt->execute(array($user, $email, $name, $pass, $id));

          // Echo Success Message

          $theMsg = '<div class="alert alert-success">' . $stmt->rowCount() . ' Record Update</div>';

          redirectHome($theMsg);

        }

      }else {

        $theMsg = '<div class="alert alert-danger">You Can\'t Browser This Page Directly</div>';

        redirectHome($theMsg);
      }

      echo "</div>";
    }elseif ($do == 'activate') { //Activate Page ?>

        <h1 class="text-center">Activate Member</h1>
        <div class="container">

          <?php

              //Check If Get Request UserID is Numeric & Get The Integer Value Of it

            $userID = isset($_GET['userID']) && is_numeric($_GET['userID']) ? intval($_GET['userID']) : 0;

              // Select all Data depend on This ID

            $check = checkItem('UserID', 'users', $userID);

              // If There is Sucj ID Show The form
            if($check > 0) {

              $stmt = $con->prepare('UPDATE users SET RegStatus = 1 WHERE UserID = :zuser');
              $stmt->execute([

                'zuser' => $userID
              ]);

              if ($stmt->rowCount()) {

                  $theMsg = '<div class="alert alert-success">' . $stmt->rowCount() . ' User Activated</div>';

                  redirectHome($theMsg,'back');
              }

          }else {

              $theMsg = '<div class="alert alert-warning">User not exists</div>';

              redirectHome($theMsg);
            }

          echo "</div>";

    }
 include 'includes/templates/footer.php';

}else{

    header('location:index.php');

    exit();

}



?>
