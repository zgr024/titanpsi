<?php
	use \FSM\Model\blog_post;

	header('Content-type: text/xml; charset=utf-8');
	
	$domain = 'http://flirtskirtormarry.com';

	$posts = blog_post::getMany([
		'where'		=> 'status = 1 and blog_post.post_datetime <= now()',
		'sort'		=> 'blog_post.post_datetime',
		'sort_dir'	=> 'DESC'
	]);
	
	echo '<?xml version="1.0" encoding="UTF-8" ?>';
	echo'
			<rss version="2.0">
			
			<channel>
				<title>Flirt Skirt or Marry</title>
				<link>'.$domain.'</link>
				<language>English</language>
				<description>A fashion website that uses an interactive platform, to translate forward-looking fashion trends from the runway to all demographics by providing style inspiration and shopping resources.</description>
				<copyright>'.date(Y).' Flirt Skirt or Marry</copyright>
	';
	
	foreach($posts as $post) {
		
		switch ($post->category) {
			case 'fashion trend':
				$link = $domain.'/style-tips/'.$post->slug;
				$description = $post->body;
				$image = $post->articles[0]->img_src;
				break;
			case 'shopping':
				$link = $domain.'/shopping/'.$post->slug;
				$description = $post->body;
				$image = $post->articles[0]->img_src;
				break;
			case 'have to have it':
				$link = $domain.'/have-to-have-it/'.$post->slug;
				$description = $post->body;
				foreach($post->articles as $art) { 
					if ($art->category == 'blogroll')  {
						$image = $art->img_src;		
					}
					else if ($art->category == 'sidebar')  {
						$sidebar = $art->img_src;		
					}
				}
				if (!$image) $image = $sidebar;
				break;
			case 'other':
				$link = $domain.'/'.$post->slug;
				$description = $post->body;
				$image = $post->articles[0]->img_src;
				break;
		}
		$size = getimagesize('/home/fsm/codebases/fsm'.$image);
		if ($image) $image = '<img src="http://flirtskirtormarry.com'.$image.'"/><br><br>';
		echo ' 
				<item>
					<title>'.$post->title.'</title>
					<link>'.$link.'</link>
					<description><![CDATA['.$image.$description.']]></description>
					<guid isPermalink="false">'.$post->id.'@'.$domain.'</guid>
					<category>'.ucwords($post->category).'</category>					
					<pubDate>'.date(PUB_TIME,strtotime($post->post_datetime)).'</pubDate>
				</item>
		';
	}
	
	echo '
			</channel>
			
			</rss>
	';