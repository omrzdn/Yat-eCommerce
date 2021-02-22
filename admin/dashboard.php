<?php
   session_start();

   if(isset($_SESSION['Username'])){

        $pageTitle = 'Dashboard';

        include 'init.php';
    
        /* Start Dashboard Page */

        ?>

        <div class="home-stats">
            <div class="container text-center ">
                <h1 class="text-black-50 p-4">Dashboard</h1>
                <div class="row">
                    <div class="col-md-3">
                        <div class="stat st-members">
                            Total Members
                            <span><a href="members.php">200</a></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat st-pending">
                            Pending Members
                            <span>25</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat st-items">
                            Total Items
                            <span>1500</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat st-comments">
                            Total Comments
                            <span>3500</span>
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
                            <i class="fa fa-users"></i> Latest Registered Users
                        </div>
                        <div class="card card-body">
                            Test
                        </div>    
                    </div>
                    <div class="col-sm-6">
                        <div class="card-header">
                            <i class="fa fa-tag"></i> Latest Items
                        </div>
                        <div class="card card-body">
                            Test
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