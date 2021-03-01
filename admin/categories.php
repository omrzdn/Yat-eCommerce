<?php 

ob_start();
session_start();
$pageTitle= 'Categories';

if (isset($_SESSION['Username'])) {
    include 'init.php';
    $do = isset ($_GET['do']) ? $_GET['do'] : 'manage';

    if ($do == 'manage'){
        //CATEGORY MANAGEMENT PAGE
        $sort = 'ASC';
        $sort_array= array('ASC', 'DESC');
        if(isset($_GET['sort']) && in_array($_GET['sort'], $sort_array)){
            $sort = $_GET['sort'];
        }
        $stmt2 = $con->prepare("SELECT * FROM categories ORDER BY Ordering $sort");
        $stmt2->execute();
        $cats = $stmt2->fetchAll(); ?>
        
                <h1 class="text-center">Manage Categories</h1>
            <div class="container categories">
                <div class="panel panel-default">
                    <div class="panel-heading"> 
                    <i class="fa fa-edit"></i> Manage Categories
                    <div class="option pull-right">
                        <i class="fa fa-sort"></i> Ordering:
                        [
                        <a href="?sort=ASC" class= <?php if ($sort=='ASC'){echo "active";}?>>Asc</a> |
                        <a href="?sort=DESC"class= <?php if ($sort=='DESC'){echo "active";}?>>Desc</a>
                        ]
                        <!-- <i class="fa fa-eye"></i> View :
                        [
                        <span class="active" data-view="full" >Full</span> |
                        <span class="active" data-view="classic" >Classic</span>
                        ] -->
                   </div>
                    </div>
                    <a href="categories.php?do=add"  class=" add-category btn btn-primary my-3"> <i class="fa fa-plus"></i> Add New Category</a>
                            <hr>
                    <?php 
                    foreach ($cats as $cat){?> 
                    
                    <div class="panel-body">

                    <div class="cat">
                        <div class="hidden-buttons">
                        <a href="categories.php?do=edit&catid=<?php echo $cat['ID'];?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>
                        <a href="categories.php?do=delete&catid=<?php echo $cat['ID'];?>" class="btn btn-xs btn-danger confirm"><i class="fa fa-window-close"></i> Delete</a>

                        </div>
                        <h3> <?php echo $cat['Name'] ?> </h3>
                        <?php if ($cat['Description']==''){echo "This category has no description";
                         } else {
                        echo "<p>". $cat['Description']. "</p>";
                        }
                        ?>
                        <?php if ($cat['Visibility']==1){echo "<span class=' spans visibility'> <i class='fa fa-eye'></i> Hidden</span>";
                         } 
                         if ($cat['Allow_Comment']==1){echo "<span class=' spans commenting'> <i class='fa fa-window-close'></i> Commenting is disabled</span>";
                         } 
                         if ($cat['Allow_Ads']==1){echo "<span class=' spans advertises'> <i class='fa fa-window-close'></i> Ads are disabled</span>";
                         } 


                        
                    ?>
                        </div>
                    
                    </div>

            
        <?php }?>
            
            </div>
            </div> 

    
    
    
    <?php
    }elseif ($do == 'add') { ?>
                
                <h1 class="text-center">Add New Category</h1>
                <div class="container">
                <form class="form-horizental" action="?do=insert" method="Post">
                <!-- start category name field -->
                <div class="form-group ">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10 ">
                    <input type="text" name="name" class="form-control " autocomplete="off" required="required" placeholder="Name Of The Category">
                    <span class="asterisk">*</span>
                    </div>

                </div>
                <!-- end category name field -->
                <!-- start description field -->
                <div class="form-group ">
                    <label class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10 ">
                    <input type="text" name="description" class="form-control" placeholder="Describe The Category">
                    </div>
                    </div>
                    <!-- end description field -->
                    <!-- start ordering field -->
                    <div class="form-group ">
                    <label class="col-sm-2 control-label">Ordering</label>
                    <div class="col-sm-10 ">
                    <input type="text" name="ordering" class="form-control" placeholder="Number To Arrange The Categories">
                    </div>
                    </div>
                    <!-- end ordering field -->
                    <!-- start visibilty field -->
                    <div class="form-group ">
                    <label class="col-sm-2 control-label">Visible</label>
                    <div class="col-sm-10 ">
                    <div>
                    <input id="vis-yes" type="radio" name="visibility" value="0" checked>
                    <label  for="vis-yes">Yes</label>
                    </div>
                    <div>
                    <input id="vis-no" type="radio" name="visibility" value="1">
                    <label  for="vis-no">No</label>
                    </div>

                    </div>
                    </div>
                    <!-- end visibilty field -->
                    <!-- start commenting field -->
                    <div class="form-group ">
                    <label class="col-sm-2 control-label">Allow Commenting</label>
                    <div class="col-sm-10 ">
                    <div>
                    <input id="com-yes" type="radio" name="commenting" value="0" checked>
                    <label  for="com-yes">Yes</label>
                    </div>
                    <div>
                    <input id="com-no" type="radio" name="commenting" value="1">
                    <label  for="com-no">No</label>
                    </div>
                    </div>
                    </div>
                    <!-- end commentimg field -->
                    <!-- start ads field -->
                    <div class="form-group ">
                    <label class="col-sm-2 control-label">Allow Ads</label>
                    <div class="col-sm-10">
                    <div>
                    <input id="ads-yes" type="radio" name="ads" value="0" checked>
                    <label  for="ads-yes">Yes</label>
                    </div>
                    <div>
                    <input id="ads-no" type="radio" name="ads" value="1">
                    <label  for="ads-no">No</label>
                    </div>
                    </div>
                    </div>
                    <!-- end ads field -->
                    <!-- start submit feild -->
                    <div class="form-group ">
                    <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" value ="Add Category" class="btn btn-primary btn-lg">
                    </div>
                    </div>
                    <!-- end submit field -->
                </form>
                </div>
                
    <?php 
    }elseif ($do == 'insert'){

            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                echo "<h1 class='text-center'>Insert Categories </h1>";
                echo "<div class='container'>";
                // getting variables from the form
                $name= $_POST['name'];
                $desc= $_POST['description'];
                $order=$_POST['ordering'];
                $visible=$_POST['visibility'];
                $comment=$_POST['commenting'];
                $ads=$_POST['ads'];
                //checking if the category exists in the database
                $check= checkItem("Name","categories", $name);
                if ($check == 1){
                    $theMsg='<div class="alert alert-danger"> Sorry, this category already exists</div>';
                    redirectHome($theMsg, 'back');
                }else {
                    //inserting category information into the database
                    $stmt = $con->prepare("INSERT INTO categories (`Name`, `Description`, `Ordering`, `Visibility`, `Allow_Comment`, `Allow_Ads`) VALUES (:zname, :zdesc, :zorder, :zvisible, :zcomment, :zads)");
                    $stmt->execute(array(
                        'zname'=>$name,
                        'zdesc'=>$desc,
                        'zorder'=>$order,
                        'zvisible'=>$visible,
                        'zcomment'=>$comment,
                        'zads'=>$ads
                    ));
                    //success message
                    $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . 'Record(s) inserted </div>';
                    redirectHome($theMsg,'back');
                    
                }



            }
            else {
                echo "<div class='container'>";
                $theMsg='<div class="alert alert-danger"> Sorry,you are not allowed to browse this page without signing in </div>';
                reirectHome($theMsg,'back');
                echo "</div>";
            }
            echo "</div>";

    }elseif ($do == 'edit'){

        $catid= isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;
        $stmt=$con->prepare("SELECT * FROM categories WHERE ID = ?");
        $stmt->execute(array($catid));
        $cat = $stmt->fetch();
        $count=$stmt->rowCount();
        if ($count > 0) { ?>

            <h1 class="text-center">Edit Category</h1>
                <div class="container">
                <form class="form-horizental" action="?do=update" method="Post">
                <input type="hidden" name="catid" value="<?php echo $catid ?>" />
                <!-- start category name field -->
                <div class="form-group ">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10 ">
                    <input type="text" name="name" class="form-control " value="<?php echo $cat['Name'] ?>" required="required" placeholder="Name Of The Category">
                    <span class="asterisk">*</span>
                    </div>

                </div>
                <!-- end category name field -->
                <!-- start description field -->
                <div class="form-group ">
                    <label class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10 ">
                    <input type="text" name="description" class="form-control" value="<?php echo $cat['Description'] ?>" placeholder="Describe The Category">
                    </div>
                    </div>
                    <!-- end description field -->
                    <!-- start ordering field -->
                    <div class="form-group ">
                    <label class="col-sm-2 control-label">Ordering</label>
                    <div class="col-sm-10 ">
                    <input type="text" name="ordering" class="form-control" value="<?php echo $cat['Ordering'] ?>" placeholder="Number To Arrange The Categories">
                    </div>
                    </div>
                    <!-- end ordering field -->
                    <!-- start visibilty field -->
                    <div class="form-group ">
                    <label class="col-sm-2 control-label">Visible</label>
                    <div class="col-sm-10 ">
                    <div>
                    <input id="vis-yes" type="radio" name="visibility" value="0" <?php if($cat['Visibility'] == 0) {echo "checked";} ?>>
                    <label  for="vis-yes">Yes</label>
                    </div>
                    <div>
                    <input id="vis-no" type="radio" name="visibility" value="1"<?php if($cat['Visibility'] == 1) {echo "checked";} ?>>
                    <label  for="vis-no">No</label>
                    </div>

                    </div>
                    </div>
                    <!-- end visibilty field -->
                    <!-- start commenting field -->
                    <div class="form-group ">
                    <label class="col-sm-2 control-label">Allow Commenting</label>
                    <div class="col-sm-10 ">
                    <div>
                    <input id="com-yes" type="radio" name="commenting" value="0" <?php if($cat['Allow_Comment'] == 0) {echo "checked";} ?>>
                    <label  for="com-yes">Yes</label>
                    </div>
                    <div>
                    <input id="com-no" type="radio" name="commenting" value="1" <?php if($cat['Allow_Comment'] == 1) {echo "checked";} ?>>
                    <label  for="com-no">No</label>
                    </div>
                    </div>
                    </div>
                    <!-- end commentimg field -->
                    <!-- start ads field -->
                    <div class="form-group ">
                    <label class="col-sm-2 control-label">Allow Ads</label>
                    <div class="col-sm-10">
                    <div>
                    <input id="ads-yes" type="radio" name="ads" value="0" <?php if($cat['Allow_Ads'] == 0) {echo "checked";} ?>>
                    <label  for="ads-yes">Yes</label>
                    </div>
                    <div>
                    <input id="ads-no" type="radio" name="ads" value="1"<?php if($cat['Allow_Ads'] == 1) {echo "checked";} ?>>
                    <label  for="ads-no">No</label>
                    </div>
                    </div>
                    </div>
                    <!-- end ads field -->
                    <!-- start submit feild -->
                    <div class="form-group ">
                    <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" value ="Save Changes" class="btn btn-primary btn-lg">
                    </div>
                    </div>
                    <!-- end submit field -->
                </form>
                </div>
      
      
      
      
      <?php
        }else{
            echo "<div class='container'>";
            $theMsg = '<div class="alert alert-danger"> There is no such category';
            
            echo "</div>";
            redirectHome($theMsg); 
        }


    }elseif ($do == 'update'){
        echo "<h1 class='text-center'> Update Category </h1>";
        echo "<div class='container'>";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['catid'];
            $name = $_POST['name'];
            $desc = $_POST['description'];
            $order = $_POST['ordering'];
            $visible = $_POST['visibility'];
            $comment = $_POST['commenting'];
            $ads = $_POST['ads'];

            $stmt = $con->prepare("UPDATE categories SET `Name` = ?, `Description` = ?, `Ordering` = ?, `Visibility` = ?, `Allow_Comment` = ?, `Allow_Ads` = ? WHERE `ID` = ?");
            $stmt->execute(array($name, $desc, $order, $visible, $comment, $ads, $id));
            $theMsg="<div class='alert alert-success'>" . $stmt->rowCount() . "Record updated successfully";
            redirectHome($theMsg,'back');

        }else {
            $theMsg='<div class="alert alert-danger"> You can not browse this page directly</div>';
            redirctHome($theMsg);
        }


    }elseif($do == 'delete'){
        echo "<h1 class='text-center'>Delete Category </h1>";
        echo "<div class='container'>";

        $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval ($_GET['catid']) : 0 ;
        $check = checkItem('ID', 'categories', $catid);
        if ($check > 0){
            $stmt = $con->prepare("DELETE FROM categories WHERE ID = :zid");
            $stmt->bindParam(":zid",$catid);
            $stmt->execute();
            $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . 'Record deleted';
            redirectHome($theMsg,'back');

        }else{
            $theMsg = '<div class="alert alert-danger"> This category does not exist </div>';
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