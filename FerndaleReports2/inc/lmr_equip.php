<?php
require_once("php/Sql.php");

class lmr_equip
{
	
	public $uid;
	private $db;
	
	
	
	
	public function __construct($u){
		$this->uid=$u;
		$this->db="apps_forms";
	}
	
	public function setEquip($n,$a,$jnr){
		
		
	try{
		 $created=time();
		 $this->oSql=new Sql($this->db);
		 $this->oSql->setErrorhandling(true, true);
		 $this->sSql="INSERT INTO flm_report_sub_equipment (job_nr,name,amount,created)
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