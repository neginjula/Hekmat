<!-- this page needs validation with javascript see this for example: http://demos.usejquery.com/ketchup-plugin/index.html -->
<h1>ثبت‌نام کاربر جدید</h1>
<?php
	if(isset($_SESSION['signup_error'])){
		echo "<div id='error'>";
		echo $_SESSION['signup_error'];
		echo "</div>\n";
	}
?>
<?php

	$this->load->helper("form");
	
	$attrs = array('id' => 'signupform');
	echo form_open('user/createuser', $attrs) . "\n";
	
	echo '<p><label for="email">پست الکترونیکی</label>';
	$data = array(
				'name' 		=> 'email',
				'value'  	=> '',
				'size' 		=> '40',
				'tabindex' 	=> '1',
	);
	echo form_input($data);
	echo "</p>\n";
	
	echo '<p><label for="password">رمز عبور</label>';
	$data = array(
				'name' 		=> 'password',
				'value'  	=> '',
				'size' 		=> '40',
				'tabindex' 	=> '2',
	);
	echo form_password($data);
	echo "</p>\n";
	
	echo '<p><label for="firstname">نام</label>';
	$data = array(
				'name' 		=> 'firstname',
				'value'  	=> '',
				'size' 		=> '40',
				'tabindex' 	=> '3',
	);
	echo form_input($data);
	echo "</p>\n";
	
	echo '<p><label for="lastname">نام خانوادگی</label>';
	$data = array(
				'name' 		=> 'lastname',
				'value'  	=> '',
				'size' 		=> '40',
				'tabindex' 	=> '4',
	);
	echo form_input($data);
	echo "</p>\n";
	
	echo '<p>';
	$data = array(
				'name' 		=> 'submit',
				'id' 		=> 'submit',
				'value'  	=> 'ارسال',
				'tabindex' 	=> '5',
	);
	echo form_submit($data);
	echo "</p>\n";

	echo form_close() . "\n";
?>