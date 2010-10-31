<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class User extends Controller {

	//php 5 constructor
	function __construct() {
		parent::Controller();
		session_start();
	}
	
	//php 4 constructor
	function User() {
		parent::Controller();
		session_start();
	}
	
	//uses session valued to determine user's status
	//this is a private method
	//returns true or false
	function _isUserLoggedIn(){
		//session values to be checked
		//$_SESSION['user']['id']
		//$_SESSION['user']['email']
		//$_SESSION['user']['firstname']
		
		//if values are not set
		if(	!isset($_SESSION['user']['id'])
		||	!isset($_SESSION['user']['email'])
		||	!isset($_SESSION['user']['firstname']))
		{
			return false;
		}
		
		//if id is not good!
		if($_SESSION['user']['id'] < 1){
			return false;
		}
		
		return true;
	}
	
	//TO-DO: creaate a function for session value validation with database
	//function _validateSessionDataWithDatabase()
	
	function index() {
		$isLoggedIn = $this->_isUserLoggedIn();
		echo "users main page\n";
		if($isLoggedIn){
			echo "user is logged in: " . print_r($_SESSION['user']);
		}
		else {
			echo "user is not logged in";
		}
	}
	
	function login(){
		$isLoggedIn = $this->_isUserLoggedIn();
		if($isLoggedIn){//already logged in
			redirect('user/index', 'refresh');
		}
		else{
			$data['title'] = "حکمت | ورود کاربر";
			$data['mainView'] = "user/login";
			$this->load->view("template", $data);
		}
	}

}