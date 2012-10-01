<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#"><?php echo $brand_text;?></a>

<div class="nav-collapse collapse">
            <ul class="nav">
              <li ><a href="main.php"><i class="icon-home icon-white"></i>Home</a></li>
              <?php if ($username=='admin') :?>
              
              <li><a href="user.php"><i class="icon-user icon-white"></i>User Manager</a></li>
              
              <?php endif;?>
              
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-tasks icon-white"></i>Report Manager<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="../lmr/lrmmain.php">LM Field Report Creator</a></li>
	              <li><a href="../report_publisher/lrm_publisher.php">LM Field Report Publisher</a></li>
                </ul>
              </li>
             <li><a href="../apk/FerndaleForms2.apk"><i class="icon-download-alt icon-white"></i>Mobile application</a></li>
             <li><a href=""><i class="icon-book icon-white"></i>Help topics</a></li>
            </ul>
            <div class="btn-group pull-right">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="icon-user "></i> Loged as: <?php echo $username?>
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <!--<li><a href="#">Profile</a></li>
              <li class="divider"></li>
              --><li><a href="../main.php?logout=true"><i class="icon-off "></i>Sign Out</a></li>
            </ul>
          </div>
            
          </div>
          </div>
      </div>
    </div>
          
