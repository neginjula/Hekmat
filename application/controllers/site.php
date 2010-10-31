<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Site extends Controller {

	//php 5 constructor
	function __construct() {
		parent::Controller();
		session_start();
	}
	
	//php 4 constructor
	function Site() {
		parent::Controller();
		session_start();
	}
	
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
	
	function index() {
		$data['isLoggedIn'] = $this->_isUserLoggedIn();
		$data['title'] = "حکمت | صفحه ی اصلی";
		$data['mainView'] = "site/main";
		$this->load->view("template", $data);
	}
	
	
}