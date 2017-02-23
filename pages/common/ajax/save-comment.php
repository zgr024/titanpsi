<?php
	use \FSM\Model\blog_post,
		\FSM\Model\blog_post_article,
		\FSM\Model\blog_post_comment,
		\FSM\Model\blog_post_article_comment;
	
	if ($_POST['type'] == 'blog_post') {
		$red = new blog_post($_POST['ide']);
		$_POST['blog_post_id'] = $red->id;
		$comment = new blog_post_comment($_POST);
		$comment->save();	
	}
	else {
		$comment = new blog_post_article_comment($_POST);
		$comment->save();
	}
	exit(json_encode(array(
		'success'=>true
	)));