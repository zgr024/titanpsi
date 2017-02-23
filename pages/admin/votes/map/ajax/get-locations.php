<?php
	use \FSM\Model\blog_post_vote;
	$locations = array();
	
	$votes = blog_post_vote::getMany();
	foreach ($votes as $vote) {
		$locations[] = $vote->dataToArray();
	}
	
	exit(json_encode($locations));