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
	
	function index() {
		$data['title'] = "حکمت | صفحه ی اصلی";
		$data['mainView'] = "site/main";
		$this->load->view("template", $data);
	}
	
	
}