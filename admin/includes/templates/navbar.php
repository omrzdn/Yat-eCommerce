
<nav class="navbar navbar-expand-lg navbar-inverse bg-dark">
 
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link navbar-brand" href="dashboard.php"><?php echo lang('home_admin')?> <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><?php echo lang('categories')?></a>
      </li>
      <li ><a class="dropdown-item" href="#"><?php echo lang('ITEMS')?></a></li>
      <li ><a class="dropdown-item" href="#"> <?php echo lang('STATISTICS')?></a></li>  
      <li ><a class="dropdown-item" href="#"> <?php echo lang('MEMBERS')?></a></li>
      <li><a class="dropdown-item" href="#"> <?php echo lang('MEMBERS')?></a></li>
      <li><a class="dropdown-item" href="#"> <?php echo lang('LOGS')?></a></li>
      
      
       
       
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo lang('dropdown')?>
        </a>
      
      
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="members.php?do=edit&userid=<?php echo $_SESSION['ID'] ?>">Edit profile</a>
          <a class="dropdown-item" href="#"> Settings</a>
          <a class="dropdown-item" href="logout.php">Logout </a>
        </div>
      </li>
      
    </ul>
    
  </div>
</nav>
  
