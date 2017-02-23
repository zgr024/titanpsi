<?php
//header('Access-Control-Allow-Origin: *');
//header("Access-Control-Allow-Headers: x-requested-with");

// CHECK THE DB FOR CREDENTIALS

if (is_numeric(Login::get('person_id'))) {
	if ($_POST['remember']) setcookie('login_username',$_POST['login_username'],time+(86400 * 7));
	exit('success');
}
else exit('error');