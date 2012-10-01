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
		 $this->sSql="INSERT IGNORE INTO flm_report_sub_labor (job_nr,name,stime,htime,dtime,created,uid)
				             VALUES('".$jnr."',
				             	    '".$w."',
				             	    '".$st."',
				             	    '".$ht."',
				             	    '".$dt."',
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
	
	public function getCheck($w,$st,$ht,$dt,$jnr){
		
		$this->oSql=new Sql($this->db);
		$this->oSql->setErrorhandling(true, true);
		
		$this->sSql="SELECT * FROM flm_report_sub_labor WHERE
					job_nr='".$jnr."' AND
					name='".$w."' AND
					stime='".$st."' AND
					htime='".$ht."' AND
					dtime='".$dt."' AND
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