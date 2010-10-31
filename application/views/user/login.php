<h1>ورود کاربر</h1>
<?php
	if(isset($_SESSION['signup_success'])){
		echo "<div id='success'>";
		echo $_SESSION['signup_success'];
		echo "</div>\n";
	}
?>

<?php

	$this->load->helper("form");
	
	$attrs = array('id' => 'loginform');
	echo form_open('user/checkUser', $attrs) . "\n";
	
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
	
	echo '<p>';
	$data = array(
				'name' 		=> 'submit',
				'id' 		=> 'submit',
				'value'  	=> 'ورود',
				'tabindex' 	=> '3',
	);
	echo form_submit($data);
	echo "</p>\n";

	echo form_close() . "\n";
?>