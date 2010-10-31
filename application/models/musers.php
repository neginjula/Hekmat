<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class MUsers extends Model {

	//php 5 constructor
	function __construct() {
		parent::Model();
	}
	
	//php 4 constructor
	function MUsers() {
		parent::Model();
	}
	
	function checkForDuplicateEmail($email){ 
		//emails are uniqe in the database
		//returns true: if a duplicate exists
		//returns false: if this is a new email address
		
		$this->db->select("email");
		$this->db->limit(1);
		$this->db->where("email", $email);
		$q = $this->db->get("users");
		if($q->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function createUser($data) { 
		//adds a new user into the database
		//arguments
		//$data is an array()
		/*
			$data{
				email,
				password (md5ed), //password must get md5ed before getting postet with HTTP
				firstname,
				lastname,
			}
			we must then add isAdmin = 0 and isSokhanran = 0
		*/
		
		//return value
		//false is returned in case of error
		//true is returned in case of success
		//because we have javascript validation on forms that specifies what is wrong with user input, we do not need to specify the problem here.
		
		//if inputs are not set
		if(	!isset($data['email'])
		||	!isset($data['password'])
		||	!isset($data['firstname'])
		||	!isset($data['lastname']))
		{
			return false;
		}
		
		//if inputs are empty
		if(	!is_string($data['email'])
		||	!is_string($data['password'])
		||	!is_string($data['firstname'])
		||	!is_string($data['lastname']))
		{
			return false;
		}
		
		//check if strigns are more than 1 in lenth
		if(	strlen($data['email']) <= 1
		||	strlen($data['password']) <= 1
		||	strlen($data['firstname']) <= 1
		||	strlen($data['lastname']) <= 1)
		{
			return false;
		}
		
		//check for email regular expression
		//for more info on the pattern visit : http://fightingforalostcause.net/misc/2006/compare-email-regex.php
		$pattern = "/^([\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+\.)*[\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+@((((([a-z0-9]{1}[a-z0-9\-]{0,62}[a-z0-9]{1})|[a-z])\.)+[a-z]{2,6})|(\d{1,3}\.){3}\d{1,3}(\:\d{1,5})?)$/i";
		if(!preg_match($pattern, $data['email'])){
			return false;
		}
		
		$validatedInput = array();
		$validatedInput['email'] = mysql_real_escape_string($data['email']);
		$validatedInput['password'] = mysql_real_escape_string($data['password']);
		$validatedInput['firstname'] = mysql_real_escape_string($data['firstname']);
		$validatedInput['lastname'] = mysql_real_escape_string($data['lastname']);
		//adding isAdmin and isSokhanran
		$validatedInput['isAdmin'] = 0;
		$validatedInput['isSokhanran'] = 0;
		
		//insert into database
		$result = $this->db->insert('users',$validatedInput);
		if($result == 1){
			return true;
		}
	}
	
	function checkUser($data){
		//arguments
		//$data{email, password}
		//returns an array of {id, email, firstname} in case of valid credentials
		//returns false in case of invalid credentials
		$validatedInput = array();
		$validatedInput['email'] = mysql_real_escape_string($data['email']);
		$validatedInput['password'] = mysql_real_escape_string($data['password']);
		
		$this->db->select("id, email, password, firstname");
		$this->db->limit(1);
		$this->db->where('email', $validatedInput['email']);
		$this->db->where('password', $validatedInput['password']);
		
		$q = $this->db->get('users');
		
		if($q->num_rows() > 0){
			$result = $q->row();
			$returnArray = array();
			$returnArray['id'] = $result->id;
			$returnArray['email'] = $result->email;
			$returnArray['firstname'] = $result->firstname;
			
			return $returnArray;
		}
		else{
			return false;
		}
	}
}