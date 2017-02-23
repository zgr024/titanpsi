<?php
	use \FSM\Model\blog_post;
	$this->title = "Blogroll | Flirt Skirt or Marry";
	$this->head[]= '
		<meta name="copyright" content="Copyright '.date('Y').' Flirt Skirt or Marry, LLC">
		<meta name="description" content="Flirt Skirt or Marry Archive">
		<meta name="keywords" content="fashion trends,spring fashion trends,fall fashion trends,summer fashion trends,latest fashion trends,trending styles,favorite fashion,favorite styles">
		<meta name="DC.title" content="'.$this->title.'">
	';
	$this->css[] = '/pages/default/default.css';
	$this->template('website','top');
	
	$limit = 20;
	$pg = $_GET['pg']?$_GET['pg']:1;
	$offset = ($pg * $limit) - $limit;
	
	$posts = blog_post::getMany([
		'where'		=> "category IN ('other','shopping') and status = 1 AND post_datetime <= now()",
		'sort'		=> 'blog_post.post_datetime',
		'sort_dir'	=> 'DESC',
		'limit'		=> $limit,
		'offset'	=> $offset
	]);
	
	$more = blog_post::getList([
		'where'		=> "category IN ('other','shopping') and status = 1 AND post_datetime <= now()",
		'sort'		=> 'blog_post.post_datetime',
		'sort_dir'	=> 'DESC',
		'limit'		=> $limit,
		'offset'	=> ($offset+$limit)
	]);

	foreach($posts as $post) {
		switch($post->category) {
			case 'shopping': 
				$category = 'Shopping';
				$page = '/shopping';
				foreach($post->articles as $item) {
					if ($item->category == 'blogroll') $image = $item->img_src;
				}
				break;
			case 'other':
				$category = $post->other_category_name;
				$page = '';
				$image = $post->articles[0]->img_src;
				break;
		}
?>
	<input type="hidden" id="scroll-to" value="<?=IDE?>">
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
				$body = wordwrap($post->preview, 38, "|");
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

		if (count($more) || $pg > 1) {
?>   
    <div class="row next-prev">
    	<div class="col-md-2">
<?php
			if ($pg-1>0) {
?>        
            <img src="/images/icons/pagination-left-arrow.png">
            <a href="/archive?pg=<?=$pg-1?>">PREV</a>
<?	
			}
?>
        </div>
        <div class="col-md-2 col-md-offset-8 text-right">
<?php
			if (count($more)) {
?>
            <a href="/archive?pg=<?=$pg+1?>">NEXT </a>
            <img src="/images/icons/pagination-right-arrow.png">
<?php
			}
?>
        </div>
    </div>
<?php
	}
$this->template('website','bottom');