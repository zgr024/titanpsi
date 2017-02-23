<?php
	use \FSM\Model\blog_post;
	
	if (!$_GET['preview']) $status = "and status = 1 and blog_post.post_datetime <= now()";
	else $status = "and status = 0";
	
	if (IDE) {
		$post = blog_post::getOne([
			'where'		=> "slug = '".addslashes(IDE)."' $status"
		]);
	}
	else {
		$post = blog_post::getOne([
			'where'		=> "category = 'fashion trend' and status = 1 and blog_post.post_datetime <= now()",
			'sort'		=> 'blog_post.post_datetime',
			'sort_dir'	=> 'DESC'
		]);
	}
	
	$rs = sql_array("
		SELECT
			id,
			slug
		FROM
			blog_post
		WHERE
			category = 'fashion trend'
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

	$this->title = 'Testing the Trend | Style - '.$data->title;
	$this->head[]= '
		<meta name="copyright" content="Copyright '.date('Y').' Flirt Skirt or Marry, LLC">
		<meta name="description" content="Style tips for '.$post->title.'">
		<meta name="keywords" content="'.$post->meta_keywords.'">
		<meta name="DC.title" content="'.$this->title.'">
	';
	$this->page = 'style';
	$this->template('website','top');
	
?>
	<input type="hidden" id="blog_post_slug" value="<?=$post->slug?>">
	<div class="row">
    	<h4>(FLIRT)</h4>
    	<h2><?=ucwords($post->title)?></h2>
        <h3><?=$post->description?></h3>
    </div>
<?php
	if ($post->articles) foreach ($post->articles as $art) {
		if ($art->category != 'style') continue;
?>
    <div class="row style-tip">
    	<div class="col-md-8">
        	<div class="row">
            	<img class="img-responsive" src="<?=$art->img_src?>">
            </div>
        </div>
        <div class="col-md-4">
			<div class="style">
            	<img class="img-responsive style-arrow hidden-sm hidden-xs" src="/images/icons/left-style-arrow.png">
                <div class="style-title"><?=strtoupper($art->details[0]->name)?></div>
                <p class="style-desc"><?=$art->details[0]->description?></p>
            </div>
	        <div class="style-tags">
<?php
			$c = 0;
			$count = count($r['styles']);
			foreach ($art->details as $key => $style) {
				if (!$key) continue;
				$c++;
				if ($style->category != 'style_product')
?>
				<strong><?=$style->name?></strong> <?=$style->description?>, $<?=$style->price?>, available at <a href="<?=$style->href?>"><?=$style->href_display?></a>
<?php
				if ($c < $count) echo '/';
			}
?>
            </div>
        </div>
    </div>
<?php
	}
?>
	<div class="row mainTrend">
        <div class="would-you hidden-xs hidden-sm col-md-6 col-md-offset-2 panel">
            <a>WOULD YOU RATHER?</a><br>
            INTERESTING IN SEEING WHAT <strong>SKIRT</strong> OR <strong>MARRY</strong> HAS TO OFFER FOR THIS TREND?
            <i class="fa fa-arrow-right circle-arrow"></i>
        </div>
        <div class="votes hidden-xs col-sm-6 col-md-5 text-center panel">
            <img data-section="skirt" src="/images/icons/skirt.png" class="img-responsive vote-button" style="margin:0 auto">
            <img data-section="marry" src="/images/icons/marry.png" class="img-responsive vote-button" style="margin:0 auto">
            <img src="/images/icons/click-here.png" class="img-responsive vote-button" style="margin:0 auto; cursor: default">
        </div>
    </div>
    <div class="row">
        <div class="votes col-xs-12 hidden-sm hidden-md hidden-lg text-center panel">
            <img id="skirt" src="/images/icons/skirt.png" class="img-responsive vote-button" style="margin:0 auto">
            <img id="marry" src="/images/icons/marry.png" class="img-responsive vote-button" style="margin:0 auto">
            <img src="/images/icons/click-here.png" class="img-responsive vote-button" style="margin:0 auto; cursor: default">
        </div>
    </div>
<?php

	if ($prev || $next) {
?>   
    <div class="row next-prev">
    	<div class="col-md-2">
<?php
			if ($prev) {
?>        
            <img src="/images/icons/pagination-left-arrow.png">
            <a href="/style-tips/<?=$prev?>">PREV</a>
<?	
			}
?>
        </div>
        <div class="col-md-2 col-md-offset-8 text-right">
<?php
			if ($next) {
?>
            <a href="/style-tips/<?=$next?>">NEXT </a>
            <img src="/images/icons/pagination-right-arrow.png">
<?php
			}
?>
        </div>
    </div>
<?php
	}
	
	$commentSettings = [
		'ide'		=> $post->ide,
		'type'		=> 'blog_post',
		'category'	=> 'style-tips'
	];
	include 'pages/common/comments.php';
		

	$this->template('website','bottom');