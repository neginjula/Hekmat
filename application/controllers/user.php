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
	
	function checkUser(){
		
	}
	
	function signup(){
		//sign up page
		
		$isLoggedIn = $this->_isUserLoggedIn();
		if($isLoggedIn){//already logged in
			redirect('user/index', 'refresh');
		}
		else{
			unset($_SESSION['signup_error']); //signup_error is shown in signup view if an error occurs, when user is trying a new signup we have no errors
			$data['title'] = "حکمت | ثبت‌نام";
			$data['mainView'] = "user/signup";
			$this->load->view("template", $data);
		}
	}
	
	
	//processes post data sent from signup view
	function createuser(){
		$this->load->model("MUsers");
		unset($_SESSION['signup_error']); //signup_error is shown in signup view if an error occurs, when user is trying a new signup we have no errors
		
		//validate data. maybe javascript is disabled!
		//if post data are not empty
		if(strlen($_POST['email']) < 1 || !isset($_POST['email'])){
			$_SESSION['signup_error'] = $_SESSION['signup_error'] . "پست الکترونیکی خالیست.</br>\n";
		}
		if(strlen($_POST['password']) < 1 || !isset($_POST['password'])){
			$_SESSION['signup_error'] = $_SESSION['signup_error'] . "رمز عبور خالیست.</br>\n";
		}
		if(strlen($_POST['firstname']) < 1 || !isset($_POST['firstname'])){
			$_SESSION['signup_error'] = $_SESSION['signup_error'] . "نام خالیست.</br>\n";
		}
		if(strlen($_POST['lastname']) < 1 || !isset($_POST['lastname'])){
			$_SESSION['signup_error'] = $_SESSION['signup_error'] . "نام خانوادگی خالیست.</br>\n";
		}
		
		//check if this is a valid email
		//for more info on the pattern visit : http://fightingforalostcause.net/misc/2006/compare-email-regex.php
		$pattern = "/^([\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+\.)*[\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+@((((([a-z0-9]{1}[a-z0-9\-]{0,62}[a-z0-9]{1})|[a-z])\.)+[a-z]{2,6})|(\d{1,3}\.){3}\d{1,3}(\:\d{1,5})?)$/i";
		if(!preg_match($pattern, $_POST['email']){
			$_SESSION['signup_error'] = $_SESSION['signup_error'] . "پست الکترونیکی صحیح نیست.</br>\n";
		}
		else{
			//check for duplicate emails
			$isDuplicate = $this->MUsers->checkForDuplicateEmail($_POST['email']);
			if($isDuplicate){
				$_SESSION['signup_error'] = $_SESSION['signup_error'] . "پست الکترونیکی قبلاً در سیستم ثبت شده است.</br>\n";
			}
		}
		// finished validation
		
		if(isset($_SESSION['signup_error'])){
			//if input is invalid
			$data['title'] = "حکمت | ثبت‌نام";
			$data['mainView'] = "user/signup";
			$this->load->view("template", $data);
		}
		else{
			//try to submit data to database
			$_POST['password'] = md5($_POST['password']); //this is wrong and totally temporary. hashing of the password must get done with javascript in the view
			$databaseResult = $this->MUsers->createuser($_POST);
			
			if($databaseResult == true){
				//successfully created an account
				//go to login page show success message
				unset($_SESSION['signup_error']);
				$_SESSION['signup_success'] = "ثبت‌نام با موفقیت به پایان رسید.\n";
				$data['title'] = "حکمت | ورود کاربر";
				$data['mainView'] = "user/login";
				$this->load->view("template", $data);
			}
			elseif ($databaseResult == false){
				unset($_SESSION['signup_error']);
				$_SESSION['signup_error'] = "خطا در ثبت‌نام!\n";
				$data['title'] = "حکمت | ثبت‌نام";
				$data['mainView'] = "user/signup";
				$this->load->view("template", $data);
			}
		}
	}

}