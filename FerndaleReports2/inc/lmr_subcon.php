<?php
require_once("php/Sql.php");

class lmr_subcon
{
	
	public $uid;
	private $db;
	
	
	
	
	public function __construct($u){
		$this->uid=$u;
		$this->db="apps_forms";
	}
	
	public function setSubCon($n,$a,$jnr){
		
		
	try{
		 $created=time();
		 $this->oSql=new Sql($this->db);
		 $this->oSql->setErrorhandling(true, true);
		 $this->sSql="INSERT IGNORE INTO flm_report_sub_con (job_nr,name,amount,created)
				             VALUES('".$jnr."',
				             	    '".$n."',
				             	    '".$a."',
				             	    '".$created."'
				             	    
				                    ) ";
		 $this->oSql->q($this->sSql);
		 return true;
		 }
		 catch (Exception $e){
		 	
		 	return false;
		 }
		
		
	}
	
	
	
	
	
}
?>