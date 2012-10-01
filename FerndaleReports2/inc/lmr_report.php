<?php

require_once("php/Sql.php");

class lmr_report
{

	/*parameters_job= {"customernr","fecmanager","jobnumber",
		                                 "date","workperformed","joblocation",
		                                 "jobname","customer"};*/
	
	public $uid;
	public $customernr;
	public $fecamanager;
	public $jobnumber;
	public $date;
	public $workperformed;
	public $joblocation;
	public $jobname;
	public $customer;
	
	
	private $db;
	
	public function __construct($uid){
		$this->uid=$uid;
		$this->db="apps_forms";
		
	}
	
	public function setNewLMR($custnr,$fec,$job,$dat,$work,$jobl,$jobn,$cust){
		
		
		 $this->customernr=$custnr;
		 $this->fecamanager=$fec;
		 $this->jobnumber=$jobn;
		 $this->date=$dat;
		 $this->workperformed=$work;
		 $this->joblocation=$jobl;
		 $this->jobname=$job;
		 $this->customer=$cust;
		 
		 try{
		 $this->oSql=new Sql($this->db);
		 $this->oSql->setErrorhandling(true, true);
		 $this->sSql="INSERT IGNORE INTO flm_report (customer,date,job_number,job_name,job_location,fec_project_manager,customer_order_no,work_performed,uid)
				             VALUES('".$this->customer."',
				                    '".$this->date."',
				                    '".$this->jobnumber."',
				                    '".$this->jobname."',
				                    '".$this->joblocation."',
				                    '".$this->fecamanager."',
				                    '".$this->customernr."',
				                    '".$this->workperformed."',
		 							'".$this->uid."'
		 							) ";
		 $this->oSql->q($this->sSql);
		 return true;
		 }
		 catch (Exception $e){
		 	
		 	return false;
		 }
		 
		
		
		
	}
	
	public function getCheck($custnr,$fec,$job,$dat,$work,$jobl,$jobn,$cust){
		
		$this->customernr=$custnr;
		$this->fecamanager=$fec;
		$this->jobnumber=$jobn;
		$this->date=$dat;
		$this->workperformed=$work;
		$this->joblocation=$jobl;
		$this->jobname=$job;
		$this->customer=$cust;
			
		try{
			$this->oSql=new Sql($this->db);
			$this->oSql->setErrorhandling(true, true);
			$this->sSql="SELECT * FROM flm_report WHERE
						 customer='".$this->customer."' AND date='".$this->date."' AND
						 job_number='".$this->jobnumber."' AND job_name='".$this->jobname."'AND
						 job_location='".$this->joblocation."' AND fec_project_manager='".$this->fecamanager."' AND
						 customer_order_no='".$this->customernr."' AND uid='".$this->uid."'
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
		catch (Exception $e){
		
			return false;
		}
		
	}
	
	
	
	
}

?>