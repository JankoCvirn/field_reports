<?php

require_once("php/Sql.php");

//TODO 
//Login method -> database column name  table:user_data 
// id ,username,password,store_id,store_status,account_activation
//Read orders from DB


class utils
{

	
	public $result;
	private $oSql;
	private $sSql;
	private $row;
	
	public $login;
	
	private $signup;
	private $username;
	private $password;
	public $active_account;
	
	
	
	public $uid;
	private $db_users="apps_users";
	
	
    
	


	public function __construct($u,$p){

		$this->username=$u;
		$this->password=$p;
		//$this->order_details=null;
		
	}

	public function setUserID($u){
		
		$this->uid=$u;
		
	}
	
	
	//Check login in drupal
public function getCheckLogin(){
	
		
		$this->oSql=new Sql($this->db_users);
		$this->oSql->setErrorhandling(true, true);
		$this->sSql="SELECT * FROM user where username='".$this->username."' and password='".$this->password."' and active='1'  ";
	
	
		$this->oSql->q($this->sSql);
		if (($this->row=$this->oSql->fa())!=null){
	
			$this->uid=$this->row['id'];
			
			
			$this->login=1;
		}
	
		else {
	
			$this->login=0;
	
		}
			
	
	}
	
	
public function setNewUser($n,$p,$f,$l){
		
		
		$this->oSql=new Sql($this->db_users);
		$this->oSql->setErrorhandling(true, true);
		$this->sSql="INSERT INTO user (username,password,fname,lname)
				             VALUES('".$n."','".$p."','".$f."','".$l."') ";
		$this->oSql->q($this->sSql);
		
		
	}
public function setUserActiv($id,$s){
		
		
		$this->oSql=new Sql($this->db_users);
		$this->oSql->setErrorhandling(true, true);
		$this->sSql="UPDATE user SET active='".$s."' WHERE id='".$id."'";
		$this->oSql->q($this->sSql);
		
		
	}



public function setAlterUser($id,$fn,$ln,$un,$up){
	
		$this->oSql=new Sql($this->db_users);
		$this->oSql->setErrorhandling(true, true);
		$this->sSql="UPDATE user SET fname='".$fn."',lname='".$ln."',username='".$un."',password='".$up."' WHERE id='".$id."'";
		$this->oSql->q($this->sSql);
	
}
	
	
	
}





?>
