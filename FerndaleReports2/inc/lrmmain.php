<?php
ini_set("session.gc_maxlifetime", "3600");
require_once  ("inc/utils.php");


session_start();

$msg_status='';

$username=$_SESSION['username'];

//logout
if (isset($_REQUEST["logout"])){
	session_unset();
	session_destroy();
}
//back to index.html
if (!session_is_registered($username)) {
	header("Location:index.php");}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Labor&Material Field Report </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
<!--    <link rel="shortcut icon" href="../assets/ico/favicon.ico">-->
    <link rel="stylesheet" href="datatables/media/css/demo_page.css">
<link rel="stylesheet" href="datatables/media/css/demo_table.css">


<script src="js/jquery-1.7.1.min.js">
        </script>

<script type="text/javascript"
	src="datatables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript">

        $(document).ready(function() {
        	$('#master_table').dataTable( {
        		"bProcessing": true,
        		"bServerSide": true,
        		"sAjaxSource": "inc/data_source_flm_master.php"
        	} );    
        	  
			
        	  
                
            } );

		$('#user_table tbody tr').live('click', function () {
            
            var nTds = $('td', this);
            var id = $(nTds[0]).text();
            var username = $(nTds[1]).text();
            var userpass= $(nTds[2]).text();
            var userfname = $(nTds[3]).text();
            var userlname = $(nTds[4]).text(); 

            oFormObject = document.forms['userEdit'];
            oFormObject.elements["edit_id"].value = id;
            oFormObject.elements["edit_pass"].value = userpass;
            oFormObject.elements["edit_name"].value = username;
            oFormObject.elements["edit_fname"].value = userfname;
            oFormObject.elements["edit_lname"].value = userlname;
            

            
            
            
        } );

		
        	
        </script>
    
    
    
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">eReports</a>
          <div class="btn-group pull-right">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="icon-user"></i> Loged as: <?php echo $username?>
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <!--<li><a href="#">Profile</a></li>
              <li class="divider"></li>
              --><li><a href="main.php?logout=true">Sign Out</a></li>
            </ul>
          </div>
          
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">User Management</li>
              <li class="active"> <a href="user.php">User</a></li>
              
              
              <li class="nav-header">Reports</li>
              <li><a href="#">Labor&Material Field Report</a></li>
              <li class="nav-header">Downloads</li>
              <li><a href="apk/FerndaleForms2.apk">Mobile application</a></li>
              <li class="nav-header">Main</li>
              <li><a href="main.php">Home</a></li>
              
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
          <div class="hero-unit">
            
            <h2>Labor&Material Field Reports</h2>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              </div>
          <div class="row-fluid">
            <div class="span4">
              <p>REPORTS OVERVIEW:</p>
              <table id="master_table" class="display">
				<thead>
					<tr>
						<th>Id</th>
						<th>Customer</th>
						<th>Date</th>
						<th>JobNumber</th>
						<th>JobName</th>
						<th>JobLocation</th>
						
						<th>Fec Manager</th>
						<th>CustomerOrd.Nr.</th>
						<th>Work performed</th>
						<th>Work complete</th>
						
						
			
					</tr>
				</thead>
				<tbody>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						
						
						
			
					</tr>
			
				</tbody>
			</table>
              
            </div><!--/span-->
            
          </div><!--/row-->
          <div class="row-fluid">
            
            
          </div><!--/row-->
        </div><!--/span-->
      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; Ferndale Electric 2012,developed by Cvirn.com</p>
      </footer>
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-1.7.1.js"></script>
    <script src="js/bootstrap-transition.js"></script>
    <script src="js/bootstrap-alert.js"></script>
    <script src="js/bootstrap-modal.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-scrollspy.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/bootstrap-popover.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <script src="js/bootstrap-collapse.js"></script>
    <script src="js/bootstrap-carousel.js"></script>
    <script src="js/bootstrap-typeahead.js"></script>

  </body>
</html>
