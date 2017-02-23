<?php
	use \FSM\Model\blog_post;

	$this->title = 'Flirt Skirt or Marry';
	$this->head[]= '
		<meta name="copyright" content="Copyright '.date('Y').' Flirt Skirt or Marry, LLC">
		<meta name="description" content="Fashion styles that are currently trending. Will you Flirt, Skirt or Marry these trends? Vote now!">
		<meta name="keywords" content="fashion trends,spring fashion trends,fall fashion trends,summer fashion trends,latest fashion trends,trending styles,favorite fashion,favorite styles">
		<meta name="DC.title" content="'.$this->title.'">
	';
	$this->template('website','top');
	
	if ($_COOKIE['pop-up']) $popup = 1;
	else $popup = 0;
	
	$trends = blog_post::getMany([
		'where'		=> "category = 'fashion trend' and status = 1 and blog_post.post_datetime <= now()",
		'sort'		=> 'blog_post.post_datetime',
		'sort_dir'	=> 'DESC',
		'limit'		=> 3
	]);
					
	$posts = blog_post::getMany([
		'where'		=> "category != 'fashion trend' and status = 1 and blog_post.post_datetime <= now()",
		'sort'		=> 'blog_post.post_datetime',
		'sort_dir'	=> 'DESC',
		'limit'		=> 20
	]);
	
	$trendCount = count($trends);
	//include 'data.php';
?>
	<input type="hidden" id="popup" value="<?=$popup?>">
	<div id="topSurround" class="surround"></div>
    <div id="rightSurround" class="surround"></div>
    <div id="bottomSurround" class="surround"></div>
    <div id="leftSurround" class="surround"></div>
    <div id="slideOverlay"></div>
    <div id="slideOverlayText">
        <div class="overlayText">THE TREND</div>
        <div class="overlayTrend"><?=strtoupper($trends[0]->title)?></div>
        <div class="overlayLines"></div>
        <div class="overlayFlirt overlayLink" data-vote="flirt"></div>
        <div class="overlaySkirt overlayLink" data-vote="skirt"></div>
        <div class="overlayMarry overlayLink" data-vote="marry"></div>            
    </div>
<?php
	if ($trends) {
?>
    <div id="main-tag">THE TREND <span class="trend-tag italic basker"><?=strtoupper($trends[0]->title)?></span></div>
    <div class="triangle-l"></div>
    <div class="">        	
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 slides" data-cycle-swipe=true data-cycle-swipe-fx=scrollHorz>
<?php
		if ($trendCount > 1) { 
?>
        	<div class="cycle-pager"></div>
<?php
		}
		foreach ($trends as $trend) {
			$articles = [];
			foreach ($trend->articles as $art) {
				$articles[$art->category][] = $art;
			}
?>
			<img src="<?=$articles['carousel'][0]->img_src?>" class="img-responsive slide" data-name="<?=strtoupper($trend->title)?>" data-ide="<?=$trend->ide?>" data-slug="<?=$trend->slug?>" data-similar="<?=$trend->similar->slug?>" data-tag="<?=$trend->tagline?>" data-desc="<?=str_replace('"',"&quot;",strip_tags($trend->body))?>">
<?php
		}
?>
        </div>        
    </div>
    <div id="mainTrend" class="row <?=$trendCount==1?'smaller-padding':''?>" >
        <div class="col-xs-12 col-sm-5 col-md-5 panel" style="vertical-align: top;">
            <div id="mainTrendTag"><?=strtoupper($trends[0]->tagline)?></div> <div id="mainTrendDescription" class="basker"><?=strip_tags($trends[0]->body)?></div>
        </div>
        <div class="would-you hidden-xs hidden-sm col-md-2 panel">
            WOULD YOU <strong>FLIRT</strong>, <strong>SKIRT</strong><br>or <strong>MARRY</strong><br> THIS TREND?
            <i class="fa fa-arrow-right circle-arrow"></i>
        </div>
        <div class="votes hidden-xs col-sm-6 col-md-6 text-center panel" data-ide="<?=$trends[0]->ide?>">
            <a class="voteLink flirt" href="/style-tips/<?=$trends[0]->slug?>" data-vote="flirt"><img src="/images/icons/flirt.png" class="img-responsive vote-button" style="margin:0 auto"></a>
            <a class="voteLink skirt" href="/shopping/<?=$trends[0]->slug?>?section=skirt" data-vote="skirt"><img src="/images/icons/skirt.png" class="img-responsive vote-button" style="margin:0 auto"></a>
            <a class="voteLink marry" href="/shopping/<?=$trends[0]->slug?>?section=marry" data-vote="marry"><img src="/images/icons/marry.png" class="img-responsive vote-button" style="margin:0 auto"></a>
        </div>
    </div>
    <div class="row">
        <div class="votes col-xs-12 hidden-sm hidden-md hidden-lg text-center panel" data-ide="<?=$trends[0]->ide?>">
            <a class="voteLink flirt" href="/style-tips/<?=$trends[0]->slug?>" data-vote="flirt"><img src="/images/icons/flirt.png" class="img-responsive vote-button" style="margin:0 auto"></a>
            <a class="voteLink skirt" href="/shopping/<?=$trends[0]->slug?>?section=skirt" data-vote="skirt"><img src="/images/icons/skirt.png" class="img-responsive vote-button" style="margin:0 auto"></a>
            <a class="voteLink marry" href="/shopping/<?=$trends[0]->slug?>?section=marry" data-vote="marry"><img src="/images/icons/marry.png" class="img-responsive vote-button" style="margin:0 auto"></a>
        </div>
    </div>

    
    <div class="row see-more-trends">
    	<a href="/fashion-trends">SEE MORE TRENDS HERE!</a>
    </div>
<?php
	}
	
	if ($posts) 
	foreach($posts as $key => $post) {
		unset($image);
		switch($post->category) {
			case 'have to have it':
				$category = 'Have To Have It';
				$page = '/have-to-have-it';
				foreach($post->articles as $art) { 
					if ($art->category == 'blogroll')  {
						$image = $art->img_src;		
						break;
					}
				}
				if (!$image) $image = $post->articles[1]->img_src;
				break;
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
					echo $body[$x].' ';
				}
?>
            </div>
        </a>
    </div>
<?php
	}
	
	if (count($posts) > 7) {
?>
	<div class="row see-more-trends">
    	<img src="/images/icons/pagination-down-arrow.png">
    	<a data-num="13" id="more-posts">&nbsp;MORE POSTS&nbsp;</a>
        <img src="/images/icons/pagination-down-arrow.png">
    </div>
<?	
	}
?>
	<div class="row see-more-trends goto-archive">
    	<a href="archive">GO TO ARCHIVE </a>
        <img src="/images/icons/pagination-right-arrow.png">
    </div>
<?php
	$this->template('website','bottom');