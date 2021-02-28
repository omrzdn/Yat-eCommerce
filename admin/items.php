<?php 

ob_start();
session_start();
$pageTitle= 'Items';

if (isset($_SESSION['Username'])) {
    include 'init.php';
    $do = isset ($_GET['do']) ? $_GET['do'] : 'manage';

    if ($do == 'manage'){
    echo 'welcome';
    }elseif ($do == 'add') { ?>


        <h1 class="text-center">Add New Item</h1>
      <div class="container">
        <form class="form-horizontal"> 
          <!-- start name field -->
          <div class="form-group form-group-lg ">
            <label class="col-sm-3  control-label  ">Name :</label>
            <div class="col-sm-10  col-md-6"> 
              <input type="text"
                     name="name" 
                     class="form-control"
                     placeholder="Name of the item" 
                     required="required">
            </div>         
          </div> 
          <!-- end name field -->
          <!-- start description field -->
            <div class="form-group form-group-lg">
            <label class="col-sm-3 control-label ">Description :</label>
            <div class="col-sm-10  col-md-6"> 
              <input type="text"
                     name="Description" 
                     class="form-control"
                     required="required"
                     placeholder="Description of the item" >
            </div>         
          </div>
          <!--end description field -->
          <!-- start price field -->
          <div class="form-group form-group-lg">
            <label class="col-sm-3 control-label ">price :</label>
            <div class="col-sm-10  col-md-6"> 
              <input type="text"
                     name="price" 
                     class="form-control"
                     required="required"
                     placeholder="price of the item" >
            </div>         
          </div>
          <!--end Price field -->
          <!--start country field -->
          <div class="form-group form-group-lg">
            <label class="col-sm-3  control-label ">country :</label>
            <div class="col-sm-10  col-md-6"> 
              <input type="text"
                     name="country" 
                     class="form-control"
                     required="required"
                     placeholder="country of made" >
            </div>         
          </div>
          <!--end country field -->
             <!--start status field -->
             <div class="form-group form-group-lg">
              <label class="col-sm-3  control-label ">status :</label>
              <div class="col-sm-10  col-md-6"> 
               <select  class="form-control"  name="status">
                 <option value="0">...</option>
                 <option value="1">New</option>
                 <option value="2">Like New</option>
                 <option value="3">used</option>
                 <option value="4">very old</option>
               </select>
              </div>         
            </div>
            <!--end status field -->
        
          <div class="form-group form-group-lg">
            <div class="col-sm-offset-3  col-sm-10">
              <input type="submit" value="add item" class="btn btn-primary btn-lg" >
            </div>
          </div>
        </form>
      </div>
      <?php

        


    }elseif ($do == 'insert'){
        //insert items page
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "<h1 class='text-center'> Insert Item </h1>";
            echo "<div class='container'>";
            //getting the variables from the form
            $name = $_POST['name'];
            $desc = $_POST['description'];
            $price = $_POST['price'];
            $country = $_POST['country'];
            $status = $_POST['status'];
            $member = $_POST['member'];
            $cat = $_POST['category'];
            //validation if any field is empty
            $formErrors = array();

            if(empty($name)) {
                $formErrors[] = 'Name field cannot be empty';
            }
            if(empty($desc)) {
                $formErrors[] = 'Description field cannot be empty';
            }
            if(empty($price)) {
                $formErrors[] = 'You must assign a price to your item';
            }
            if(empty($country)) {
                $formErrors[] = 'Country field cannot be empty';
            }
            if($status == 0) {
                $formErrors[] = 'You must choose the status of your item';
            }
            if($member == 0) {
                $formErrors[] = 'You must choose the member of your item';
            }
            if($cat == 0) {
                $formErrors[] = 'You must choose the category of your item';
            }
            //echo errors
            foreach ($formErrors as $error){
                echo '<div class = "alert alert-danger">' . $error . '</div>';
            }
            //if there are no errors then proceed to insert data into database
            if (empty ($formErrors)) {
                $stmt = $con->prepare("INSERT INTO items (`Name`, `Description`, `Price`, `Country_Made`, `Status`, `Add_Date`, `Cat_ID`, `Member_ID`) VALUES (:zname , :zdesc, :zprice, :zcountry, :zstatus, now(), :zcat, :zmember)");
                $stmt->execute(array(
                    'zname'=> $name,
                    'zdesc'=> $desc,
                    'zprice'=> $price,
                    'zcountry'=> $country,
                    'zstatus'=> $status,
                    'zmember'=> $member,
                    'zcat' => $cat
                ));
                //echo success message
                $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . 'Record Inserted </div>';
                redirectHome($theMsg, 'back');
            }


        }else{
            echo "<div class='container'>";
            $theMsg = '<div class="alert alert-danger"> Sorry You can not browse this page directly </div>';
            redirectHome($theMsg);
            echo "</div>";
        }

    }elseif ($do == 'edit'){

    }elseif ($do == 'update'){

    }elseif($do == 'delete'){

    }elseif($do == 'approve'){


    }
    include $tpl . 'footer.php';

} else {
    header('Location: index.php');
    exit();
}

ob_end_flush();



?>