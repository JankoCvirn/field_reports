<?php
ini_set("session.gc_maxlifetime", "3600");
require_once  ("inc/utils.php");
require 'inc/lmr_update.php';


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

	/////////////////////////////////////
	///Data update section
	
	//Labor data
	if (isset($_POST["SubmitLabor"])){
		$oUpdater=new lmr_update();
		
		$id=$_POST['labor_id'];
		$jobnr=$_POST['labor_jobnr'];
		$st=$_POST['labor_st'];
		$ht=$_POST['labor_ht'];
		$dt=$_POST['labor_dt'];
		$oUpdater->setLabor($id,$jobnr,$st,$ht,$dt);
		
	}
	
	//Material data
	if (isset($_POST["SubmitMaterial"])){
		$oUpdater=new lmr_update();
		
		$id=$_POST['material_id'];
		$jobnr=$_POST['material_jobnr'];
		$cost=$_POST['material_cost'];
		$per=$_POST['material_per'];
		$ext=$_POST['material_ext'];
		//$cost= doubleval($cost);
		$oUpdater->setMaterial($id,$jobnr,$cost,$ext,$per);
	
	}
	
	//Equipment data
	if (isset($_POST["SubmitEqp"])){
		$oUpdater=new lmr_update();
		$id=$_POST['eqp_id'];
		$jobnr=$_POST['eqp_jobnr'];
		$cost=$_POST['eqp_cost'];
		//$cost= doubleval($cost);
		$oUpdater->setEqp($id,$jobnr,$cost);
	}
	
	//SubCon data
	if (isset($_POST["SubmitSub"])){
		$oUpdater=new lmr_update();
		$id=$_POST['sub_id'];
		$jobnr=$_POST['sub_jobnr'];
		$cost=$_POST['sub_cost'];
		//$cost= doubleval($cost);
		$oUpdater->setSub($id,$jobnr,$cost);
	}
	
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
        <script src="js/jquery.dataTables.columnFilter.js" type="text/javascript"></script>
        

<script type="text/javascript"
	src="datatables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript">

        $(document).ready(function() {
        	$('#master_table').dataTable( {
        		"bProcessing": true,
        		"bServerSide": true,
        		
        		"sAjaxSource": "inc/data_source_flm_master.php",
        		"aaSorting": [[ 4, "asc" ]],
        		"bJQueryUI": true,
                "bStateSave": true,
                "bAutoWidth": false,
                
        		} 
				


        	).columnFilter({aoColumns:[
        	           				{ sSelector: "#JobNumberFilter", type:"select"  },
        	        				{ sSelector: "#CustomerNameFilter", type:"select" } 
        	        				
        	        				]}
        	        			);  

        	

        	
        	
        	  
                
            } );

		
		$('#master_table tbody tr').live('click', function () {
			
            var nTds = $('td', this);
            var jobnr = $(nTds[3]).text();
            var dataString = 'job_nr='+jobnr;
            
            oFormObject = document.forms['reportEdit'];
            oFormObject.elements["report_jobn"].value = jobnr;

            $('#labor_table').dataTable( {
            	"bDestroy":true,
                "bServerSide": true,
                "bRegex":false,
                "sAjaxSource": "inc/data_source_flm_labor.php",
                "oSearch": {"sSearch": jobnr}
                
              } );

            $('#material_table').dataTable( {
            	"bDestroy":true,
                "bServerSide": true,
                "bRegex":false,
                "sAjaxSource": "inc/data_source_flm_mat.php",
                "oSearch": {"sSearch": jobnr}
                
              } );
            $('#equipment_table').dataTable( {
            	"bDestroy":true,
                "bServerSide": true,
                "bRegex":false,
                "sAjaxSource": "inc/data_source_flm_equip.php",
                "oSearch": {"sSearch": jobnr}
                
              } );
            $('#subcontractor_table').dataTable( {
            	"bDestroy":true,
                "bServerSide": true,
                "bRegex":false,
                "sAjaxSource": "inc/data_source_flm_subcon.php",
                "oSearch": {"sSearch": jobnr}
                
              } );

			
            
            
            
        } );
		//Labor edit form 
		$('#labor_table tbody tr').live('click', function () {

			//get data
			var nTds = $('td', this);
			var id=$(nTds[0]).text();
		    var jobnr = $(nTds[1]).text();
			var workername=$(nTds[2]).text();
	        

            //show data
            oFormObject = document.forms['laborEdit'];
            oFormObject.elements["labor_id"].value = id;
            oFormObject.elements["labor_jobnr"].value = jobnr;
            oFormObject.elements["labor_worker"].value = workername;

			});
		//Material edit form
		$('#material_table tbody tr').live('click', function () {

			//get data
			var nTds = $('td', this);
			var id=$(nTds[0]).text();
		    var jobnr = $(nTds[1]).text();
			var matname=$(nTds[2]).text();
	        

            //show data
            oFormObject = document.forms['materialEdit'];
            oFormObject.elements["material_id"].value = id;
            oFormObject.elements["material_jobnr"].value = jobnr;
            oFormObject.elements["material_name"].value = matname;

			});
		//Equipment edit form
		$('#equipment_table tbody tr').live('click', function () {

			//get data
			var nTds = $('td', this);
			var id=$(nTds[0]).text();
		    var jobnr = $(nTds[1]).text();
			var eqpname=$(nTds[2]).text();
	        

            //show data
            oFormObject = document.forms['eqpEdit'];
            oFormObject.elements["eqp_id"].value = id;
            oFormObject.elements["eqp_jobnr"].value = jobnr;
            oFormObject.elements["eqp_name"].value = eqpname;

			});
		//SubContractor edit
		$('#subcontractor_table tbody tr').live('click', function () {

			//get data
			var nTds = $('td', this);
			var id=$(nTds[0]).text();
		    var jobnr = $(nTds[1]).text();
			var subname=$(nTds[2]).text();
	        

            //show data
            oFormObject = document.forms['subEdit'];
            oFormObject.elements["sub_id"].value = id;
            oFormObject.elements["sub_jobnr"].value = jobnr;
            oFormObject.elements["sub_name"].value = subname;

			});

		
        	
        --></script>
    
    
    
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
          <?php include 'nav/navigation.php'?>
        </div><!--/span-->
        <div class="span9">
