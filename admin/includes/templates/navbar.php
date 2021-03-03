<?php

global $con;
$stmt = $con->prepare("SELECT FullName FROM users WHERE UserID = :userid");
$stmt->execute([ ':userid' => $_SESSION['ID'] ]);

?>

<nav class="navbar navbar-expand-lg bg-dark navbar-dark">

  <div class="container">
    <a class="navbar-brand" href="#">LOGO</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link active" href="dashboard.php"><?php echo lang('home_admin')?>
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="categories.php"><?php echo lang('categories')?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="items.php"><?php echo lang('ITEMS')?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><?php echo lang('STATISTICS')?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="members.php"><?php echo lang('MEMBERS')?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="comments.php"><?php echo lang('COMMENTS')?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><?php echo lang('LOGS')?></a>
        </li>
      </ul>
      <ul class="navbar-nav mr-0">
        <li class="nav-item dropdown ">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?
            echo $stmt->fetchColumn();
            ?>
            </a>
          <div class="dropdown-menu " aria-labelledby="navbarDropdown">
            <a class="dropdown-item text-dark" href="members.php?do=edit&userid=<?php echo $_SESSION['ID'] ?>">Edit profile</a>
            <a class="dropdown-item text-dark" href="#">Settings</a>
            <a class="dropdown-item text-dark" href="logout.php">Logout </a>
          </div>
        </li>
      </ul>
    </div>

  </div>
</nav>


<?php
    include $tpl.'footer.php';
?>
