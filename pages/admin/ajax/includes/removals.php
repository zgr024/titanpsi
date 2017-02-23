<?php

	use \FSM\Model\blog_post_article;
	use \FSM\Model\blog_post_article_detail;
	
	if ($_POST['deleted_articles']) {
		$deletedArticles = explode(',',$_POST['deleted_articles']);
		foreach ($deletedArticles as $article_ide) {
			$article = new blog_post_article($article_ide);
			foreach($article->details as $details){
				$detail = new blog_post_article_detail($details->ide);
				$detail->update([
					'active' => 0
				]);
			}
			$article->update([
				'active' => 0
			]);
		}
	}
	
	if ($_POST['deleted_details']) {
		$deletedDetails = explode(',',$_POST['deleted_details']);
		foreach ($deletedDetails as $detail_ide) {
			$detail = new blog_post_article_detail($detail_ide);
			$detail->update([
				'active' => 0
			]);
		}
	}