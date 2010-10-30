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
		echo "site home page";
	}

}