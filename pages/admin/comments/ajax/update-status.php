<?php
	use \FSM\Model\blog_post_comment;
	
	$comment = new blog_post_comment(IDE);
	if ($comment->update($_POST)) exit('success');
	else exit ('failed');