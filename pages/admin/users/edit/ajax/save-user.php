<?php
	use \FSM\Model\person;
	use \FSM\Model\user;
	
	$arr['success'] = false;
	$arr['highlight'] = array();
	$user = new user($_POST['admin_ide']);
	$person = new person($user->person->id);
	$list = person::getList(['where'=>"person.username = '".strtolower($_POST['username'])."' and id != ".$user->person->id]);
	
	if (empty($list)) {
			
		$user = new user($_POST['admin_ide']);
		$person = new person($user->person->id);
		
		$person->update([
			'fname'		=> $_POST['fname'],
			'lname'		=> $_POST['lname'],
			'email' 	=> $_POST['email'],
			'username'	=> $_POST['username'],
		]);
		$arr['person'] = $person;
			
		$user->update([
			'access_group'=>$_POST['access_group']
		]);
		$arr['success'] = true;
		$arr['user'] = $user;
	}
	else {
		$arr['errorMsg'] = "Not Saved. Username Already Taken";
		$arr['highlight'][] = 'username';
	}
	exit(json_encode($arr));