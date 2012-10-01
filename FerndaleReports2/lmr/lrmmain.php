<?php
ini_set("session.gc_maxlifetime", "3600");
require_once  ("../inc/utils.php");
require '../inc/lmr_update.php';


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
	header("Location:../index.php");}

/////////////////////////////////////
///Data update section
	
	if (isset($_POST["SubmitReportDetails"])){
		
		$oUpdater=new lmr_update('none');
		$jobnr=$_POST['report_jobn'];
		$tax=$_POST['sales_tax'];
		$over=$_POST['overhead_profit'];
		$oUpdater->setReport($jobnr, $tax, $over);
		
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
    <link href="../css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="../css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
<!--    <link rel="shortcut icon" href="../assets/ico/favicon.ico">-->
    <link rel="stylesheet" href="../datatables/media/css/demo_page.css">
<link rel="stylesheet" href="../datatables/media/css/demo_table.css">


<script src="../js/jquery-1.7.1.min.js">
        </script>
        <script src="../js/jquery.dataTables.columnFilter.js" type="text/javascript"></script>
        

<script type="text/javascript"
	src="../datatables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript">

        $(document).ready(function() {
        	$('#master_table').dataTable( {
        		"bProcessing": true,
        		"bServerSide": true,
        		
        		"sAjaxSource": "../inc/data_source_flm_master.php",
        		"aaSorting": [[ 1, "asc" ]],
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
            var tax=$(nTds[10]).text();
            var profit=$(nTds[11]).text();
            var dataString = 'job_nr='+jobnr;
            
            oFormObject = document.forms['reportEdit'];
            oFormObject.elements["report_jobn"].value = jobnr;
            oFormObject.elements["sales_tax"].value = tax;
            oFormObject.elements["overhead_profit"].value = profit;

            oFormObject = document.forms['reportDetail'];
            oFormObject.elements["report_jobn"].value = jobnr;

			
            
            
            
        } );
		
		
		
		
		
        	
        --></script>
    
    
    
  </head>

  <body>

    <?php include '../nav/navigation2.php'?>

    <div class="container-fluid">
      <div class="row-fluid">
        
        <div class="span9">


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
						<th>Sales Tax</th>
						<th>Overhead & Profit</th>
						
			
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
						<td></td>
						
						
						
			
					</tr>
			
				</tbody>
			</table>
			<table class="table-bordered">
			<form name="reportEdit" action="<?php echo($PHP_SELF)?>" method="post" >
			<tr><td><span class="label label-info">Field Report Details Section</span>
			</td>
			</tr>
			<tr class="success"><td>
			<label for="report_jobn" style="color: blue;"> Job Number: </label>
			<input id="report_jobn" value="" type="text" name="report_jobn" readonly="readonly"  />
			</td>
			</tr>
			<!--Inputs  -->
			<tr class="success"><td>
			<label for="sales_tax" style="color: blue;"> Sales TAX </label> <input
				id="sales_tax" value="0" type="text" name="sales_tax" />
			</td>
			<td>
			<label for="overhead_profit" style="color: blue;">Overhead&Profit </label> <input
				id="overhead_profit" value="0" type="text" name="overhead_profit" />
				</td>
			</tr>
			<!--Button  -->
			<tr class="success"><td>
			<button type="submit" class="btn btn-success"  value="Submit"  name="SubmitReportDetails">Update Report</button>
			</td>	
			</tr>
			
			</form>
			</table>
			
			<!-- form2  -->
			<table class="table-bordered">
			<form name="reportDetail" action="../lmr/lmreditor.php" method="post" >
			<tr><td><span class="label label-info">Field Report to edit:</span>
			</td></tr>
			<tr class="info"><td>
			<label for="report_jobn" style="color: blue;"> Job Number: </label>
			<input id="report_jobn" value="" type="text" name="report_jobn" readonly="readonly"  />
			</td>
			</tr>
			<!--Inputs  -->
			
			<!--Button  -->
			<tr><td>
			<button type="submit" class="btn btn-success"  value="Submit"  name="EditReportDetails">Edit Report Details</button>
			</td>	
			</tr>
			
			</form>
			
			</table>
			
			</br>
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
    
    
    <script src="../js/bootstrap-alert.js"></script>
    <script src="../js/bootstrap-modal.js"></script>
    <script src="../js/bootstrap-dropdown.js"></script>
    <script src="../js/bootstrap-scrollspy.js"></script>
    <script src="../js/bootstrap-tab.js"></script>
    <script src="../js/bootstrap-tooltip.js"></script>
    <script src="../js/bootstrap-popover.js"></script>
    <script src="../js/bootstrap-button.js"></script>
    <script src="../js/bootstrap-collapse.js"></script>
    <script src="../js/bootstrap-carousel.js"></script>
    <script src="../js/bootstrap-typeahead.js"></script>

  </body>
</html>
