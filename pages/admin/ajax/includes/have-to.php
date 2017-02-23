<?php
	use \FSM\Misc,
		\FSM\Model\blog_post,
		\FSM\Model\blog_post_article,
		\FSM\Model\blog_post_article_detail;
	
	global $skyphp_storage_path;

	if (!$post->id) {
		$data = [
			'category'			=> $_POST['category'],
			'status'			=> $_POST['status'],
			'title'				=> $_POST['title'],
			'slug'				=> $_POST['slug'],
			'meta_keywords'		=> $_POST['meta_keywords'],
			'meta_description'	=> $_POST['meta_description'],
			'preview'			=> $_POST['preview'],
			'body'				=> $_POST['body'],
			'post_datetime'		=> date(MYSQL,strtotime($_POST['post_datetime'])),
			'mod__person_id'	=> PERSON_ID
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
		
		$dir = $skyphp_storage_path.'images/haveto/'.$post->id;
		if (!is_dir($dir)) mkdir($dir);
		
		$target = $dir.'/'.Misc::sanitizeFileName($_FILES['have_to']['name'],true);
		
		if (move_uploaded_file($_FILES['have_to']['tmp_name'],$target)) {
			
			$img = str_replace($skyphp_storage_path.'images/','/img/',$target);
			
			$article = new blog_post_article([
				'blog_post_id'	=> $post->id,
				'img_src'		=> $img,
				'category'		=> 'main',
				'iorder'		=> 1
			]);
			$article->save();
			$articles['have-to'][] = $article->ide;
			
			$detail = new blog_post_article_detail([
				'blog_post_article_id' 	=> $article->id,
				'ht_left_bubble'		=> $_POST['left_bubble'],
				'ht_right_bubble'		=> $_POST['right_bubble'],
				'ht_left_bubble_top'	=> intval($_POST['left_top']),
				'ht_right_bubble_top'	=> intval($_POST['right_top']),
				'description'			=> $_POST['product'],
				'price'					=> $_POST['price'],
				'href'					=> $_POST['href'],
				'href_display'			=> $_POST['href_display']
			]);
			
			$detail->save();
			$details['have-to'] = $detail->ide;
			
			$target = $dir.'/'.Misc::sanitizeFileName($_FILES['sidebar']['name'],true);
		
			if (move_uploaded_file($_FILES['sidebar']['tmp_name'],$target)) {
				
				$img = str_replace($skyphp_storage_path.'images/','/img/',$target);
				
				$article = new blog_post_article([
					'blog_post_id'	=> $post->id,
					'img_src'		=> $img,
					'category'		=> 'sidebar',
					'iorder'		=> 1
				]);
				$article->save();
				$articles['have-to'][] = $article->ide;
				
				$detail = new blog_post_article_detail([
					'blog_post_article_id' 	=> $article->id,
					'name'					=> $_POST['sidebar_title'],
					'description'			=> $_POST['sidebar_text']
				]);
				$detail->save();
				$details['have-to-sidebar'] = $detail->ide;
				
			}
			
			$target = $dir.'/'.Misc::sanitizeFileName($_FILES['blogroll']['name'],true);
		
			if (move_uploaded_file($_FILES['blogroll']['tmp_name'],$target)) {
				
				$img = str_replace($skyphp_storage_path.'images/','/img/',$target);
				
				$article = new blog_post_article([
					'blog_post_id'	=> $post->id,
					'img_src'		=> $img,
					'category'		=> 'blogroll',
					'iorder'		=> 1
				]);
				$article->save();
				$articles['have-to'][] = $article->ide;
				
			}
			
		}
	}
	else { 
		$data = [
			'category'			=> $_POST['category'],
			'status'			=> $_POST['status'],
			'title'				=> $_POST['title'],
			'slug'				=> $_POST['slug'],
			'meta_keywords'		=> $_POST['meta_keywords'],
			'meta_description'	=> $_POST['meta_description'],
			'preview'			=> $_POST['preview'],
			'body'				=> $_POST['body'],
			'post_datetime'		=> date(MYSQL,strtotime($_POST['post_datetime'])),
			'update_time'		=> date(MYSQL)
		];
		
		if ($_POST['status'] == 1 && $post->status != 1) $data['published_time'] = date(MYSQL);
		
		$post->update($data);
				
		// Store the Have To image if its changed
		if ($_FILES['have_to']['tmp_name']) {
			$target = $skyphp_storage_path.'images/haveto/'.$post->id;
			if (!is_dir($target)) mkdir($target);
			$target = $target.'/'.Misc::sanitizeFileName($_FILES['have_to']['name'],true);
			
			if (move_uploaded_file($_FILES['have_to']['tmp_name'],$target)) {
	
				$img = str_replace($skyphp_storage_path.'images/','/img/',$target);
			
				if ($_POST['have_to_ide']) {
					// Update the image to the new one
					$article = new blog_post_article($_POST['have_to_ide']);	
					$article->update([
						'img_src' 		=> $img
					]);
				}
				else {
					// Insert the new article
					$article = new blog_post_article([
						'blog_post_id'	=> $post->id,
						'img_src'		=> $img,
						'category'		=> 'main',
						'iorder'		=> 1
					]);			
					$article->save();
					$articles['main'] = $article->ide;
					
					// Insert the details
					$detail = new blog_post_article_detail([
						'blog_post_article_id' 	=> $article->id,
						'ht_left_bubble'		=> $_POST['left_bubble'],
						'ht_right_bubble'		=> $_POST['right_bubble'],
						'ht_left_bubble_top'	=> $_POST['left_bubble'],
						'ht_right_bubble_top'	=> $_POST['left_bubble'],
						'description'			=> $_POST['product'],
						'price'					=> $_POST['price'],
						'href'					=> $_POST['href'],
						'href_display'			=> $_POST['href_display']
					]);
					
					$detail->save();
					$details['have-to'] = $detail->ide;
				}
			}
		}
		
		if ($_POST['have_to_ide']) {
			// Update the text if the article already exists
			$article = new blog_post_article($_POST['have_to_ide']);
			$details = new blog_post_article_detail($article->details[0]->ide);
			$details->update([
				'ht_left_bubble'		=> $_POST['left_bubble'],
				'ht_right_bubble'		=> $_POST['right_bubble'],
				'ht_left_bubble_top'	=> $_POST['left_top'],
				'ht_right_bubble_top'	=> $_POST['right_top'],
				'description'			=> $_POST['product'],
				'price'					=> $_POST['price'],
				'href'					=> $_POST['href'],
				'href_display'			=> $_POST['href_display']
			]);
		}
		
		// Store the Blogroll image if its changed
		if ($_FILES['blogroll']['tmp_name']) {
			// Store the Blog Roll image
			$target = $skyphp_storage_path.'images/haveto/'.$post->id;
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
		
		// Store the Carousel image if its changed
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
		
		// Store the Sidebar image if its changed
		if ($_FILES['sidebar']['tmp_name']) {
			$target = $skyphp_storage_path.'images/haveto/'.$post->id;
			if (!is_dir($target)) mkdir($target);
			$target = $target.'/'.Misc::sanitizeFileName($_FILES['sidebar']['name'],true);
			
			if (move_uploaded_file($_FILES['sidebar']['tmp_name'],$target)) {
	
				$img = str_replace($skyphp_storage_path.'images/','/img/',$target);
			
				if ($_POST['sidebar_ide']) {
					$article = new blog_post_article($_POST['sidebar_ide']);	
					$article->update([
						'img_src' 		=> $img
					]);
				}
				else {
					$article = new blog_post_article([
						'blog_post_id'	=> $post->id,
						'img_src'		=> $img,
						'category'		=> 'sidebar',
						'iorder'		=> 1
					]);
					$article->save();
					$articles['sidebar'] = $article->ide;
					
					$detail = new blog_post_article_detail([
						'blog_post_article_id' 	=> $article->id,
						'name'					=> $_POST['sidebar_title'],
						'description'			=> $_POST['sidebar_text']
					]);
					$detail->save();
					$details['have-to-sidebar'] = $detail->ide;	
				}
			}
		}
		
		if ($_POST['sidebar_ide']) {
			$article = new blog_post_article($_POST['sidebar_ide']);
			$details = new blog_post_article_detail($article->details[0]->ide);
			$details->update([
				'name'					=> $_POST['sidebar_title'],
				'description'			=> $_POST['sidebar_text']
			]);
		}
	}