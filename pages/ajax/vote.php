<?php
	use \FSM\Model\blog_post;
	use \FSM\Model\blog_post_vote;
	
	if (isset($_SESSION['votes'][$_POST['ide']])) exit ('dup from session');
	
	$post = new blog_post($_POST['ide']);
	$ip = $_SERVER['REMOTE_ADDR'];
	
	$rs = sql_array("
		SELECT
			id
		FROM
			blog_post_vote
		WHERE
			ip_address = '".$ip."'
			AND blog_post_id = ".$post->id		
	);
	if ($rs[0]['id']) {
		exit ('dup from db');
	}
	
	$_SESSION['votes'][$post->ide] = $_POST['vote'];
	
	$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
	if($details->loc) {
		$location = explode(',',$details->loc);
	}
	
	$region = $_SESSION['region'];
	if (!$region) {		
		if (is_numeric($location[0]) && is_numeric($location[1])) {
			if ($location[0] > 36 && $location[0] < 47 && $location[1] < -66 && $location[1] > -80) $region = 'northeast';
			else if ($location[0] > 36 && $location[0] < 47 && $location[1] <= -80 && $location[1] >= -105) $region = 'midwest';
			else if ($location[0] <= 36 && $location[1] <= -95 && $location[1] >= -105) $region = 'southwest';
			else if (
				($location[1] < -105 && $location[0] < 47 && $location[0] > 31) 
				|| 
				($location[0] >= 53 && $location[0] <= 71 && $location[1] <= -140 && $location[1] >= -168)
				||
				($location[0] <= 22 && $location[0] >= 19 && $location[1] < -154 && $location[1] > -160)
			) $region = 'west';
			else if ($location[0] <= 36 && $location[0] >= 24 && $location[1] <= -75 && $location[1] >= -95) $region = 'southeast';
			else $region = 'international';
		}
		else $region = 'unknown';
		$_SESSION['region'] = $region;
	}
		
	$post->setVote([
		'vote' 			=> $_POST['vote'],
		'location' 		=> $region,
		'ip_address'	=> $ip,
		'lat'			=> $location[0],
		'lng'			=> $location[1]
	]);
	exit ('vote set');