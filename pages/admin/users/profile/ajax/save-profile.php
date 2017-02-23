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
		
		if ($_POST['password1']) {
			if ($_POST['password1'] !== $_POST['password2']) {
				$arr['highlight'][] = 'password1';
				$arr['highlight'][] = 'password2';
				$arr['errorMsg'] = "Not Saved. Passwords Do Not Match";
			}
			else if (\Login::generateHash($_POST['old-password'],$person->generateUserSalt()) != $person->password_hash) {
				$arr['highlight'][] = 'old-password';
				$arr['password_hash'] = $person->password_hash;
				$arr['genreated_hash'] = \Login::generateHash($_POST['old-password'],$person->generateUserSalt());
				$arr['errorMsg'] = "Not Saved. Old Password Does Not Match Current Password";
			}
			else {
				$person->update([
					'fname'		=> $_POST['fname'],
					'lname'		=> $_POST['lname'],
					'email' 	=> $_POST['email'],
					'username'	=> $_POST['username'],
					'password_hash' => \Login::generateHash(
						$_POST['password1'],
						$person->generateUserSalt()
					)
				]);
				$arr['person'] = $person;
				
				$user->update([
					'access_group'=>$_POST['access_group']
				]);
				$arr['success'] = true;
				$arr['user'] = $user;
			}
		}
		else {
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
	}
	else {
		$arr['errorMsg'] = "Not Saved. Username Already Taken";
		$arr['highlight'][] = 'username';
	}
	exit(json_encode($arr));