<!--           <div class="hero-unit"> -->
            
<!--             <h2>Labor&Material Field Reports</h2> -->
<!--               <p> </p> -->
<!--               </div> -->

<div class="row-fluid"> 
            <div class="span9">
              <p><strong>REPORTS OVERVIEW:</strong></p>
              <table id="master_table" class="display">
				<thead>
					<tr>
						<th>SystemId</th>
						<th>Customer </th>
						<th>Job Date </th>
						<th>Job Number </th>
						<th>Job Name</th>
						<th>Job Location</th>
						
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
			<form name="reportEdit" action="<?php echo($PHP_SELF)?>" method="post" >
			<br>
			<div class="well well-small">
			<legend><span class="label label-info">Field Report Details Section for JobNumber:</span></legend>
			<input
			id="report_jobn" value="" type="text" name="report_jobn" readonly="readonly"  />
			
			
			</form>
			
            </div><!--/span-->
            
          </div><!--/row-->
          <div class="row-fluid">
            <div class="span4">
              <p><span class="label label-important">Labor Details</span></p>
              <table id="labor_table" class="display">
				<thead>
					<tr>
						<th>Id</th>
						<th>JobNr</th>
						<th>Worker</th>
						<th>S.T.</th>
						<th>Rate</th>
						<th>1½T.</th>
						<th>Rate</th>
						<th>2T.</th>
						<th>Rate</th>
						<th>Total</th>
						<th>Created</th>
						
						
			
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
						<td></td>
						
						
						
			
					</tr>
			
				</tbody>
			</table>
            <p></p>
            <table>
            <form name="laborEdit" action="<?php echo($PHP_SELF)?>" method="post" >
				<legend>Set worker time rates</legend>
				
				<tr>
				<td><label for="labor_id" style="color: blue;"> LaborID: </label> 
				<input
				id="labor_id" value="" type="text" name="labor_id" readonly="readonly" />
				</td>
				<td>
				<label for="labor_jobnr" style="color: blue;"> JobNr: </label> <input
				id="labor_jobnr" value="" type="text" name="labor_jobnr" readonly="readonly" />
				</td>
				<td>
				<label for="labor_worker" style="color: blue;"> Worker: </label> <input
				id="password" value="" type="text" name="labor_worker" readonly="readonly" />
				</td>
				</tr>
				<tr>
				<td>
				<label for="labor_st" style="color: blue;"> S. T. rate: </label> <input
				id="labor_st" value="" type="text" name="labor_st" />
				</td>
				<td>
				<label for="labor_ht" style="color: blue;"> 1½ T. rate: </label> <input
				id="labor_ht" value="" type="text" name="labor_ht" />
				</td>
				<td>
				<label for="labor_dt" style="color: blue;"> 2 T. rate: </label> <input
				id="labor_dt" value="" type="text" name="labor_dt" />
				</td>
				</tr>
				<tr><td>
				<button type="submit" class="btn btn-success"  value="Submit"  name="SubmitLabor">Update Labor</button>
				</td></tr>
			</form>
            </table>
            
              
            </div><!--/span-->
            
          </div><!--/row-->
        
        <!--Material  -->
        <div class="row-fluid">
            <div class="span4">
              <legend><p><span class="label label-important">Material Details</span></p></legend>
              <table id="material_table" class="display">
				<thead>
					<tr>
						<th>Id</th>
						<th>JobNr</th>
						<th>Material</th>
						<th>Amount</th>
						<th>Price</th>
						<th>Per</th>
						<th>Extension</th>
						<th>Total</th>
						
			
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
						
						
						
						
			
					</tr>
			
				</tbody>
			</table>
			<table>
			<form name="materialEdit" action="<?php echo($PHP_SELF)?>" method="post" >
				<tr><legend>Set material costs</legend>
				</tr>
				<tr>
				<td>
				<label for="material_id" style="color: blue;"> MaterialID: </label> 
				<input
				id="material_id" value="" type="text" name="material_id" readonly="readonly"  />
				</td>
				<td>
				<label for="material_jobnr" style="color: blue;"> JobNr: </label> <input
				id="material_jobnr" value="" type="text" name="material_jobnr" readonly="readonly" />
				</td>
				<td>
				<label for="material_name" style="color: blue;"> Material: </label> <input
				id="password" value="" type="text" name="material_name" readonly="readonly" />
				</td>
				</tr>
				<tr><td>
				<label for="material_cost" style="color: blue;"> Price: </label> <input
				id="material_cost" value="" type="text" name="material_cost" />
				</td>
				<td>
				<label for="material_per" style="color: blue;"> PER: </label> <input
				id="material_per" value="" type="text" name="material_per" />
				</td>
				<td>
				<label for="material_ext" style="color: blue;"> EXTENSION: </label> <input
				id="material_ext" value="" type="text" name="material_ext" />
				</td>
				</tr>
				<tr>
				<td>
				<button type="submit" class="btn btn-success"  value="Submit"  name="SubmitMaterial">Update Material</button>
				<td>
				</tr>
			</form>
			</table>
			</div>
			</div>
			<!--Equipment table  -->
			
			<div class="row-fluid">
            <div class="span4">
              <legend><p><span class="label label-important">Equipment Details</span></p></legend>
              <table id="equipment_table" class="display">
				<thead>
					<tr>
						<th>Id</th>
						<th>JobNr</th>
						<th>Equipment</th>
						<th>HRS.</th>
						<th>Rate</th>
						<th>Amount</th>
						
						
						
			
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
						</tr>
			
				</tbody>
			</table>
			<table>
			<form name="eqpEdit" action="<?php echo($PHP_SELF)?>" method="post" >
				<tr><legend>Set equipment costs</legend></tr>
				<tr>
				<td>
				<label for="eqp_id" style="color: blue;"> eqpID: </label> 
				<input
				id="eqp_id" value="" type="text" name="eqp_id" readonly="readonly" />
				</td>
				<td>
				<label for="eqp_jobnr" style="color: blue;"> JobNr: </label> <input
				id="eqp_jobnr" value="" type="text" name="eqp_jobnr" readonly="readonly" />
				</td>
				<td>
				<label for="eqp_name" style="color: blue;"> Equipment: </label> <input
				id="eqp_name" value="" type="text" name="eqp_name" readonly="readonly" />
				</td>
				</tr>
				<tr>
				<td>
				<label for="eqp_cost" style="color: blue;"> Rate : </label> <input
				id="eqp_cost" value="" type="text" name="eqp_cost" />
				</td>
				</tr>
				<tr><td><button type="submit" class="btn btn-success"  value="Submit"  name="SubmitEqp">Update Equipment</button>
				</td>
				</tr>
			</form>
            </table>  
            </div><!--/span-->
            
          </div><!--/row-->
          
          <!--SubCon table  -->
          
          <div class="row-fluid">
            <div class="span4">
            <p></p>
              <legend><p><span class="label label-important">SubContractor Details</span></p></legend>
              <table id="subcontractor_table" class="display">
				<thead>
					<tr>
						<th>Id</th>
						<th>JobNr</th>
						<th>SubContractor</th>
						<th>HRS.</th>
						<th>Rate</th>
						<th>Total</th>
						
						
						
			
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
						
						
						
						
			
					</tr>
			
				</tbody>
			</table>
			<table>
				<form name="eqpEdit" action="<?php echo($PHP_SELF)?>" method="post" >
				<tr><legend>Set SubContractor costs</legend>
				</tr>
				<tr>
				<td>
				<label for="sub_id" style="color: blue;"> SubID: </label> 
				<input
				id="sub_id" value="" type="text" name="sub_id" readonly="readonly" />
				</td>
				<td>
				<label for="sub_jobnr" style="color: blue;"> JobNr: </label> <input
				id="sub_jobnr" value="" type="text" name="sub_jobnr" readonly="readonly" />
				</td>
				<td>
				<label for="sub_name" style="color: blue;"> SubContractor: </label> <input
				id="sub_name" value="" type="text" name="sub_name" readonly="readonly" />
				</td>
				</tr>
				<tr><td>
				<label for="sub_cost" style="color: blue;"> SubContractor Cost: </label> <input
				id="sub_cost" value="" type="text" name="sub_cost" />
				</td>
				</tr>
				<tr><td>
				<button type="submit" class="btn btn-success"  value="Submit"  name="SubmitSub">Update SubContractor</button>
				</td></tr>
			</form>
			</table>		
              
            </div><!--/span-->
            
          </div><!--/row-->
               
            </div><!--/span-->
            </div>
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
