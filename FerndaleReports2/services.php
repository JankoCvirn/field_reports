<?php
require 'inc/utils.php';
require 'inc/lmr_report.php';
require 'inc/lmr_labor.php';
require 'inc/lmr_mat.php';
require 'inc/lmr_equip.php';
require 'inc/lmr_subcon.php';


//final static String[] actions= {"setJob","setLabor","setMat","setEquip"};


if (isset($_REQUEST['username']) && isset($_REQUEST['password'])){
	
	$uid='wservice';
	
	$un=$_REQUEST['username'];
	$up=$_REQUEST['password'];
	
	$un=stripslashes($un);
	$up=stripslashes($up);
	
	$objHelper=new utils($un, $up);
	$objHelper->getCheckLogin();
	$allow=$objHelper->login;
	$action=$_REQUEST['action'];
	
	//login method
	if ($action=='getLogin'){
		
		$xmlDoc = new DOMDocument();
		$root = $xmlDoc->appendChild($xmlDoc->createElement("Result"));
		
		if ($allow==1){
			
			
			$actTag=$root->appendChild($xmlDoc->createElement("user"));
			$actTag->appendChild($xmlDoc->createElement("value", "true"));
		}
		else{
			$actTag=$root->appendChild($xmlDoc->createElement("user"));
			$actTag->appendChild($xmlDoc->createElement("value", "false"));
			
		}
		
		header("Content-Type: text/xml");
		$xmlDoc->formatOutput = true;
		echo $xmlDoc->saveXML();
		
	}
	
	
	else if ($action=='getUpload' && $allow==1){
		
		
		$xmlDoc = new DOMDocument();
		$root = $xmlDoc->appendChild($xmlDoc->createElement("Result"));
		
		
		
		     $objHelper->setUploadFile($file_name);
	                 
			 $actTag=$root->appendChild($xmlDoc->createElement("upload"));
			 $actTag->appendChild($xmlDoc->createElement("value", "true"));
			
			
		
		
		header("Content-Type: text/xml");
		$xmlDoc->formatOutput = true;
		echo $xmlDoc->saveXML();
	}
	
	else if ($action=='setLMRJob' && $allow==1){
		
		$objR=new lmr_report($uid);
		$custnr=$_POST['custnr'];
		$fec=$_POST['fec']; 
		$job=$_POST['job']; 
		$dat=$_POST['dat'];
		$work=$_POST['work'];
		$jobl=$_POST['jobl'];
		$jobn=$_POST['jobn'];
		$cust=$_POST['cust'];
		$result=$objR->setNewLMR($custnr, $fec, $job, $dat, $work, $jobl, $jobn, $cust);
		
		
		
		
	}
	else if ($action=='setLMRLabor' && $allow==1 ){
		
		$obj=new lmr_labor($uid);
		$w=$_POST['w'];
		$st=$_POST['st'];
		$ht=$_POST['ht'];
		$dt=$_POST['dt'];
		$jnr=$_POST['jobn'];
		$result=$obj->setNewLabor($w, $st, $ht, $dt, $jnr);
		
	}
	else if ($action=='setLMRMat' && $allow==1){
		$n=$_POST['n'];
		$a=$_POST['a'];
		$jnr=$_POST['jobn'];
		$obj=new lmr_mat($uid);
		$result=$obj->setMat($n, $a, $jnr);
		
	}
	
	else if ($action=='setLMREqu' && $allow==1){
		$n=$_POST['n'];
		$a=$_POST['a'];
		$jnr=$_POST['jobn'];
		$obj=new lmr_equip($uid);
		$result=$obj->setEquip($n, $a, $jnr);
		
	}
	else if ($action=='setLMRSub' && $allow==1){
		$n=$_POST['n'];
		$a=$_POST['a'];
		$jnr=$_POST['jobn'];
		$obj=new lmr_subcon($uid);
		$result=$obj->setSubCon($n, $a, $jnr);
		
		
	}
	
	$xmlDoc = new DOMDocument();
	$root = $xmlDoc->appendChild($xmlDoc->createElement("Result"));
	
		$actTag=$root->appendChild($xmlDoc->createElement("MethodCall"));
		$actTag->appendChild($xmlDoc->createElement("value", $result));
			
	header("Content-Type: text/xml");
	$xmlDoc->formatOutput = true;
	echo $xmlDoc->saveXML();
	
	
}

else 
{
	$xmlDoc = new DOMDocument();
	$root = $xmlDoc->appendChild($xmlDoc->createElement("Result"));
	
		$actTag=$root->appendChild($xmlDoc->createElement("Message"));
		$actTag->appendChild($xmlDoc->createElement("value", "invalid service call"));
			
	header("Content-Type: text/xml");
	$xmlDoc->formatOutput = true;
	echo $xmlDoc->saveXML();
	
	
	
}


?>