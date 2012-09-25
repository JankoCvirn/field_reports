<?php
ini_set("session.gc_maxlifetime", "3600");
require_once  ("../inc/utils.php");

setlocale(LC_MONETARY, 'en_US');

session_start();


$msg_status='';

$username=$_SESSION['username'];
$user_name = "root";
$password = "electricapps";
$database = "apps_forms";
$server = "localhost";

$total=0;
$total_equip=0;
$total_mat=0;
$total_subcon=0;
//logout
if (isset($_REQUEST["logout"])){
	session_unset();
	session_destroy();
}
//back to index.html
if (!session_is_registered($username)) {
	header("Location:index.php");}
	
	/////////////////////////////////////
	///Populate arrays from DB
	///1.Job
	///2.Labor
	///3.Material
	///4.Equipment
	///5.SubContractor

if (isset($_POST['SubmitReportCreate'])){
	ob_start();
	$job_number=$_POST['job_number'];
	$job_number=trim($job_number);
	
	
	
	////////////////////////////////////
	//Section 2-5
	
	//Labor
	$db_handle = mysql_connect($server, $user_name, $password);
	$db_found = mysql_select_db($database, $db_handle);
	
	if ($db_found) {
	
		$SQL = "SELECT * FROM apps_forms.report_labor2 where job_nr='".$job_number."'     ";
		$result = mysql_query($SQL);
	
		while ($db_row = mysql_fetch_assoc($result)) {
			$rezultati_pretrage_labor[] = $db_row;
	
		}
		mysql_close($db_handle);
	
	}
	else {
		print "Database NOT Found ";
		mysql_close($db_handle);
	}
	
	
	//Material
	$db_handle = mysql_connect($server, $user_name, $password);
	$db_found = mysql_select_db($database, $db_handle);
	
	if ($db_found) {
	
		$SQL = "SELECT * FROM apps_forms.report_material2 WHERE job_nr='".$job_number."' ORDER BY id ASC   ";
		$result = mysql_query($SQL);
	
		while ($db_row = mysql_fetch_assoc($result)) {
			$rezultati_pretrage_material[] = $db_row;
	
		}
		mysql_close($db_handle);
	
	}
	else {
		print "Database NOT Found ";
		mysql_close($db_handle);
	}
	
	
	//Equipment
	$db_handle = mysql_connect($server, $user_name, $password);
	$db_found = mysql_select_db($database, $db_handle);
	
	if ($db_found) {
	
		$SQL = "SELECT * FROM apps_forms.report_equip WHERE job_nr='".$job_number."' ORDER BY id ASC   ";
		$result = mysql_query($SQL);
	
		while ($db_row = mysql_fetch_assoc($result)) {
			$rezultati_pretrage_equip[] = $db_row;
	
		}
		mysql_close($db_handle);
	
	}
	else {
		print "Database NOT Found ";
		mysql_close($db_handle);
	}
	
	
	//SubContractor
	$db_handle = mysql_connect($server, $user_name, $password);
	$db_found = mysql_select_db($database, $db_handle);
	
	if ($db_found) {
	
		$SQL = "SELECT * FROM apps_forms.report_subcon WHERE job_nr='".$job_number."' ORDER BY id ASC    ";
		$result = mysql_query($SQL);
	
		while ($db_row = mysql_fetch_assoc($result)) {
			$rezultati_pretrage_subcon[] = $db_row;
	
		}
		mysql_close($db_handle);
	
	}
	else {
		print "Database NOT Found ";
		mysql_close($db_handle);
	}
	
	//JobDetails
	$db_handle = mysql_connect($server, $user_name, $password);
	$db_found = mysql_select_db($database, $db_handle);
	
	if ($db_found) {
	
		$SQL = "SELECT * FROM apps_forms.report_main2 WHERE job_number='".$job_number."'  ";
		$result = mysql_query($SQL);
	
		while ($db_row = mysql_fetch_assoc($result)) {
			$rezultati_pretrage_job[] = $db_row;
	
		}
		mysql_close($db_handle);
	
	}
	else {
		print "Database NOT Found ";
		mysql_close($db_handle);
	}
	
	//$content=ob_get_contents();
	//file_put_contents("test.html", $content);
	
	
}	
	
	
	//Section 1-initialy populated
	$db_handle = mysql_connect($server, $user_name, $password);
	$db_found = mysql_select_db($database, $db_handle);
	
	if ($db_found) {
	
		$SQL = "SELECT * FROM apps_forms.report_main2 ORDER BY job_number ASC   ";
		$result = mysql_query($SQL);
	
		while ($db_row = mysql_fetch_assoc($result)) {
			$rezultati_pretrage[] = $db_row;
	
		}
		mysql_close($db_handle);
		
		}
		else {
			print "Database NOT Found ";
			mysql_close($db_handle);
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

function publish(){

    $.ajax({
       type: 'POST',
       url: '	test.php',
       data: {
           html: $('body').html()
       }
    });        
	}

        </script>
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
    
    
  </head>
  
  <body>

    <?php include '../nav/navigation2.php'?>

<div class="row-fluid"> 
            <div class="span9">
            <form action="<?php echo($PHP_SELF)?>" method="post">
            
            <legend><span class="label label-info">Labor&Material Report generator.</span></legend>
            <select title="Select Job-Number:" name="job_number">
            <?php foreach ($rezultati_pretrage as $order2): ?>
                <option value="<?php echo $order2['job_number'] ?>"><?php echo $order2['job_number'] ?> </option>                
            <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-success"  value="Create Report"  name="SubmitReportCreate">Create Report</button>
			
            </form>
            
			Selected Job Number: <?php echo $job_number;?>
            </div>
            
</div><!--/row-->
          <div class="row-fluid">
            <div class="span4">
            <table class="table table-striped table-bordered table-condensed">
            <tr>
            <td colspan="2">
            <table class="table">
            
            
            <?php foreach ($rezultati_pretrage_job as $o5):?>
            <tr>
	            <td>Customer: <?php echo $o5['customer'];?></td>
	            <td>Date:<?php echo $o5['date'];?></td>
	            <td>JOB NUMBER:<?php echo $o5['job_number'];?></td>
            
            </tr>
            <tr>
	            <td>Job Name: <?php echo $o5['job_name'];?></td>
	            <td></td>
	            <td>FEC PROJECT MANAGER:<?php echo $o5['fec_project_manager'];?></td>
            
            </tr>
            <tr>
	            <td>Job Location: <?php echo $o5['job_location'];?></td>
	            <td></td>
	            <td>CUSTOMER ORDER No.:<?php echo $o5['customer_order_no'];?></td>
            
            </tr>
            <tr>
	            <td colspan="3">WORK PERFORMED: <?php echo $o5['work_performed'];?></td>
	            
            
            </tr>
            
            
            <?php endforeach;?>
            
            
            
            </table>
            
            
            </td>
            </tr>
            <tr>
            <td>
            <!-- Labor table -->
            <table class="table">
            <tr>
             <th>Worker Name</th>
             <th></th>
             <th>HRS.</th>
             <th>RATE</th>
             <th>AMOUNT</th>
            </tr>
            
            <?php foreach ($rezultati_pretrage_labor as $o1):?>
            <tr>
            <td><?php echo $o1['name'];?></td>
            <td>ST.</td>
            <td><?php echo $o1['stime'];?></td>
            <td><?php echo $o1['st_rate'];?></td>
            <td><?php echo $o1['ST'];?></td>
            </tr>
            <tr>
            <td></td>
            <td>1½T.</td>
            <td><?php echo $o1['htime'];?></td>
            <td><?php echo $o1['ht_rate'];?></td>
            <td><?php echo $o1['HT'];?></td>
            </tr>
            <tr>
            <td></td>
            <td>DT.</td>
            <td><?php echo $o1['dtime'];?></td>
            <td><?php echo $o1['dt_rate'];?></td>
            <td><?php echo $o1['DT'];?></td>
            </tr>
            <?php $total=$total+$o1['Total'];?>
            <?php endforeach;?>
            <tr>
            <td colspan="3">TOTAL LABOR </td>
            <td colspan="2"><?php echo money_format('%i', $total);?></td> 
            </tr>
            
            
            
            </table>
            </td>
            <td>
            <!-- Material table -->
            <table class="table">
            
            <tr>
            <th>QTY</th>
            <th>MATERIAL</th>
            <th>PRICE</th>
            <th>PER</th>
            <th>EXTENSION</th>
            </tr>
            
            <?php foreach ($rezultati_pretrage_material as $o2):?>
            <tr>
            <td><?php echo $o2['amount'];?></td>
            <td><?php echo $o2['name'];?></td>
            <td><?php echo $o2['rate'];?></td>
            <td>
            <?php if ($o2['per']==0.001){
            	
            	echo 'M';
            	
                }
                elseif ($o2['per']==0.01){
                	echo 'C';
                }
                elseif ($o2['per']==1){
                	echo 'E';
                }
                ;
            
            
            ?></td>
            <td><?php echo $o2['total'];?></td>
            </tr>
            
            <?php $subtotal_mat=$subtotal_mat+$o2['total']?>
            <?php endforeach;?>
            <tr>
            <td colspan="4">SUBTOTAL MATERIAL
            </td>
            <td><?php echo money_format('%i', $subtotal_mat);?></td>
            </tr>
            </table>
            </td>
            </tr>
            
            <tr>
            
            <!-- Equipment -->
            <td>
            <table class="table">
            
            <tr>
            <th>EQUIPMENT</th>
            <th>HRS.</th>
            <th>RATE</th>
            <th>AMOUNT</th>
            
            </tr>
            
            <?php foreach ($rezultati_pretrage_equip as $o3):?>
            <tr>
            <td><?php echo $o3['name'];?></td>
            <td><?php echo $o3['amount'];?></td>
            <td><?php echo $o3['rate'];?></td>
            <td><?php echo $o3['total'];?></td>
            
            </tr>
            
            <?php $total_equip=$total_equip+$o3['total']?>
            <?php endforeach;?>
            
	        <tfoot>
				<tr>
				  <td colspan="2">TOTAL EQUIPMENT </td>
				  <td colspan="2"><?php echo money_format('%i', $total_equip);?></td>
				</tr>
			</tfoot>
            </table>
            
            </td>
            
            <!-- SubCon -->
            <td>
            <table class="table">
            
            <tr>
            <th>SubContractor</th>
            <th>HRS.</th>
            <th>RATE</th>
            <th>AMOUNT</th>
            
            </tr>
            
            <?php foreach ($rezultati_pretrage_subcon as $o4):?>
            <tr>
            <td><?php echo $o4['name'];?></td>
            <td><?php echo $o4['amount'];?></td>
            <td><?php echo $o4['rate'];?></td>
            <td><?php echo $o4['total'];?></td>
            
            </tr>
            
            <?php $total_subcon=$total_subcon+$o4['total']?>
            <?php endforeach;?>
            
            
            <tfoot>
				<tr>
				  <td colspan="2">TOTAL SUBCONTRACTOR </td>
				  <td colspan="2"><?php echo money_format('%i', $total_subcon);?></td>
				</tr>
			</tfoot>
            </table>
            
            
            
            </td></tr>
            
            <tr>
            <td>
            <!-- SUMMARY SECTION -->
            	<table class="table">
            
		            <tr>
		             
		             <td>
		              SALES TAX
		             </td>
		             <td><?php echo money_format('%i',(($subtotal_mat*$o5['sales_tax'])/100));?></td>
		            
		            </tr>
		            <tr>
		             
		             <td>
		              OVERHEAD&PROFIT
		             </td>
		             <td><?php echo money_format('%i',(($subtotal_mat*$o5['overhead_profit'])/100));?></td>
		            
		            </tr>
		            
		            <tr>
		             
		             <td>
		              TOTAL MATERIAL
		             </td>
		             <td><?php echo money_format('%i',$subtotal_mat+($subtotal_mat*$o5['sales_tax'])/100+($subtotal_mat*$o5['overhead_profit'])/100);?></td>
		            
		            </tr>
		            <tr>
		             
		             <td colspan="2">
		              SUMMARY
		             </td>
		             
		            
		            </tr>
		            
		            <tr>
		             
		             <td>
		              TOTAL LABOR
		             </td>
		             <td><?php echo money_format('%i',$total);?></td>
		            
		            </tr>
		            <tr>
		             
		             <td>
		              TOTAL EQUIPMENT
		             </td>
		             <td><?php echo money_format('%i',$total_equip);?></td>
		            
		            </tr>
		            <tr>
		             
		             <td>
		              TOTAL MATERIAL	
		             </td>
		             <td>
		             <?php $total_mat=$subtotal_mat+($subtotal_mat*$o5['sales_tax'])/100+($subtotal_mat*$o5['overhead_profit'])/100;?>
		             <?php echo money_format('%i',$total_mat);?></td>
		            
		            </tr>
		            
		            <tr>
		             
		             <td>
		              TOTAL SUBCONTRACTOR
		             </td>
		             <td><?php echo money_format('%i',$total_subcon);?></td>
		            
		            </tr>
		            
		            <tr>
		             
		             <td>
		              GRAND TOTAL
		             </td>
		             <td><?php echo money_format('%i',$total+$total_equip+$total_mat+$total_subcon);?></td>
		            
		            </tr>
		            
		            
            </table>
            </td>
            <td>
            <table>
            <tr><td>Customer Signature<td></tr>
            <tr><img src="<?php echo "../signature/".$job_number.'Signature.jpg'?>" alt="Customer signature." width="304" height="228" ></tr>
            </table>
            
            
            
            </td>
            
            </tr>
            
            
            </table>
            <button id="publish" type="submit" class="btn btn-success"  value="Publish Report"  name="SubmitReportPublish" onclick="publish()">Publish Report</button>
			<p>
			 <a href="../report_publisher/testfile.pdf">View PDF</a>
			
            </div><!--/span-->
            
          </div><!--/row-->
        
        <!--Material  -->
        <div class="row-fluid">
            <div class="span4">
              
			</div>
			</div>
			<!--Equipment table  -->
			
			<div class="row-fluid">
            <div class="span4">
               
            </div><!--/span-->
            
          </div><!--/row-->
          
          <!--SubCon table  -->
          
          <div class="row-fluid">
            <div class="span4">
            		
              
            </div><!--/span-->
            
          </div><!--/row-->
               
            </div><!--/span-->
            </div>
          </div><!--/row-->  
          
         
          
        </div><!--/span-->
      </div><!--/row-->

      <hr>

      <?php include '../nav/footer.php';?>
    </div> <!-- /container -->

    
    
    
    

  </body>
</html>
