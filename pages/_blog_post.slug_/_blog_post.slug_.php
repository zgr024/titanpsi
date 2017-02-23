<?php
	use \FSM\Model\blog_post;

	$post = new blog_post($blog_post_id);
	if ($post->category != 'other') {
		if ($post->category == 'fashion trend') redirect('/shopping/'.$post->slug);
		else redirect('/'.str_replace(' ','-',$post->category).'/'.$post->slug);
	}
	
	$this->title = $post->title.' | Flirt Skirt or Marry';
	$this->head[]= '
		<meta name="copyright" content="Copyright '.date('Y').' Flirt Skirt or Marry, LLC">
		<meta name="description" content="'.$post->meta_description.'">
		<meta name="keywords" content="'.$post->meta_keywords.'">
		<meta name="DC.title" content="'.$this->title.'">
	';
	$this->js[] = '/lib/js/jquery.rotate.min.js';
	$this->template('website','top');
	
	$rs = sql_array("
		SELECT
			id,
			slug
		FROM
			blog_post
		WHERE
			(
				category = 'other' 
			)
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
?>
	<input type="hidden" id="blog_post_slug" value="mules">
	<div class="row">
       	<h2><?=$post->title?></h2>
    </div>
	<div class="row top-margin">
    	<div class="col-md-12 col-sm-12 col-xs-12">
        	<?=$post->body?>
        </div>
    </div>
<?php
	if ($next || $prev) {
?>      
    <div class="row next-prev">
    	<div class="col-md-2">
<?php
	if ($prev) {
?>        
            <img src="/images/icons/pagination-left-arrow.png">
            <a href="/<?=$prev?>">PREV</a>
<?php	
	}
?>
        </div>
        <div class="col-md-2 col-md-offset-8 text-right">
<?php
	if ($next) {
?>
            <a href="/<?=$next?>">NEXT </a>
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
		'category'	=> 'other'
	];
	include 'pages/common/comments.php';
	
	$this->template('website','bottom');