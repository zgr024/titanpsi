<?php
	use \FSM\Model\incoming;

	$submission = new incoming(IDE);
	
	if ($submission->delete()) exit('success');
	else exit('failed');