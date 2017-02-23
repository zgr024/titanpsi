<?php
	use \FSM\Model\user;

	$user = new user(IDE);
	
	if ($user->person->id == $_SESSION['login']['person_id']) exit('self');
	
	if ($user->delete()) exit('success');
	else exit('failed');