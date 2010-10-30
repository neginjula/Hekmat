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
	
	function createUser($data) { //adds a new user into the database
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
		||	!is_string($data['fisrtname'])
		||	!is_string($data['lastname']))
		{
			return false;
		}
		
		//TO-DO:check id strigns are more than 1 in lenth
		//TO-DO:check for email regular expression
		
		
		$validatedInput = array();
		
		$validatedInput['email'] = mysql_real_escape_string($data['email']);
		$validatedInput['password'] = mysql_real_escape_string($data['password']);
		$validatedInput['fisrtname'] = mysql_real_escape_string($data['firstname']);
		$validatedInput['lastname'] = mysql_real_escape_string($data['lastname']);
		
		//TO-DO:insert into database
	}

}