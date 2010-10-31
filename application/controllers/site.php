<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Site extends Controller {

	//php 5 constructor
	function __construct() {
		parent::Controller();
	}
	
	//php 4 constructor
	function Site() {
		parent::Controller();
	}
	
	function index() {
		$data['title'] = "حکمت | صفحه ی اصلی";
		$data['mainView'] = "site/main";
		$this->load->view("template", $data);
	}
	
}