<?php
	use \FSM\Misc,
		\FSM\Model\blog_post,
		\FSM\Model\blog_post_article,
		\FSM\Model\blog_post_article_detail,
		\FSM\Model\blog_post_votes,
		\FSM\Model\blog_post_keywords;
	
	
	if (!$post->id) {
		
		// INSERT THE RECORD
		
		$data = [
			'category'				=> $_POST['category'],
			'status'				=> $_POST['status'],
			'title'					=> $_POST['title'],
			'slug'					=> $_POST['slug'],
			'meta_keywords'			=> $_POST['meta_keywords'],
			'shopping_keywords'		=> $_POST['shopping_keywords'],
			'final_keywords'		=> $_POST['final_keywords'],
			'meta_description'		=> $_POST['meta_description'],
			'shopping_description'	=> $_POST['shopping_description'],
			'final_description'		=> $_POST['final_description'],
			'description'			=> $_POST['description'],
			'tagline'				=> $_POST['tagline'],
			'status'				=> $_POST['status'],
			'body'					=> $_POST['body'],
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
		
		
		// Store the images and details of Style Tips
		$count = count($_FILES['style']['name']);
		
		for ($x = 0; $x <= $count; $x++) {
			if (!$_FILES['style']['error'][$x]) {
				
				$target = $skyphp_storage_path.'images/style/'.$post->id;
				if (!is_dir($target)) mkdir($target);
				
				$target = $target.'/'.Misc::sanitizeFileName($_FILES['style']['name'][$x],true);
	
				if (move_uploaded_file($_FILES['style']['tmp_name'][$x],$target)) {

					$img = str_replace($skyphp_storage_path.'images/','/img/',$target);
				
					$article = new blog_post_article([
						'blog_post_id'	=> $post->id,
						'img_src'		=> $img,
						'category'		=> 'style',
						'iorder'		=> ($x+1)
					]);			
					$article->save();
					$articles['style'][] = $article->ide;
									
					
					// Save the Style Tip info
					$detail = new blog_post_article_detail([
						'blog_post_article_id' 	=> $article->id,
						'name' 					=> $_POST['style'][$x+1]['style_name'],
						'description'			=> $_POST['style'][$x+1]['style_description'],
						'category'				=> 'main_style'
					]);
					$detail->save();
					$details['style']['main'] = $detail->ide;
					
					// Loop through Style Tip products
					$productCount = count($_POST['style'][$x]['name']);
					for ($y = 0; $y < $productCount; $y++) {
						$detail = new blog_post_article_detail([
							'blog_post_article_id' 	=> $article->id,
							'name' 					=> $_POST['style'][$x+1]['name'][$y],
							'price'					=> $_POST['style'][$x+1]['price'][$y],
							'description'			=> $_POST['style'][$x+1]['description'][$y],
							'href'					=> $_POST['style'][$x+1]['href'][$y],
							'href_display'			=> $_POST['style'][$x+1]['href_display'][$y],
							'category'				=> 'style_product'
						]);
						$detail->save();
						$details['style']['products'][] = $detail->ide;
					}
					
				}
				
			}
		}
				
		// Store the images and details of Marry
		$count = count($_FILES['marry']['name']);
		
		for ($x = 0; $x <= $count; $x++) {
			
			if (!$_FILES['marry']['error'][$x]) {
				
				$target = $skyphp_storage_path.'images/marry/'.$post->id;
				if (!is_dir($target)) mkdir($target);
				
				$target = $target.'/'.Misc::sanitizeFileName($_FILES['marry']['name'][$x],true);
	
				if (move_uploaded_file($_FILES['marry']['tmp_name'][$x],$target)) {

					$img = str_replace($skyphp_storage_path.'images/','/img/',$target);
				
					$article = new blog_post_article([
						'blog_post_id'	=> $post->id,
						'img_src'		=> $img,
						'category'		=> 'marry',
						'iorder'		=> ($x+1)
					]);			
					$article->save();
					$articles['marry'][] = $article->ide;
					
					$detail = new blog_post_article_detail([
						'blog_post_article_id' 	=> $article->id,
						'name' 					=> $_POST['marry_name'][$x],
						'price'					=> $_POST['marry_price'][$x],
						'href'					=> $_POST['marry_href'][$x],
						'category'				=> 'marry'
					]);
					$detail->save();
					$details['marry'][] = $detail->ide;
					
				}
				
			}
							
		}
	
		// Store the images and details of Skirt
		$count = count($_FILES['skirt']['name']);
		
		for ($x = 0; $x <= $count; $x++) {
			
			if (!$_FILES['skirt']['error'][$x]) {
				
				$target = $skyphp_storage_path.'images/skirt/'.$post->id;
				if (!is_dir($target)) mkdir($target);
				
				$target = $target.'/'.Misc::sanitizeFileName($_FILES['skirt']['name'][$x],true);
				
				if (move_uploaded_file($_FILES['skirt']['tmp_name'][$x],$target)) {
					
					$img = str_replace($skyphp_storage_path.'images/','/img/',$target);
				
					$article = new blog_post_article([
						'blog_post_id'	=> $post->id,
						'img_src'		=> $img,
						'category'		=> 'skirt',
						'iorder'		=> ($x+1)
					]);			
					$article->save();
					$articles['skirt'][] = $article->ide;
					
					$detail = new blog_post_article_detail([
						'blog_post_article_id' 	=> $article->id,
						'name' 					=> $_POST['skirt_name'][$x],
						'price'					=> $_POST['skirt_price'][$x],
						'href'					=> $_POST['skirt_href'][$x],
						'description'			=> $_POST['skirt_description'][$x],
						'category'				=> 'skirt'
					]);
					$detail->save();
					$details['skirt'][] = $detail->ide;
					
				}
				
			}
							
		}
		
		$article = new blog_post_article([
			'blog_post_id'	=> $post->id,
			'category'		=> 'final_forecast',
			'iorder'		=> 1
		]);
		$article->save();
		$articles['final'] = $article->ide;
		
		$detail = new blog_post_article_detail([
			'blog_post_article_id' 	=> $article->id,
			'name' 					=> $_POST['final_title'],
			'description'			=> $_POST['final_description'],
			'category'				=> 'final_forecast'
		]);
		$detail->save();
		$details['final'] = $detail->ide;
		
		$types = ['flirt','skirt','marry'];
		foreach ($types as $type) {
			$votes = new blog_post_votes ([
				'blog_post_id'	=> $post->id,
				'type' 					=> $type,
				'west'					=> $_POST['final_'.$type]['west'],
				'southwest'			=> $_POST['final_'.$type]['southwest'],
				'midwest'				=> $_POST['final_'.$type]['midwest'],
				'northeast'			=> $_POST['final_'.$type]['northeast'],
				'southeast'			=> $_POST['final_'.$type]['southeast'],
			]);
			$votes->save();
			$votes->$type = $votes->ide;
		}
	}
	
	else {
		
		// UPDATE THE RECORD
		
		$data = [
			'title'					=> $_POST['title'],
			'slug'					=> $_POST['slug'],
			'meta_keywords'			=> $_POST['meta_keywords'],
			'shopping_keywords'		=> $_POST['shopping_keywords'],
			'final_keywords'		=> $_POST['final_keywords'],
			'meta_description'		=> $_POST['meta_description'],
			'shopping_description'	=> $_POST['shopping_description'],
			'final_description'		=> $_POST['final_description'],
			'preview'				=> $_POST['preview'],
			'status'				=> $_POST['status'],
			'description'			=> $_POST['description'],
			'body'					=> $_POST['body'],
			'tagline'				=> $_POST['tagline'],
			'post_datetime'			=> date(MYSQL,strtotime($_POST['post_datetime'])),
			'update_time'			=> date(MYSQL)
		];
		
		if ($_POST['status'] == 1 && $post->status != 1) $data['published_time'] = date(MYSQL);
		
		$post->update($data);	
		
		// Store the Carousel image if its changed
		if ($_FILES['carousel']['tmp_name']) {
			$target = $skyphp_storage_path.'images/carousel/'.$post->id;
			if (!is_dir($target)) mkdir($target);
			$target = $target.'/'.Misc::sanitizeFileName($_FILES['carousel']['name'],true);
			
			if (move_uploaded_file($_FILES['carousel']['tmp_name'],$target)) {
	
				$img = str_replace($skyphp_storage_path.'images/','/img/',$target);
			
				if ($_POST['carousel_ide']) {
					$article = new blog_post_article($_POST['carousel_ide']);	
					$article->update([
						'active' 	=> 0
					]);
				}
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
		
		// Update existing Style Tips items
		for ($x = 1; $x <= 4; $x++) {
			if ($_POST['style_ide'][$x]) {
				$article = new blog_post_article($_POST['style_ide'][$x]);
				$detail = new blog_post_article_detail($article->details[0]->ide);
				$detail->update([
					'name'			=> $_POST['style'][$x]['style_name'],
					'description'	=> $_POST['style'][$x]['style_description']
				]);
				foreach ($_POST['style'][$x]['name'] as $key => $name) {
					if ($_POST['style'][$x]['detail_ide'][$key]) {
						$detail = new blog_post_article_detail($_POST['style'][$x]['detail_ide'][$key]);
						$detail->update([
							'name'			=> $_POST['style'][$x]['name'][$key],
							'price'			=> $_POST['style'][$x]['price'][$key],
							'description'	=> $_POST['style'][$x]['description'][$key],
							'href'			=> $_POST['style'][$x]['href'][$key],
							'href_display'	=> $_POST['style'][$x]['href_display'][$key]
						]);
					}
					else {
						$detail = new blog_post_article_detail([
							'blog_post_article_id' 	=> $article->id,
							'name' 					=> $_POST['style'][$x]['name'][$key],
							'price'					=> $_POST['style'][$x]['price'][$key],
							'description'			=> $_POST['style'][$x]['description'][$key],
							'href'					=> $_POST['style'][$x]['href'][$key],
							'href_display'			=> $_POST['style'][$x]['href_display'][$key],
							'category'				=> 'style_product'
						]);
						$detail->save();
					}						
				}
			}
		}
		
		// Update existing Marry items
		for ($x = 0; $x < 30; $x++) {
			if ($_POST['marry_ide'][$x]) {
				$article = new blog_post_article($_POST['marry_ide'][$x]);
				$detail = new blog_post_article_detail($article->details[0]->ide);
				$detail->update([
					'name'			=> $_POST['marry_name'][$x],
					'price'			=> $_POST['marry_price'][$x],
					'href'			=> $_POST['marry_href'][$x]
				]);
			}
		}
		
		// Update existing Skirt items
		for ($x = 0; $x < 30; $x++) {
			if ($_POST['skirt_ide'][$x]) {
				$article = new blog_post_article($_POST['skirt_ide'][$x]);
				$detail = new blog_post_article_detail($article->details[0]->ide);
				$detail->update([
					'name'			=> $_POST['skirt_name'][$x],
					'price'			=> $_POST['skirt_price'][$x],
					'description'	=> $_POST['skirt_description'][$x],
					'href'			=> $_POST['skirt_href'][$x]
				]);
			}
		}	
		

		// Store the images and details of new Marry items
		$count = count($_FILES['marry']['name']);
		
		for ($x = 0; $x <= $count; $x++) {
			
			if (!$_FILES['marry']['error'][$x]) {
				
				$target = $skyphp_storage_path.'images/marry/'.$post->id;
				if (!is_dir($target)) mkdir($target);
				
				$target = $target.'/'.Misc::sanitizeFileName($_FILES['marry']['name'][$x],true);
	
				if (move_uploaded_file($_FILES['marry']['tmp_name'][$x],$target)) {

					$img = str_replace($skyphp_storage_path.'images/','/img/',$target);
				
					$article = new blog_post_article([
						'blog_post_id'	=> $post->id,
						'img_src'		=> $img,
						'category'		=> 'marry',
						'iorder'		=> ($x+1)
					]);			
					$article->save();
					$articles['marry'][] = $article->ide;
					
					for ($y = 0; $y <= 8; $y++) {
						if (!$_POST['marry_ide'][$y]) {
							$num = $y;
							break;
						}
					}
					
					$detail = new blog_post_article_detail([
						'blog_post_article_id' 	=> $article->id,
						'name' 					=> $_POST['marry_name'][$x],
						'price'					=> $_POST['marry_price'][$x],
						'href'					=> $_POST['marry_href'][$x],
						'category'				=> 'marry'
					]);
					$detail->save();
					$_POST['marry_ide'][$num] = $detail->ide;
					
				}
				
			}
							
		}
		
		
		// Store the images and details of new Skirt items
		$count = count($_FILES['skirt']['name']);
		
		for ($x = 0; $x <= $count; $x++) {
			
			if (!$_FILES['skirt']['error'][$x]) {
				
				$target = $skyphp_storage_path.'images/skirt/'.$post->id;
				if (!is_dir($target)) mkdir($target);
				
				$target = $target.'/'.Misc::sanitizeFileName($_FILES['skirt']['name'][$x],true);
				
				if (move_uploaded_file($_FILES['skirt']['tmp_name'][$x],$target)) {
					
					$img = str_replace($skyphp_storage_path.'images/','/img/',$target);
				
					$article = new blog_post_article([
						'blog_post_id'	=> $post->id,
						'img_src'		=> $img,
						'category'		=> 'skirt',
						'iorder'		=> ($x+1)
					]);			
					$article->save();
					$articles['skirt'][] = $article->ide;
					
					for ($y = 0; $y <= 5; $y++) {
						if (!$_POST['skirt_ide'][$y]) {
							$num = $y;
							break;
						}
					}
						
					$detail = new blog_post_article_detail([
						'blog_post_article_id' 	=> $article->id,
						'name' 					=> $_POST['skirt_name'][$num],
						'price'					=> $_POST['skirt_price'][$num],
						'href'					=> $_POST['skirt_href'][$num],
						'description'			=> $_POST['skirt_description'][$num],
						'category'				=> 'skirt'
					]);
					$detail->save();
					$_POST['skirt_ide'][$num] = $detail->ide;
					
				}
				
			}
							
		}
		
		// Store the images and details of new Style Tips
				
		for ($x = 0; $x <= 3; $x++) {
			if ($_FILES['style']['size'][$x]) {
				
				$target = $skyphp_storage_path.'images/style/'.$post->id;
				if (!is_dir($target)) mkdir($target);
				
				$target = $target.'/'.Misc::sanitizeFileName($_FILES['style']['name'][$x],true);
	
				if (move_uploaded_file($_FILES['style']['tmp_name'][$x],$target)) {

					$img = str_replace($skyphp_storage_path.'images/','/img/',$target);
				
					$article = new blog_post_article([
						'blog_post_id'	=> $post->id,
						'img_src'		=> $img,
						'category'		=> 'style',
						'iorder'		=> ($x+1)
					]);			
					$article->save();
					$articles['style'][] = $article->ide;
					
					// Save the Style Tip info
					$detail = new blog_post_article_detail([
						'blog_post_article_id' 	=> $article->id,
						'name' 					=> $_POST['style'][$x+1]['style_name'],
						'description'			=> $_POST['style'][$x+1]['style_description'],
						'category'				=> 'main_style'
					]);
					$detail->save();
					//$details['style']['main'] = $detail->ide;
					
					
					// Loop through Style Tip products
					$productCount = count($_POST['style'][$x][name]);
					for ($y = 0; $y < $productCount; $y++) {
						$detail = new blog_post_article_detail([
							'blog_post_article_id' 	=> $article->id,
							'name' 									=> $_POST['style'][$x+1]['name'][$y],
							'price'									=> $_POST['style'][$x+1]['price'][$y],
							'description'						=> $_POST['style'][$x+1]['description'][$y],
							'href'									=> $_POST['style'][$x+1]['href'][$y],
							'href_display'					=> $_POST['style'][$x+1]['href_display'][$y],
							'category'							=> 'style_product'
						]);
						$detail->save();
						//$details['style']['products'][$x] = $detail->ide;
					}
					
				}
				
			}
			
		}
		
				
		$detail = new blog_post_article_detail($_POST['final_forecast_ide']);
		$detail->update([
			'name' 					=> $_POST['final_title'],
			'description'			=> $_POST['final_description'],
		]);


		$types = ['flirt','skirt','marry'];
		foreach($types as $type) {
			$votes = new blog_post_votes($_POST['final_'.$type]['ide']);
			if ($votes->id) {
				$votes->update([
					'west'			=> $_POST['final_'.$type]['west'],
					'southwest'	=> $_POST['final_'.$type]['southwest'],
					'midwest'		=> $_POST['final_'.$type]['midwest'],
					'northeast'	=> $_POST['final_'.$type]['northeast'],
					'southeast'	=> $_POST['final_'.$type]['southeast']
				]);
			}
			else {
				$votes = new blog_post_votes ([
					'blog_post_id'	=> $post->id,
					'type' 					=> $type,
					'west'					=> $_POST['final_'.$type]['west'],
					'southwest'			=> $_POST['final_'.$type]['southwest'],
					'midwest'				=> $_POST['final_'.$type]['midwest'],
					'northeast'			=> $_POST['final_'.$type]['northeast'],
					'southeast'			=> $_POST['final_'.$type]['southeast'],
				]);
				$votes->save();
			}
		}
	}
