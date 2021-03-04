<?php
   session_start();

   if(isset($_SESSION['Username'])){

        $pageTitle = 'Dashboard';

        include 'init.php';

        /* Start Dashboard Page */

        $numUsers = 5;
        $latestsUsers = getLatest('*', 'users', 'UserID', $numUsers);
        $numItems = 5;
        $latestsitems = getLatest('*', 'items', 'Item_ID', $numItems);

        $numComments = 4;



        ?>

        <div class="home-stats">
            <div class="container text-center ">
                <h1 class="text-black-50 p-4">Dashboard</h1>
                <div class="row">
                    <div class="col-md-3">
                        <div class="stat st-members">

                            <i class="fa fa-users style=''"></i>
                            <div class="info">
                                Total Members
                                <span><a href="members.php"><? echo (countItem('UserID', 'users') - 1);?></a></span>
                            </div>

                            Total Members
                            <span><a href="members.php"><? echo (countItem('UserID', 'users') - 1);?></a></span>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat st-pending">

                            <i class="fa fa-user-plus"></i>
                            <div class="info">
                                Pending Members
                                <span><a href="members.php?do=manage&page=pending"><? echo checkItem("RegStatus", 'users', 0);?></a></span>
                            </div>

                            Pending Members
                            <span><a href="members.php?do=manage&page=pending"><? echo checkItem("RegStatus", 'users', 0);?></a></span>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat st-items">

                            <i class="fa fa-tag"></i>
                            <div class="info">
                                Total Items
                                <span><a href="items.php"><? echo (countItem('Item_ID', 'items')); ?></a></span>
                            </div>

                            Total Items
                            <span><a href="items.php"><? echo (countItem('Item_ID', 'items')); ?></a></span>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat st-comments">

                            <i class="fa fa-comments"></i>
                            <div class="info">
                                Total Comments
                                <span><a href="comments.php"><? echo (countItem('c_id', 'comments')); ?></a></span>
                            </div>

                            Total Comments
                            <span><a href="comments.php"><? echo (countItem('c_id', 'comments')); ?></a></span>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="latest">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card-header">

                            <i class="fa fa-users"></i>  
                            Latest <?php echo $numUsers; ?> Registerd Users
                            <span class="toggle-info float-right">
                                <i class="fa fa-plus fa-lg"></i>
                            </span>
                        </div>
                        <div class="card card-body">
                            <ul class="list-unstyled latest-users">

                            <i class="fa fa-users"></i>  Latest <? echo $numUsers; ?> Registerd Users
                        </div>
                        <div class="card card-body">
                            <ul>

                              <?php

                                foreach ($latestsUsers as $user) {

                                    echo '<li>' . $user['FullName'] ;
                                    echo    '<a href="members.php?do=edit&userID='. $user['UserID'].'"><span class="btn btn-success float-right">';
                                    echo        '<i class="fa fa-edit"></i>Edit';


                                    if($user['RegStatus'] == 0)
                                    {
                                        echo '<a href="members.php?do=Activate&userid=' .$user['UserID'] .'" 
                                                 class ="btn btn-info float-right mr-2 activate">
                                                 <i class="fa fa-Check"></i>Activate</a>';
                                    }

                                    echo    '</span></a>';
                                    echo '</li><br>';
                                }
                                

                                    echo    '</span></a>';
                                    echo '</li>';
                                }

                            ?>
                          </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card-header">
                            <i class="fa fa-tag"></i> 
                            Latest <?php echo $numItems; ?> Items
                            <span class="toggle-info float-right">
                                <i class="fa fa-plus fa-lg"></i>
                            </span>
                        </div>
                        <div class="card card-body">
                          <ul class="list-unstyled latest-users">
                          <?php

                              foreach ($latestsitems as $item) {

                                  echo '<li>' . $item['Name'] ;
                                  echo    '<a href="items.php?do=edit&itemID='. $item['Item_ID'].'"><span class="btn btn-success float-right">';
                                  echo        '<i class="fa fa-edit"></i>Edit';


                                  if($item['Approve'] == 0)
                                  {
                                      echo '<a href="items.php?do=Approve&itemid=' .$item['Item_ID'] .'" 
                                               class ="btn btn-info float-right mr-2 activate">
                                               <i class="fa fa-check"></i>Approve</a>';
                                  }

                                  echo    '</span></a>';
                                  echo '</li><br>';   
                              }


                                  echo    '</span></a>';
                                  echo '</li>';
                              }

                          ?>
                          </ul>
                        </div>
                    </div>

                    <div class="col-sm-6 mt-4">
                        <div class="card-header">
                            <i class="fa fa-tag"></i> 
                            Latest <?php echo $numComments; ?> Comments
                            <span class="toggle-info float-right">
                                <i class="fa fa-plus fa-lg"></i>
                            </span>
                        </div>
                        <div class="card card-body">
                          <ul class="list-unstyled latest-users">
                          <?php
                            
                            //// Edit to add Comments in this section

                            //   foreach ($latestsitems as $item) {

                            //       echo '<li>' . $item['Name'] ;
                            //       echo    '<a href="items.php?do=edit&itemID='. $item['Item_ID'].'"><span class="btn btn-success float-right">';
                            //       echo        '<i class="fa fa-edit"></i>Edit';

                            //       if($item['Approve'] == 0)
                            //       {
                            //           echo '<a href="items.php?do=Approve&itemid=' .$item['Item_ID'] .'" 
                            //                    class ="btn btn-info float-right mr-2 activate">
                            //                    <i class="fa fa-check"></i>Approve</a>';
                            //       }

                            //       echo    '</span></a>';
                            //       echo '</li><br>';
                            //   }

                          ?>
                          </ul>
                        </div>
                    </div>          

                </div>
            </div>
        </div>

        <?php

        /* End Dashboard Page */

        include 'includes/templates/footer.php';

        include $tpl . 'footer.php';


   }else{

       header('location:index.php');

       exit();

   }
