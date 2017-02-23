<?php
	use \FSM\Model\blog_post,
		\FSM\Model\blog_post_article,
		\FSM\Model\blog_post_article_detail;
		
	global $skyphp_storage_path;
	
	if ($_POST['test']) {
		//echo "<pre>"; print_r($_POST); echo "</pre>";
		echo $_FILES['style']['size'][3];
		echo "<pre>"; print_r($_FILES); echo "</pre>";
		exit;
	}
	
	/*
		echo "<pre>";
		print_r($_POST);
		echo "</pre>";
		
		exit;
	*/
	
	$post = new blog_post(IDE);
	if ($_POST['deleted_articles'] || $_POST['deleted_details']) include 'pages/admin/ajax/includes/removals.php';
	
	$_POST['category'] = strtolower($_POST['category']);
	$_POST['mod__person_id'] = PERSON_ID;
	
	switch($_POST['category']) {
		
		case 'other':
			include 'pages/admin/ajax/includes/other.php';
		break;
		
		case 'shopping': 
			include 'pages/admin/ajax/includes/shopping.php';
		break;
		
		case 'have to have it':
			include 'pages/admin/ajax/includes/have-to.php';
		break;
		
		case 'fashion trend':
			include 'pages/admin/ajax/includes/fashion.php';
		break;
	}
		
	exit(json_encode([
		'success'	=> true,
		'post'		=> $post->ide,
		'articles'	=> $articles,
		'details'	=> $details	,
		'votes'		=> $votes
	]));