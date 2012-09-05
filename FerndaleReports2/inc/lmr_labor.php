<?php
require_once("php/Sql.php");

class lmr_labor
{

	//parameters_labor= {"worker","stime","htime","dtime",};
	private $uid;
	private $db;
	
	
	public function __construct($uid){
		$this->uid=$uid;
		$this->db="apps_forms";
		
	}
	
	public function setNewLabor($w,$st,$ht,$dt,$jnr){
		
	try{
		 $created=time();
		 $this->oSql=new Sql($this->db);
		 $this->oSql->setErrorhandling(true, true);
		 $this->sSql="INSERT INTO flm_report_sub_labor (job_nr,name,stime,htime,dtime,created)
				             VALUES('".$jnr."',
				             	    '".$w."',
				             	    '".$st."',
				             	    '".$ht."',
				             	    '".$dt."',
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