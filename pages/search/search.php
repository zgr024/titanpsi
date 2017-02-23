<?php
	use \FSM\Model\blog_post;
	
	$this->title = "Searching Flirt Skirt or Marry";
	$this->head[]= '
		<meta name="copyright" content="Copyright '.date('Y').' Flirt Skirt or Marry, LLC">
		<meta name="description" content="Searching Flirt Skirt or Marry for '.$_GET['q'].'">
		<meta name="keywords" content="search fashion,trends search,find fashion trends">
		<meta name="DC.title" content="'.$this->title.'">
	';
	$this->template('website','top');
	
	$where = array();
	$where[] = "status = 1";
	$searchTerm = "LIKE '%".trim(addslashes(urldecode($_GET['q'])))."%'";
	$where[] = "(
		blog_post.title {$searchTerm}
		OR blog_post.preview {$searchTerm}
		OR blog_post.body {$searchTerm}
		OR blog_post.tagline {$searchTerm}
		OR blog_post.category {$searchTerm}
		OR blog_post.other_category_name {$searchTerm}
		OR blog_post.description {$searchTerm}
	)";
	
	$posts = blog_post::getMany([
		'where'		=> $where,
		'sort'		=> 'blog_post.post_datetime',
		'sort_dir'	=> 'DESC'
	]);

	foreach($posts as $key=> $post) {
		switch($post->category) {
			case 'fashion trend':
				$category = 'Fashion Trend';
				$page = '/shopping';
				$image = $post->articles[0]->img_src;
				$body = $post->body;
				break;
			case 'have to have it':
				$category = 'Have To Have It';
				$page = '/have-to-have-it';
				$image = $post->articles[1]->img_src;
				$body = $post->preview;
				break;
			case 'shopping': 
				$category = 'Shopping';
				$page = '/shopping';
				$image = $post->articles[0]->img_src;
				$body = $post->preview;
				break;
			case 'other':
				$category = $post->other_category_name;
				$page = '';
				$image = $post->articles[0]->img_src;
				$body = $post->preview;
				break;
		}
		
?>
	 <div class="row post-row <?=$key>6?'tempHide':''?>" <?=$key==6?'style="border-bottom: none"':''?>>
    	<a href="<?=$page?>/<?=$post->slug?>" class="col-xs-12 col-md-6 rel">
        	<div class="post-tag">
            	<div class="white-btn"><?=strtoupper($category)?></div>
            </div>
        	<img class="post-image img-responsive auto-margin" src="<?=$image?>">
        </a>
        <a href="<?=$page?>/<?=$post->slug?>" class="col-xs-12 col-md-6">
        	<div class="post-title"><?=$post->title?></div>
            <div class="post ellipsis">
<?php
				$body = wordwrap($body, 38, "|");
				$body = explode('|',$body);
				for ($x=0; $x<9; $x++) {
					echo $body[$x];
				}
?>
            </div>
        </a>
    </div>
<?php
	}
$this->template('website','bottom');