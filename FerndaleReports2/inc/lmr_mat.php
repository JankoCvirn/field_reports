<?php
require_once("php/Sql.php");

class lmr_mat
{
	
	public $uid;
	private $db;
	
	
	
	
	public function __construct($u){
		$this->uid=$u;
		$this->db="apps_forms";
	}
	
	public function setMat($n,$a,$jnr){
		
		
	try{
		 $created=time();
		 $this->oSql=new Sql($this->db);
		 $this->oSql->setErrorhandling(true, true);
		 $this->sSql="INSERT IGNORE INTO flm_report_sub_material (job_nr,name,amount,created,uid)
				             VALUES('".$jnr."',
				             	    '".$n."',
				             	    '".$a."',
				             	    '".$created."',
				             	    '".$this->uid."'
				             	    
				                    ) ";
		 $this->oSql->q($this->sSql);
		 return true;
		 }
		 catch (Exception $e){
		 	
		 	return false;
		 }
		
		
	}
	
	public function getCheck($n,$a,$jnr){
		
		$this->oSql=new Sql($this->db);
		$this->oSql->setErrorhandling(true, true);
		$this->sSql="SELECT * FROM flm_report_sub_material WHERE 
		             job_nr='".$jnr."' AND
		             name='".$n."' AND
		             amount='".$a."' AND
		             uid='".$this->uid."'
		              ";
		$this->oSql->q($this->sSql);
		if (($this->row=$this->oSql->fa())!=null){
		
			$this->uid=$this->row['id'];
		
		
			return true;
		}
			
		else {
		
			return false;
		
		}
		
	}
	
	
	
	
	
}
?>