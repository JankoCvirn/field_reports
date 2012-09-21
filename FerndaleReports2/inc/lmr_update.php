<?php
require_once("php/Sql.php");

class lmr_update
{
	public function __construct($uid){
		
		$this->db="apps_forms";
	
	}
	
	public function setLabor($id,$jobnr,$st,$ht,$dt){
		
	try{
		 $created=time();
		 $this->oSql=new Sql($this->db);
		 $this->oSql->setErrorhandling(true, true);
		 $this->sSql="UPDATE flm_report_sub_labor 
		              SET st_rate='".$st."',ht_rate='".$ht."',dt_rate='".$dt."'  
		              WHERE id='".$id."' AND job_nr='".$jobnr."' ";
		 $this->oSql->q($this->sSql);
		 return true;
		 }
		 catch (Exception $e){
		 	
		 	return false;
		 }
	}
	
	public function setMaterial($id,$jobnr,$cost){
		
		$this->oSql=new Sql($this->db);
		$this->oSql->setErrorhandling(true, true);
		$this->sSql="UPDATE flm_report_sub_material SET rate='".$cost."'  WHERE id='".$id."' AND job_nr='".$jobnr."' ";
		$this->oSql->q($this->sSql);
	}
	
	public function setEqp($id,$jobnr,$cost){
		
		$this->oSql=new Sql($this->db);
		$this->oSql->setErrorhandling(true, true);
		$this->sSql="UPDATE flm_report_sub_equipment SET rate='".$cost."'  WHERE id='".$id."' AND job_nr='".$jobnr."' ";
		$this->oSql->q($this->sSql);
	
	}
	
	public function setSub($id,$jobnr,$cost){
		
		$this->oSql=new Sql($this->db);
		$this->oSql->setErrorhandling(true, true);
		$this->sSql="UPDATE flm_report_sub_subcon SET rate='".$cost."'  WHERE id='".$id."' AND job_nr='".$jobnr."' ";
		$this->oSql->q($this->sSql);
	
	}
	
	
}
?>