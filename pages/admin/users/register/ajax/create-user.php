<?php
	use \FSM\Model\person;
	use \FSM\Model\user;
	
	$arr['success'] = false;
	$arr['highlight'] = array();
	$list = person::getList(['where'=>"person.username = '".strtolower($_POST['username'])."'"]);
	if (empty($list)) {
		if ($_POST['password1'] !== $_POST['password2']) {
			$arr['highlight'][] = 'password1';
			$arr['highlight'][] = 'password2';
			$arr['errorMsg'] = "Passwords Do Not Match";
		}
		$person = person::insert($_POST);
		$arr['person'] = $person;
		$person->update([
			'password_hash' => \Login::generateHash(
				$_POST['password1'],
				$person->generateUserSalt()
			 )
		]);
		$user = user::insert([
			'person_id'=>$person->id,
			'access_group'=>$_POST['access_group']
		]);
		$arr['success'] = true;
		$arr['user'] = $user;
	}
	else {
		$arr['errorMsg'] = "Username Already Taken";
		$arr['highlight'][] = 'username';
	}
	exit(json_encode($arr));