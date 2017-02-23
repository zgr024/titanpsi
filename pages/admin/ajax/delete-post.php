<?php
	use \FSM\Model\blog_post;
	$post = new blog_post(IDE);
	$post->delete();
	
	exit('success');