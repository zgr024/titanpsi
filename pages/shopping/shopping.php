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
			'where'		=> "(category = 'shopping' OR category = 'fashion trend') and status = 1 and blog_post.post_datetime <= now()",
			'sort'		=> 'blog_post.post_datetime',
			'sort_dir'	=> 'DESC',
		]);
	}
	
	$rs = sql_array("
		SELECT
			id,
			slug
		FROM
			blog_post
		WHERE
			(
				category = 'shopping' 
				OR category = 'fashion trend'
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
	
	$data = array();
	
	$this->title = 'Shopping | Flirt Skirt or Marry';
	$this->head[]= '
		<meta name="copyright" content="Copyright '.date('Y').' Flirt Skirt or Marry, LLC">
		<meta name="description" content="Shopping for '.$post->title.'">
		<meta name="keywords" content="'.$post->shopping_keywords.'">
		<meta name="DC.title" content="'.$this->title.'">
	';
	$this->page = 'shopping';
	$this->js[] = '/lib/js/jquery.rotate.min.js';
	$this->template('website','top');

	if ($post->category == 'fashion trend') include 'pages/shopping/includes/fashion.php';
	else include 'pages/shopping/includes/shopping.php';

	if ($prev || $next) {
?>
	<input type="hidden" id="blog_post_slug" value="<?=$post->slug?>">	
    <div class="row next-prev">
    	<div class="col-md-2">
<?php
		if ($prev) {
?>        
            <img src="/images/icons/pagination-left-arrow.png">
            <a href="/shopping/<?=$prev?>">PREV</a>
<?	
		}
?>
        </div>
        <div class="col-md-2 col-md-offset-8 text-right">
<?php
		if ($next) {
?>
            <a href="/shopping/<?=$next?>">NEXT </a>
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
		'category'	=> 'shopping'
	];
	include 'pages/common/comments.php';
	*/

	$this->template('website','bottom');