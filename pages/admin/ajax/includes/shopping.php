<?php
	use \FSM\Misc,
		\FSM\Model\blog_post,
		\FSM\Model\blog_post_article,
		\FSM\Model\blog_post_article_detail;
		

	if (!$post->id) {
	
		$data = [
			'category'				=> $_POST['category'],
			'status'				=> $_POST['status'],
			'title'					=> $_POST['title'],
			'slug'					=> $_POST['slug'],
			'shopping_keywords'		=> $_POST['shopping_keywords'],
			'shopping_description'	=> $_POST['shopping_description'],
			'body'					=> $_POST['body'],
			'preview'				=> $_POST['preview'],
			'post_datetime'			=> date(MYSQL,strtotime($_POST['post_datetime'])),
			'mod__person_id'		=> PERSON_ID 
		];
	
		if ($_POST['status'] == 1) $data['published_time'] = date(MYSQL);
	
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
		
		if ($_FILES['blogroll']['tmp_name']) {
			// Store the Blog Roll image
			$target = $skyphp_storage_path.'images/shopping/'.$post->id;
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
					$articles['other'] = $article->ide;			
				}
			}
		}
		
		// Store the images and details of shopping
		$count = count($_FILES['shopping']['name']);
		
		for ($x = 0; $x <= $count; $x++) {
			
			if (!$_FILES['shopping']['error'][$x]) {
				
				$target = $skyphp_storage_path.'images/shopping/'.$post->id;
				if (!is_dir($target)) mkdir($target);
				
				$target = $target.'/'.Misc::sanitizeFileName($_FILES['shopping']['name'][$x],true);
	
				if (move_uploaded_file($_FILES['shopping']['tmp_name'][$x],$target)) {

					$img = str_replace($skyphp_storage_path.'images/','/img/',$target);
				
					$article = new blog_post_article([
						'blog_post_id'	=> $post->id,
						'img_src'		=> $img,
						'category'		=> 'shopping',
						'iorder'		=> ($x+1)
					]);			
					$article->save();
					$articles['shopping'][] = $article->ide;
					
					$detail = new blog_post_article_detail([
						'blog_post_article_id' 	=> $article->id,
						'name' 					=> $_POST['shopping_name'][$x],
						'price'					=> $_POST['shopping_price'][$x],
						'href'					=> $_POST['shopping_href'][$x],
						'category'				=> 'shopping'
					]);
					$detail->save();
					$details['shopping'][] = $detail->ide;
					
				}
				
			}
							
		}
	
	}
	
	else {
		
		$data = [
			'title'					=> $_POST['title'],
			'status'				=> $_POST['status'],
			'slug'					=> $_POST['slug'],
			'shopping_keywords'		=> $_POST['shopping_keywords'],
			'shopping_description'	=> $_POST['shopping_description'],
			'body'					=> $_POST['body'],
			'preview'				=> $_POST['preview'],
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
		
		if ($_FILES['blogroll']['tmp_name']) {
			// Store the Blog Roll image
			$target = $skyphp_storage_path.'images/shopping/'.$post->id;
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
		
		if ($_FILES['carousel']['tmp_name']) {
			// Store the Blog Roll image
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
		
		// Update existing Shopping items
		for ($x = 0; $x < 30; $x++) {
			if ($_POST['shopping_ide'][$x]) {
				$article = new blog_post_article($_POST['shopping_ide'][$x]);
				$details = new blog_post_article_detail($article->details[0]->ide);
				$details->update([
					'name'			=> $_POST['shopping_name'][$x],
					'price'			=> $_POST['shopping_price'][$x],
					'href'			=> $_POST['shopping_href'][$x]
				]);
			}
		}
		
		
		// Store the images and details of shopping
		$count = count($_FILES['shopping']['name']);
		
		for ($x = 0; $x <= $count; $x++) {
			
			if (!$_FILES['shopping']['error'][$x]) {
				
				$target = $skyphp_storage_path.'images/shopping/'.$post->id;
				if (!is_dir($target)) mkdir($target);
				
				$target = $target.'/'.Misc::sanitizeFileName($_FILES['shopping']['name'][$x],true);
	
				if (move_uploaded_file($_FILES['shopping']['tmp_name'][$x],$target)) {

					$img = str_replace($skyphp_storage_path.'images/','/img/',$target);
				
					$article = new blog_post_article([
						'blog_post_id'	=> $post->id,
						'img_src'		=> $img,
						'category'		=> 'shopping',
						'iorder'		=> ($x+1)
					]);			
					$article->save();
					$articles['shopping'][] = $article->ide;
					
					$detail = new blog_post_article_detail([
						'blog_post_article_id' 	=> $article->id,
						'name' 					=> $_POST['shopping_name'][$x],
						'price'					=> $_POST['shopping_price'][$x],
						'href'					=> $_POST['shopping_href'][$x],
						'category'				=> 'shopping'
					]);
					$detail->save();
					$details['shopping'][] = $detail->ide;
					
				}
				
			}
							
		}
		
		
	}