<?php
	use \FSM\Model\blog_post;
	
	$this->title = "Fashion Trends | Flirt Skirt or Marry";
	$this->page = 'fashion';
	$this->head[]= '
		<meta name="copyright" content="Copyright '.date('Y').' Flirt Skirt or Marry, LLC">
		<meta name="description" content="Flirt, Skirt or Marry these fashion trends?">
		<meta name="keywords" content="voting for fashion,fashion trends,latest fashion,flirt,skirt,marry">
		<meta name="DC.title" content="'.$this->title.'">
	';
	$this->template('website','top');

	$limit = 20;	
	$startLimit = 7;
	$pg = $_GET['pg']?$_GET['pg']:1;
	$offset = ($limit * $pg) - $limit;
	
	$trends = blog_post::getMany([
		'where'		=> "category = 'fashion trend' and status = 1 and blog_post.post_datetime <= now()",
		'sort'		=> 'blog_post.post_datetime',
		'sort_dir'	=> 'DESC',
		'limit'		=> $startLimit,
		'offset'	=> $offset
	]);
	$moreTrends = blog_post::getMany([
		'where'		=> "category = 'fashion trend' and status = 1 and blog_post.post_datetime <= now()",
		'sort'		=> 'blog_post.post_datetime',
		'sort_dir'	=> 'DESC',
		'offset'	=> $offset + 7,
		'limit'		=> $limit - $startLimit
	]);
	
	$nextTrends = blog_post::getMany([
		'where'		=> "category = 'fashion trend' and status = 1 and blog_post.post_datetime <= now()",
		'sort'		=> 'blog_post.post_datetime',
		'sort_dir'	=> 'DESC',
		'offset'	=> ($offset + $limit + 1),
		'limit'		=> 1
	]);
	
	$count = count($trends);
	foreach ($trends as $key => $trend) {
		$articles = [];
		foreach ($trend->articles as $art) {
			$articles[$art->category][] = $art;
		}
?>	
    <div class="row">        	
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 slides">
       		<img src="<?=$articles['carousel'][0]->img_src?>" class="img-responsive slide" data-slug="<?=$trend->slug?>">
            <div class="main-tag">THE TREND <span class="trend-tag italic basker"><?=strtoupper($trend->title)?></span></div>
            <div class="triangle-l"></div>
        </div>        
    </div>
    <div class="row mainTrend" <?=$key==$count-1?'style="border-bottom: none;"':''?>>
        <div class="col-xs-12 col-sm-5 col-md-5 panel" style="vertical-align: top;">
            <div class="mainTrendTag"><?=strtoupper($trend->tagline)?></div> <div class="mainTrendDescription basker"><?=strip_tags($trend->body)?></div>
        </div>
        <div class="would-you hidden-xs hidden-sm col-md-2 panel">
            WOULD YOU <strong>FLIRT</strong>, <strong>SKIRT</strong><br>or <strong>MARRY</strong><br> THIS TREND?
            <i class="fa fa-arrow-right circle-arrow"></i>
        </div>
        <div class="votes hidden-xs col-sm-6 col-md-6 text-center panel" <?=$key==$count-1?'style="border-bottom: none;"':''?> data-ide="<?=$trend->ide?>">
            <a class="voteLink flirt" href="/style-tips/<?=$trend->slug?>" data-vote="flirt"><img src="/images/icons/flirt.png" class="img-responsive vote-button" style="margin:0 auto"></a>
            <a class="voteLink skirt" href="/shopping/<?=$trend->slug?>?section=skirt" data-vote="skirt"><img src="/images/icons/skirt.png" class="img-responsive vote-button" style="margin:0 auto"></a>
            <a class="voteLink marry" href="/shopping/<?=$trend->slug?>?section=marry" data-vote="marry"><img src="/images/icons/marry.png" class="img-responsive vote-button" style="margin:0 auto"></a>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 hidden-sm hidden-md hidden-lg hidden-xl">
            <div class="mainTagBorder">
                <div class="downArrow"></div>
            </div>
            <div class="text-center basker mobileFSM">Do you Flirt, Skirt or Marry<br>this Trend? <span class="italic">(tap to choose)</span></div>
        </div>
    </div>
    <div class="row hidden-sm hidden-md hidden-lg">
        <div class="votes col-xs-12 text-center panel" <?=$key==$count-1?'style="border-bottom: none;"':''?> data-ide="<?=$trend->ide?>"> 
            <a class="voteLink flirt" href="/style-tips/<?=$trend->slug?>" data-vote="flirt"><img src="/images/icons/flirt.png" class="img-responsive vote-button" style="margin:0 auto"></a>
            <a class="voteLink skirt" href="/shopping/<?=$trends->slug?>?section=skirt" data-vote="skirt"><img src="/images/icons/skirt.png" class="img-responsive vote-button" style="margin:0 auto"></a>
            <a class="voteLink marry" href="/shopping/<?=$trend->slug?>?section=marry" data-vote="marry"><img src="/images/icons/marry.png" class="img-responsive vote-button" style="margin:0 auto"></a>
        </div>
    </div>
<?php
	}
	$count = count($moreTrends);
	if ($count) {
?>
    <div class="row see-more-trends">
        <img src="/images/icons/pagination-down-arrow.png">
        <a data-num="10" id="more-posts">&nbsp;MORE TRENDS&nbsp;</a>
        <img src="/images/icons/pagination-down-arrow.png">
    </div>
<?php
	}
	foreach ($moreTrends as $key => $trend) {
        $articles = [];
        foreach ($trend->articles as $art) {
            $articles[$art->category][] = $art;
        }
?>	
    <div class="row more">        	
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 slides">
       		<img src="<?=$articles['carousel'][0]->img_src?>" class="img-responsive slide" data-slug="<?=$trend->slug?>">
            <div class="main-tag">The Trend <span class="trend-tag italic"><?=strtoupper($trend->title)?></span></div>
            <div class="triangle-l"></div>
        </div>        
    
        <div class="row mainTrend" <?=$key==$count-1?'style="border-bottom: none;"':''?>>
            <div class="col-xs-12 col-sm-5 col-md-5 panel" style="vertical-align: top;">
                <div class="mainTrendTag"><?=$trend->tagline?></div> <div class="mainTrendDescription basker"><?=strip_tags($trend->body)?></div>
            </div>
            <div class="would-you hidden-xs hidden-sm col-md-2 panel">
                WOULD YOU <strong>FLIRT</strong>, <strong>SKIRT</strong><br>or <strong>MARRY</strong><br> THIS TREND?
                <i class="fa fa-arrow-right circle-arrow"></i>
            </div>
            <div class="votes hidden-xs col-sm-6 col-md-6 text-center panel">
                <a href="/style-tips/<?=$trend->slug?>"><img src="/images/icons/flirt.png" class="img-responsive vote-button flirt" data-slug="<?=$trend->slug?>" style="margin:0 auto"></a>
                <a href="/shopping/<?=$trends[0]->slug?>?section=skirt"><img src="/images/icons/skirt.png" class="img-responsive vote-button skirt" data-slug="<?=$trend->slug?>" style="margin:0 auto"></a>
                <a href="/shopping/<?=$trends[0]->slug?>?section=marry"><img src="/images/icons/marry.png" class="img-responsive vote-button marry" data-slug="<?=$trend->slug?>" style="margin:0 auto"></a>
            </div>
        </div>
        <div class="row">
            <div class="votes col-xs-12 hidden-sm hidden-md hidden-lg text-center panel">
                <a href="/style-tips/<?=$trend->slug?>"><img src="/images/icons/flirt.png" class="img-responsive vote-button flirt" data-slug="<?=$trend->slug?>" style="margin:0 auto"></a>
                <a href="/shopping/<?=$trends[0]->slug?>?section=skirt"><img src="/images/icons/skirt.png" class="img-responsive vote-button skirt" data-slug="<?=$trend->slug?>" style="margin:0 auto"></a>
                <a href="/shopping/<?=$trends[0]->slug?>?section=marry"><img src="/images/icons/marry.png" class="img-responsive vote-button marry" data-slug="<?=$trend->slug?>" style="margin:0 auto"></a>
            </div>
        </div>
	</div>
<?php
	}

	if ($pg > 1 || count($nextTrends) == 1) {
?>    
    <div class="row next-prev">
    	<div class="col-md-2">
<?php
	if ($pg > 1) {
?>        
            <img src="/images/icons/pagination-left-arrow.png">
            <a href="/fashion-trends?pg=<?=$_GET['pg']-1?>">PREV</a>
<?php	
	}
?>
        </div>
        <div class="col-md-2 col-md-offset-8 text-right">
<?php
	if (count($nextTrends) == 1) {
?>
            <a href="/fashion-trends?pg=<?=$_GET['pg']+1?>">NEXT </a>
            <img src="/images/icons/pagination-right-arrow.png">
<?php
	}
?>
        </div>
    </div>
<?php
	}
		
	$this->template('website','bottom');