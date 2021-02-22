<?php 

//You can edit, delete or approve comments from here

ob_start();

session_start();

$page_Title = 'Comments';

if (isset($_SESSION['Username'])) {
    include 'init.php';
    $do = isset($_GET['do']) ? $_GET ['do'] : 'Manage';

  if ($do == 'Manage') {  

  $stmt = $con->prepare("SELECT comments.*, items.Name AS Item_Name, users.Username AS Member FROM comments INNER JOIN items ON items.Item_ID = comments.item_id INNER JOIN users ON users.UserID = comments.user_id ");

  //Execute the statement

    $stmt->execute();

    $rows = $stmt->fetchAll(); 
 ?>

        <h1  class= 'text-center'> Manage Comments </h1>
        <div class='container'>
        <div class='table-responsive'>

            <table class= "main-table text-center table table-bordered">
                <thead class="thead dark">
                <tr>
                <th scope="col"> ID </th>
                <th scope="col"> Comment </th>
                <th scope="col"> Item Name </th>
                <th scope="col"> User Name </th>
                <th scope="col"> Added date </th>
                <th scope="col"> Control </th>
                </tr></thead>
                    <?php 
                    
                    foreach ($rows as $row) {
                        echo "<tr>";
                        echo "<th scope='row'>" . $row['c_id'] ."</th>" ;
                        echo "<td>" .$row['comment']. "</td>";
                        echo "<td>" .$row['Item_Name']. "</td>";
                        echo "<td>" .$row['Member']. "</td>";
                        echo "<td>" .$row['comment_date']. "</td>";
                        
                        echo "<td> <a href='comments.php?do=edit&comid=" .$row['c_id']. "'class='btn btn-success'> <i class='fa fa-edit'> </i> Edit </a>
                        <a href='comments.php?do=delete&comid=". $row['c_id']. "'class='btn btn-danger confirm'> <i class='fa fa-window-close'> </i> Delete </a>";
                        //if condition checks to see if comment status is approved or not approved, if not approved it shows the approve button
                        if ($row['status'] == 0){
                            echo "<a href='comments.php?do=approve&comid=" .$row['c_id'] ."'class='btn btn-info'> <i class='fa fa-check'> </i> Approve </a></td></tr>" ;
                        }
                    }

                  
                    
                    ?> 
            </table>
            </div>
            </div>
 <?php 


                    // Start edit page
            } elseif ($do == 'edit') {
                $comid = isset ($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0;
                $stmt = $con->prepare("SELECT * FROM comments WHERE c_id =? ");
                $stmt -> execute(array($comid));
                $row = $stmt->fetch();
                $count = $stmt->rowCount();
                if ($count > 0) { ?>

                    <h1 class = "text-center"> Edit Comment </h1>
                    <div class="container">
                        <form class="form-horizontal" action="?do=update" method="POST">
                            <input type="hidden" name="comid" value=" <?php echo $comid ?>" />
                            <!-- Start Comment Field -->
                            <div class="form-group form-group-lg">
                                <label class="col-sm-2 control-label"> Comment </label>
                                <div class="col-sm-10 col-md-6">
                                    <textarea class="form-control" name="comment"> <?php echo $row['comment'] ?> </textarea>
                                </div>
                            </div>
                   <!-- End Comment Field -->
                   <!-- Start Submit Field -->
                   <div class="form-group form-group-lg">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" value="Save" class="btn- btn-primary btn-lg" />
                        </div>
                    </div>
                      <!-- End Submit Field  -->
                      </form>
                      </div>


               <?php }

            }elseif($do=='update'){
                // Update Comment Page
                echo "<h1 class='text-center'> Update Comment </h1>";
                echo "<div class='container'>";

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                    //get variables from the form

                   $comid = $_POST['comid'];
                   $comment = $_POST['comment'];

                   

                   //update database with this info

                   $stmt = $con->prepare("UPDATE comments SET comment = ? WHERE c_id = ?");
                   $stmt->execute(array($comment, $comid));

                   //echo success message

                   $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . 'Record Updated </div>';
                   redirectHome($theMsg, 'back');
                }   

                
            }elseif ($do=='delete'){
                //delete comments page

                echo "<h1 class='text-center'>Delete Comment </h1>";
                echo "<div class='container'";

                // check if get request is numeric and get the integer value of it
                $comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0;
                // select all data depending on this id
                $check = checkItem('c_id','comments', $comid);
                // if there is such an ID show the form
                if($check>0){
                    $stmt = $con->prepare("DELETE FROM comments WHERE c_id = :zid");
                    $stmt-> bindParam(":zid", $comid);
                    $stmt->execute();
                    $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . 'record deleted';
                    // echo $theMsg;
                    redirectHome($theMsg, 'back');
                }




            }elseif($do=="approve"){
                echo "<h1 class='text-center'> Approve Comment </h1>";
                echo "<div class='container'>";
                $comid = isset ($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0;
                $check = checkItem('c_id','comments', $comid);

                if ($check > 0){
                    $stmt = $con->prepare("UPDATE comments SET status = 1 WHERE c_id = ? ");
                    $stmt->execute(array($comid));
                    $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . 'Record approved';
                    redirectHome($theMsg, 'back');
                }




            }else {
                echo "<div class='container'>";
                $theMsg = ' <div class="alert alert-danger"> There is no such ID </div>  ';
                 redirectHome($theMsg);
                echo "</div>";
            }
            include $tpl . 'footer.php';


            } else {
                header('Location:index.php');
                exit();
            }
            
 ob_end_flush(); //release the output           
            ?>