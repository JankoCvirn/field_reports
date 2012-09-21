<?php
require_once("php/Sql.php");

class lmr_update
{
	public $oSql;
	public $sSql;
	
	public function __construct($uid){
		
		$this->db="apps_forms";
	
	}
	
	public function setReport($jobnr,$tax,$over){
	
		try{
			
			$this->oSql=new Sql($this->db);
			$this->oSql->setErrorhandling(true, true);
			$this->sSql="UPDATE flm_report
			SET sales_tax='".$tax."',overhead_profit='".$over."'
			WHERE job_number='".$jobnr."' ";
			$this->oSql->q($this->sSql);
			return true;
		}
		catch (Exception $e){
	
			return false;
		}
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
	
	public function setMaterial($id,$jobnr,$cost,$ext,$per){
		$this->oSql=new Sql($this->db);
		$this->oSql->setErrorhandling(true, true);
		$this->sSql="UPDATE flm_report_sub_material SET rate='".$cost."',per='".$per."',extension='".$ext."'  WHERE id='".$id."' AND job_nr='".$jobnr."' ";
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