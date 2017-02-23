<?php
	use \FSM\Misc,
		\FSM\Model\blog_post,
		\FSM\Model\blog_post_article,
		\FSM\Model\blog_post_article_detail;
		

	if (!$post->id) {
		
		// INSERT THE RECORD
		
		$data = [
			'category'				=> 'other',
			'status'				=> $_POST['status'],
			'other_category_name'	=> $_POST['other_category_name'],
			'title'					=> $_POST['title'],
			'slug'					=> $_POST['slug'],
			'meta_keywords'			=> $_POST['meta_keywords'],
			'meta_description'		=> $_POST['meta_description'],
			'preview'				=> $_POST['preview'],
			'body'					=> str_replace(' fr-dib',' fr-dib img-responsive',str_replace(' img-responsive','',$_POST['body'])),
			'post_datetime'			=> date(MYSQL,strtotime($_POST['post_datetime'])),
			'mod__person_id'		=> PERSON_ID
		];
		
		if ($_POST['status'] == 1) $data['published_time'] = date(MYSQL);
		blog_post::insert($data);
		$post = new blog_post($data);
		$post->save();
		
		// Store the Carousel image if uploaded
		if ($_FILES['carousel']['tmp_name']) {
			
			$target = $skyphp_storage_path.'images/carousel/'.$post->id;
			if (!is_dir($target)) mkdir($target);
			$target = $target.'/'.Misc::sanitizeFileName($_FILES['carousel']['name'],true);
			
			if (move_uploaded_file($_FILES['carousel']['tmp_name'],$target)) {
	
				$img = str_replace($skyphp_storage_path.'images/','/img/',$target);
			
				$article = new blog_post_article([
					'blog_post_id'	=> $post->id,
					'img_src'		=> $img,
					'category'		=> 'carousel',
					'iorder'		=> 1
				]);			
				$article->save();
				$articles['carousel'] = $article->ide;			
			}
		}
		
		
		if ($_FILES['img_src']['tmp_name']) {
			// Store the Blog Roll image
			$target = $skyphp_storage_path.'images/other/'.$post->id;
			if (!is_dir($target)) mkdir($target);
			$target = $target.'/'.Misc::sanitizeFileName($_FILES['blogroll']['name'],true);
			
			if (move_uploaded_file($_FILES['blogroll']['tmp_name'],$target)) {
	
				$img = str_replace($skyphp_storage_path.'images/','/img/',$target);

				$article = new blog_post_article([
					'blog_post_id'	=> $post->id,
					'img_src'		=> $img,
					'category'		=> 'blogrolls',
					'iorder'		=> 1
				]);			
				$article->save();
				$articles['blogroll'] = $article->ide;			
			}
		}
		
	}
	else {
		// UPDATE THE RECORD
		$data = [
			'status'				=> $_POST['status'],
			'other_category_name'	=> $_POST['other_category_name'],
			'title'					=> $_POST['title'],
			'slug'					=> $_POST['slug'],
			'meta_keywords'			=> $_POST['meta_keywords'],
			'meta_description'		=> $_POST['meta_description'],
			'preview'				=> $_POST['preview'],
			'body'					=> str_replace(' fr-dib',' fr-dib img-responsive',str_replace(' img-responsive','',$_POST['body'])),
			'post_datetime'			=> date(MYSQL,strtotime($_POST['post_datetime'])),
			'update_time'			=> date(MYSQL)
		];
		
		if ($_POST['featured']) {
			$featured = blog_post::getOne([
				'where'	=> 'featured = 1'
			]);
			if ($featured->id) {
				$featured->update([
					'featured' => 0
				]);
			}
			$data['featured'] = 1;
		}
		else $data['featured'] = 0;
		
		if ($_POST['status'] == 1 && $post->status != 1) $data['published_time'] = date(MYSQL);
		
		$post->update($data);
		
		if ($_FILES['carousel']['tmp_name']) {
			// Store the Carousel image
			$target = $skyphp_storage_path.'images/carousel/'.$post->id;
			if (!is_dir($target)) mkdir($target);
			$target = $target.'/'.Misc::sanitizeFileName($_FILES['carousel']['name'],true);
			
			if (move_uploaded_file($_FILES['carousel']['tmp_name'],$target)) {
	
				$img = str_replace($skyphp_storage_path.'images/','/img/',$target);
				
				if ($_POST['carousel_ide']) {
					$article = new blog_post_article($_POST['carousel_ide']);
					$article->update([
						'img_src'		=> $img
					]);
				}
				else {
					$article = new blog_post_article([
						'blog_post_id'	=> $post->id,
						'img_src'		=> $img,
						'category'		=> 'carousel',
						'iorder'		=> 1
					]);			
					$article->save();
					$articles['carousel'] = $article->ide;			
				}
			}
		}
		
		if ($_FILES['blogroll']['tmp_name']) {
			// Store the Blog Roll image
			$target = $skyphp_storage_path.'images/other/'.$post->id;
			if (!is_dir($target)) mkdir($target);
			$target = $target.'/'.Misc::sanitizeFileName($_FILES['blogroll']['name'],true);
			
			if (move_uploaded_file($_FILES['blogroll']['tmp_name'],$target)) {
	
				$img = str_replace($skyphp_storage_path.'images/','/img/',$target);
				
				if ($_POST['blogroll_ide']) {
					$article = new blog_post_article($_POST['blogroll_ide']);
					$article->update([
						'img_src'		=> $img
					]);
				}
				else {
					$article = new blog_post_article([
						'blog_post_id'	=> $post->id,
						'img_src'		=> $img,
						'category'		=> 'blogroll',
						'iorder'		=> 1
					]);			
					$article->save();
					$articles['blogroll'] = $article->ide;			
				}
			}
		}
	}			