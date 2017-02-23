<?php
	use \FSM\Model\instagram;
	$this->title = "Manage Instagram Feed";
	$this->js[] = '/lib/js/jquery.cycle2.min.js';
	$this->page = 'instagram';
	$this->template('cms','top');
	/*
	{
		"access_token":"654807150.42928b5.a6236e6ba0ff47e983187c0c9f5e38db",
		"user":{
			"username":"flirtskirtormarry",
			"bio":"Extending trends beyond the fashion capitals.",
			"website":"http:\/\/FlirtSkirtorMarry.com",
			"profile_picture":"https:\/\/igcdn-photos-c-a.akamaihd.net\/hphotos-ak-xfa1\/t51.2885-19\/11111429_1020229684673442_496939249_a.jpg",
			"full_name":"Flirt Skirt or Marry",
			"id":"654807150"
		}
	}
	*/
	$user_id = 654807150;
	$token = '654807150.42928b5.a6236e6ba0ff47e983187c0c9f5e38db';
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,'https://api.instagram.com/v1/users/'.$user_id.'/media/recent/?access_token='.$token);
	
	// Set so curl_exec returns the result instead of outputting it.
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);	
	
	// Get the response and close the channel.
	$response = json_decode(curl_exec($ch));
	curl_close($ch);
?>
	<h1 class="page-header">Manage Instagram Feed</h1>
	<div class="slideshow">
<?php
	foreach ($response->data as $image) {
	/* <pre><? print_r($image->images) ?></pre> */
?>
		
		<a target="_blank" href="<?=$image->link?>"><img src="<?=$image->images->thumbnail->url?>"></a>
<?php
	}
?>
    </div>
<?php
	$this->template('cms','bottom');