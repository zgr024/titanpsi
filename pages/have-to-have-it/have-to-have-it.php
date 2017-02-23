<?php
	use \FSM\Model\blog_post;
	
	if (!$_GET['preview']) $status = "and status = 1 and blog_post.post_datetime <= now()";
	else $status = "and status = 0";
	
	if (IDE) {
		$post = blog_post::getOne([
			'where'		=> "slug = '".addslashes(IDE)."' $status"
		]);
		$data = blog_post::getMany([
			'where'		=> "category = 'have to have it' and slug != '".addslashes(IDE)."' and status = 1 and blog_post.post_datetime <= now()",
			'sort'		=> 'blog_post.post_datetime',
			'sort_dir'	=> 'DESC',
		]);
	}
	else {
		$data = blog_post::getMany([
			'where'		=> "category = 'have to have it' and status = 1 and blog_post.post_datetime <= now()",
			'sort'		=> 'blog_post.post_datetime',
			'sort_dir'	=> 'DESC',
		]);
	}
	
	/*
	$rs = sql_array("
		SELECT
			id,
			slug
		FROM
			blog_post
		WHERE
			category = 'have to have it' 
			AND status = 1
			AND active = 1
			AND post_datetime <= now()
		ORDER BY 
			post_datetime DESC
	");
	
	foreach ($rs as $key => $r) {
		if ($r['id'] == $post->id) {
			$prev = $rs[$key-1]['slug'];
			$next = $rs[$key+1]['slug'];
		}		
	}
	*/
	
	$this->title = 'Have To Have It | Flirt Skirt or Marry';
	$this->head[]= '
		<meta name="copyright" content="Copyright '.date('Y').' Flirt Skirt or Marry, LLC">
		<meta name="description" content="'.$post->meta_description.'">
		<meta name="keywords" content="'.$post->meta_keywords.'">
		<meta name="DC.title" content="'.$this->title.'">
	';
	$this->page = 'haveto';
	$this->template('website','top');
	
	$first = false;
	if ($post) {
		$articles = [];
		foreach ($post->articles as $art) {
			$articles[$art->category][] = $art;
		}
		$first = true;
?>
		<div class="row first">
            <h4>(HAVE TO HAVE IT)</h4>
			<h2><?=$post->title?></h2>
        </div>
		<div class="row have-to-article" id="<?=$post->slug?>">
            <div class="col-md-12 text-center">
                <div class="leftBubble" style="top: <?=$articles['main'][0]->details[0]->ht_left_bubble_top?>%"><span><?=$articles['main'][0]->details[0]->ht_left_bubble?></span></div>
                <img class="img-responsive" src="<?=$articles['main'][0]->img_src?>" alt="<?=$post->title?>">
                <div class="rightBubble" style="top: <?=$articles['main'][0]->details[0]->ht_right_bubble_top?>%"><span><?=$articles['main'][0]->details[0]->ht_right_bubble?></span></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 have-to">
                I JUST HAD TO HAVE IT BECAUSE...
                <div class="why basker"><?=$post->body?></div>
                <p class="description"><?=$articles['main'][0]->details[0]->description?>, $<?=$articles['main'][0]->details[0]->price?> <a href="<?=$articles['main'][0]->details[0]->href?>"><?=$articles['main'][0]->details[0]->href_display?></a></p>
            </div>
        </div>
<?php
		if ($_GET['post_debug']) {
			d($post);
		}
	}
	
	foreach ($data as $key => $post) {	
		$articles = [];
		foreach ($post->articles as $art) {
			$articles[$art->category][] = $art;
		}
?>
        <div class="row">
            <? if (!$key && !$first) { ?><h4>(HAVE TO HAVE IT)</h4><? } ?>
            <h2><?=$post->title?></h2>
        </div>
        <div class="row have-to-article" id="<?=$post->slug?>">
            <div class="col-md-12 text-center">
                <div class="leftBubble" style="top: <?=$articles['main'][0]->details[0]->ht_left_bubble_top?>%"><span><?=$articles['main'][0]->details[0]->ht_left_bubble?></span></div>
                <img class="img-responsive" src="<?=$articles['main'][0]->img_src?>" alt="<?=$post->title?>">
                <div class="rightBubble" style="top: <?=$articles['main'][0]->details[0]->ht_right_bubble_top?>%"><span><?=$articles['main'][0]->details[0]->ht_right_bubble?></span></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 have-to">
                I JUST HAD TO HAVE IT BECAUSE...
                <div class="why basker"><?=$post->body?></div>
                <p class="description"><?=$articles['main'][0]->details[0]->description?>, <span class="price">$<?=$articles['main'][0]->details[0]->price?></span> <a class="link" href="<?=$articles['main'][0]->details[0]->href?>"><?=$articles['main'][0]->details[0]->href_display?></a></p>
            </div>
        </div>
<?php
		if ($_GET['post_debug']) {
			d($post);
		}

	}
	
	if ($prev->id || $next->id) {
?>   
    <div class="row next-prev">
    	<div class="col-md-2">
<?php
		if ($prev->id) {
?>        
            <img src="/images/icons/pagination-left-arrow.png">
            <a href="/have-to-have-it/<?=$prev->slug?>">PREV</a>
<?	
		}
?>
        </div>
        <div class="col-md-2 col-md-offset-8 text-right">
<?php
		if ($next->id) {
?>
            <a href="/have-to-have-it/style-tips/<?=$next->slug?>">NEXT </a>
            <img src="/images/icons/pagination-right-arrow.png">
<?php
		}
?>
        </div>
    </div>
<?php
	}
		
	/*$commentSettings = [
		'ide'		=> $post->ide,
		'type'		=> 'blog_post',
		'category'	=> 'have-to-have-it'
	];
	include 'pages/common/comments.php';
	*/

	$this->template('website','bottom');