<h1>صفحه ی اصلی</h1>
<?php
if(!$isLoggedIn){
	echo "<p>" . anchor('user/signup', 'ثبت‌نام') . "</p>\n";
	echo "</p>" . anchor('user/login', 'ورود') . "</p>\n";
}
else{
	echo "<p>به سامانه‌ی حکمت خوش آمدید</p>\n";
	echo "<p>پست الکترونیکی: " . $_SESSION['user']['email'] . "</p>\n";
	echo "<p>نام: " . $_SESSION['user']['firstname'] . "</p>\n";
}
?>
