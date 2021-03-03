<?php 

ob_start();
session_start();
$pageTitle= 'Items';

if (isset($_SESSION['Username'])) {
    include 'init.php';
    $do = isset ($_GET['do']) ? $_GET['do'] : 'manage';

    if ($do == 'manage'){
        $stmt = $con->prepare(  "SELECT items.*, categories.Name AS category_name, users.Username FROM items 

                                INNER JOIN categories ON categories.ID = items.Cat_ID
        
                                INNER JOIN users ON users.UserID = items.Member_ID");
        $stmt->execute();
        $items = $stmt->fetchAll();
         ?>
        
        <h1 class="text-center"> Manage Items</h1>
    <div class="container">
    <div>
     <a href="items.php?do=add" class="btn btn-primary m-2"><i class="fa fa-plus"></i>New Item</a>
     </div>
     <div class="table-responsive">
      <table class="main-table text-center table table-bordered">
       <tr>
        <td>#ID</td>
        <td>Name</td>
        <td>Description</td>
        <td>Price</td>
        <td>Adding Date</td>
        <td>Category</td>
        <td>Member</td>
        <td style="border-right:0px"></td>
        <td style="border-left:0px ; border-right:0px">Control</td>
        <td style="border-left:0px"></td>

       </tr>
       <?php 
            foreach($items as $item){
                echo "<tr>";
                echo "<td>" . $item['Item_ID']. "</td>";
                echo "<td>" . $item['Name']. "</td>";
                echo "<td>" . $item['Description']. "</td>";
                echo "<td>" . $item['Price']. "</td>";
                echo "<td>" . $item['Add_Date']. "</td>";
                echo "<td>" . $item['category_name']. "</td>";
                echo "<td>" . $item['Username']. "</td>";
                // echo "<td>";
                 echo "<td><a href='items.php?do=edit&itemid=" . $item['Item_ID'] . "' class='btn btn-sm btn-success m-1'><i class='fa fa-edit'></i> Edit</a> </td>";
                 echo "<td><a href='items.php?do=delete&itemid=" . $item['Item_ID'] ."' class='btn btn-sm btn-danger confirm'><i class='fa fa-window-close'></i> Delete</a> </td>";
                 if ($item['Approve'] == 0){
                 echo "<td><a href='items.php?do=approve&itemid=" . $item['Item_ID'] ."' class='btn btn-sm btn-info activate '><i class='fa fa-check'></i> Approve</a> </td>";
                // echo "</td>";
            }
                echo "</tr>";
            }
       
       ?>
       
      </table>
      
     </div>
    </div>

        <?php
    }elseif ($do == 'add') { ?>


        <h1 class="text-center">Add New Item</h1>
      <div class="container">
        <form class="form-horizontal" action="?do=insert" method="POST"> 
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
                     name="description" 
                     class="form-control"
                     required="required"
                     placeholder="Description of the item" >
            </div>         
          </div>
          <!--end description field -->
          <!-- start price field -->
          <div class="form-group form-group-lg">
            <label class="col-sm-3 control-label ">Price :</label>
            <div class="col-sm-10  col-md-6"> 
              <input type="text"
                     name="price" 
                     class="form-control"
                     required="required"
                     placeholder="Price of the item" >
            </div>         
          </div>
          <!--end Price field -->
          <!--start country field -->
          <div class="form-group form-group-lg">
            <label class="col-sm-3  control-label ">Country :</label>
            <div class="col-sm-10  col-md-6"> 
              <input type="text"
                     name="country" 
                     class="form-control"
                     required="required"
                     placeholder="Manufacturing country" >
            </div>         
          </div>
          <!--end country field -->
             <!--start status field -->
             <div class="form-group form-group-lg">
              <label class="col-sm-3  control-label ">Item Status :</label>
              <div class="col-sm-10  col-md-6"> 
               <select  class="form-control"  name="status">
                 <option value="0">...</option>
                 <option value="1">New</option>
                 <option value="2">Like New</option>
                 <option value="3">Used</option>
                 <option value="4">Very old</option>
               </select>
              </div>         
            </div>
            <!--end status field -->
            <!--start members field -->
            <div class="form-group form-group-lg">
              <label class="col-sm-3  control-label ">Seller Member :</label>
              <div class="col-sm-10  col-md-6"> 
               <select  class="form-control"  name="member">
                 <option value="0">...</option>
                 <?php 
                 $stmt = $con->prepare("SELECT * FROM users");
                 $stmt->execute();
                 $users = $stmt->fetchAll();
                 foreach ($users as $user){
                     echo "<option value ='" . $user['UserID'] . "'> " . $user['Username'] . "</option>";
                 }   
               ?>  </select>
              </div>         
            </div>
            <!--end members field -->
             <!--start categories field -->
             <div class="form-group form-group-lg">
              <label class="col-sm-3  control-label ">Category :</label>
              <div class="col-sm-10  col-md-6"> 
               <select  class="form-control"  name="category">
                 <option value="0">...</option>
                 <?php 
                 $stmt2 = $con->prepare("SELECT * FROM categories");
                 $stmt2->execute();
                 $cats = $stmt2->fetchAll();
                 foreach ($cats as $cat){
                     echo "<option value ='" . $cat['ID'] . "'> " . $cat['Name'] . "</option>";
                 }   
               ?>  </select>
              </div>         
            </div>
            <!--end categories field -->
            
        
          <div class="form-group form-group-lg">
            <div class="col-sm-offset-3  col-sm-10">
              <input type="submit" value="Add Item" class="btn btn-primary btn-lg" >
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
                $formErrors[] = 'You must choose the member adding the new item';
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
        //check get request
        $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0 ;
        $stmt = $con->prepare("SELECT * FROM items WHERE Item_ID = ? ");
        $stmt->execute(array($itemid));
        $item = $stmt->fetch();
        $count = $stmt->rowCount();
        if ($count > 0){

        ?>
           <h1 class="text-center">Edit Item</h1>
      <div class="container">
        <form class="form-horizontal" action="?do=update" method="POST"> 
        <input type="hidden" name="itemid" value="<?php echo $itemid ?>" />
          <!-- start name field -->
          <div class="form-group form-group-lg ">
            <label class="col-sm-3  control-label  ">Name :</label>
            <div class="col-sm-10  col-md-6"> 
              <input type="text"
                     name="name" 
                     class="form-control"
                     placeholder="Name of the item" 
                     required="required"
                     value="<?php echo $item['Name'] ?>">
            </div>         
          </div> 
          <!-- end name field -->
          <!-- start description field -->
            <div class="form-group form-group-lg">
            <label class="col-sm-3 control-label ">Description :</label>
            <div class="col-sm-10  col-md-6"> 
              <input type="text"
                     name="description" 
                     class="form-control"
                     required="required"
                     placeholder="Description of the item" 
                     value="<?php echo $item['Description'] ?>">
            </div>         
          </div>
          <!--end description field -->
          <!-- start price field -->
          <div class="form-group form-group-lg">
            <label class="col-sm-3 control-label ">Price :</label>
            <div class="col-sm-10  col-md-6"> 
              <input type="text"
                     name="price" 
                     class="form-control"
                     required="required"
                     placeholder="Price of the item"
                     value="<?php echo $item['Price'] ?>" >
            </div>         
          </div>
          <!--end Price field -->
          <!--start country field -->
          <div class="form-group form-group-lg">
            <label class="col-sm-3  control-label ">Country :</label>
            <div class="col-sm-10  col-md-6"> 
              <input type="text"
                     name="country" 
                     class="form-control"
                     required="required"
                     placeholder="Manufacturing country"
                     value="<?php echo $item['Country_Made'] ?>" >
            </div>         
          </div>
          <!--end country field -->
             <!--start status field -->
             <div class="form-group form-group-lg">
              <label class="col-sm-3  control-label ">Item Status :</label>
              <div class="col-sm-10  col-md-6"> 
               <select  class="form-control"  name="status">
                 
                 <option value="1" <?php if ($item['Status'] == 1) {echo "selected";}  ?>>New</option>
                 <option value="2" <?php if ($item['Status'] == 2) {echo "selected";}  ?>>Like New</option>
                 <option value="3" <?php if ($item['Status'] == 3) {echo "selected";}  ?>>Used</option>
                 <option value="4" <?php if ($item['Status'] == 4) {echo "selected";}  ?>>Very old</option>
               </select>
              </div>         
            </div>
            <!--end status field -->
            <!--start members field -->
            <div class="form-group form-group-lg">
              <label class="col-sm-3  control-label ">Seller Member :</label>
              <div class="col-sm-10  col-md-6"> 
               <select  class="form-control"  name="member">
                 
                 <?php 
                 $stmt = $con->prepare("SELECT * FROM users");
                 $stmt->execute();
                 $users = $stmt->fetchAll();
                 foreach ($users as $user){
                     echo "<option value ='" . $user['UserID'] . "'"; 
                     if ($item['Member_ID'] == $user['UserID']) {echo "selected";} 
                     echo "> " . $user['Username'] . "</option>";
                 }   
               ?>  </select>
              </div>         
            </div>
            <!--end members field -->
             <!--start categories field -->
             <div class="form-group form-group-lg">
              <label class="col-sm-3  control-label ">Category :</label>
              <div class="col-sm-10  col-md-6"> 
               <select  class="form-control"  name="category">
                 
                 <?php 
                 $stmt2 = $con->prepare("SELECT * FROM categories");
                 $stmt2->execute();
                 $cats = $stmt2->fetchAll();
                 foreach ($cats as $cat){
                     echo "<option value ='" . $cat['ID'] . "'";
                     if ($item['Cat_ID'] == $cat['ID']) {echo "selected";}
                     echo" > " . $cat['Name'] . "</option>";
                 }   
               ?>  </select>
              </div>         
            </div>
            <!--end categories field -->
            
        
          <div class="form-group form-group-lg">
            <div class="col-sm-offset-3  col-sm-10">
              <input type="submit" value="Save Changes" class="btn btn-primary btn-lg" >
            </div>
          </div>
        </form>
      </div>
    
        <?php
        }else{

            echo "<div class = 'container'>";
            $theMsg = '<div class="alert alert-danger"> There is no such item. </div>';
            redirectHome($theMsg);
            echo "</div>";
        }


    }elseif ($do == 'update'){
        echo "<h1 class='text-center> Update Item </h1>";
        echo "<div class='container'>";

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            //get varibles from the form
            $id = $_POST['itemid'];
            $name = $_POST['name'];
            $desc = $_POST['description'];
            $price = $_POST['price'];
            $country = $_POST['country'];
            $status = $_POST['status'];
            $member = $_POST['member'];
            $cat = $_POST['category']; 


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
                $formErrors[] = 'You must choose the member adding the new item';
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
                $stmt = $con->prepare("UPDATE items SET `Name` = ?, `Description` = ?, `Price` = ?, `Country_Made` = ?, `Status` = ? , `Cat_ID` = ? , `Member_ID` = ? WHERE ITEM_ID = ?");
                $stmt->execute(array($name, $desc, $price, $country, $status, $cat, $member, $id));
                //echo success message
                $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . 'record updated </div>';
                redirectHome($theMsg, 'back');
            }


        }else{
            echo "<div class='container'>";
            $theMsg = '<div class="alert alert-danger"> Sorry You can not browse this page directly </div>';
            redirectHome($theMsg);
            echo "</div>";
        }


    }elseif($do == 'delete'){
        echo "<h1 class='text-center'>Delete Item </h1>";
        echo "<div class='container'>";

        $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval ($_GET['itemid']) : 0 ;
        $check = checkItem('Item_ID','items', $itemid);
        if ($check > 0){
            $stmt = $con->prepare("DELETE FROM items WHERE Item_ID = :zid");
            $stmt->bindParam(":zid",$itemid);
            $stmt->execute();
            $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . 'Record deleted';
            redirectHome($theMsg,'back');

        }else{
            $theMsg = '<div class="alert alert-danger"> This item does not exist. </div>';
            redirectHome($theMsg);
        }
        echo '</div>';

    }elseif($do == 'approve'){
        echo "<h1 class='text-center'>Approve Item </h1>";
        echo "<div class='container'>";

        $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval ($_GET['itemid']) : 0 ;
        $check = checkItem('Item_ID','items', $itemid);
        if ($check > 0){
            $stmt = $con->prepare("UPDATE items SET Approve = 1 WHERE Item_ID = ? ");
           
            $stmt->execute(array($itemid));
            $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' item approved';
            redirectHome($theMsg,'back');

        }else{
            $theMsg = '<div class="alert alert-danger"> This item does not exist. </div>';
            redirectHome($theMsg);
        }
        echo '</div>';



    }
    include $tpl . 'footer.php';

} else {
    header('Location: index.php');
    exit();
}

ob_end_flush();



?>