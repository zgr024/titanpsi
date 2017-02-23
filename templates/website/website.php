<?php
	use \FSM\Model\blog_post;
	
	if ($template_area == 'top') {	
		if ($_GET['destroy']) session_destroy();
		$this->css[] = '/lib/bootstrap-3.3.2-dist/css/bootstrap.min.css';
		$this->css[] = '/lib/font-awesome-4.3.0/css/font-awesome.min.css';
		$this->css[] = '/pages/common/comments.css';
		$this->js[]  = '/lib/bootstrap-3.3.2-dist/js/bootstrap.min.js';
		$this->js[] = '/lib/js/jquery.cycle2.min.js';
		$this->js[] = '/lib/js/jquery.livequery.min.js';
		$this->favicon = '/images/icons/flirt.png';
		//$this->head[] = '<meta name="google-signin-client_id" content="261152422833-o56e3spu9glj8fenkspgo091rd37jb86.apps.googleusercontent.com">';
		$this->head[] = '<meta name="robots" content="index,follow">
		<meta name="google-site-verification" content="KmQnCuHEwH0qrQ_iE0MS2r_WUpyMmZaaVrx91PAJTHw" />
		<meta name="google-site-verification" content="2V6v__YZXgZ5_xP7il-iOn-sx8-QJcRSVS7nOU4w3V4" />';
		$this->template('html5','top');

        if ($_COOKIE['pop-up']) $popup = 1;
        else $popup = 0;
?>
        <input type="hidden" id="popup" value="<?=$popup?>" />
        <input type="hidden" id="sidebarValue" value="<?=$this->sidebar?$this->sidebar:'regular'?>" />
		<link href='http://fonts.googleapis.com/css?family=Libre+Baskerville:400,700,400italic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Khula:400,300,600,700,800' rel='stylesheet' type='text/css'>
        <link rel="alternate" type="application/rss+xml" title="Flirt Skirt or Marry" href="http://<?=$_SERVER['SERVER_NAME']?>/feed" />
		<script src="/pages/common/comments.js"></script>
        <script src="https://apis.google.com/js/api:client.js"></script>
		<header class="container-fluid hidden-xs">
        	<div class="container">
            	<div class="row">
                	<div class="col-md-3 col-sm-4 social-header">
                    	<div class="left-t"></div>
                        <div class="icon-container">
                            <a target="_blank" href="https://facebook.com/flirtskirtormarry"><img class="fb" src="/images/icons/fb-header.png"></a>
                            <a target="_blank" href="http://www.instagram.com/flirtskirtormarry"><img class="insta" src="/images/icons/insta-header.png"></a>
                            <a target="_blank" href="http://www.twitter.com/flskirtmarry"><img class="twitter" src="/images/icons/twitter-header.png"></a>
                            <a target="_blank" href="https://www.pinterest.com/flirtskirtmarry"><img class="pinterest" src="/images/icons/pinterest-header.png"></a>
                        </div>
                       	<div class="right-t"></div>
                    </div>
                    <div class="col-md-9 col-sm-8 search-header">
                    	<div class="float-right">
                            <div class="search-l <?=$_GET['q']?'':'tempHide'?>"></div>
                                <input type="text" class="search-text <?=$_GET['q']?'':'tempHide'?>" value="<?=$_GET['q']?>">
                            <div class="search-r <?=$_GET['q']?'':'tempHide'?>"></div>
                            <img src="/images/icons/search-button.png" class="search-button">
                        </div>
					</div>
                </div>
            </div>
        </header>
		<div class="container">
            <div class="row hidden-md hidden-lg hidden-xl">
                <div class="col-sm-12 col-xs-11 col-xs-offset-1 col-sm-offset-0 logo">
                    <a href="/"><img id="logo" class="img-responsive" src="/images/fsm-logo.png"></a>
                </div>
                <div class="navbar navbar-fsm navbar-static-top" role="navigation" style="align-items: flex-end">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only white">Toggle navigation</span>
                            <span class="icon-bar white"></span>
                            <span class="icon-bar white"></span>
                            <span class="icon-bar white"></span>
                        </button>
                    </div>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li><a <?=$this->page=='fashion'?'class="active"':''?> href="/fashion-trends">FASHION TRENDS</a></li>
                            <li><a <?=$this->page=='style'?'class="active"':''?> href="/style-tips">STYLE TIPS</a></li>
                            <li><a <?=$this->page=='shopping'?'class="active"':''?> href="/shopping">SHOPPING</a></li>
                            <li><a <?=$this->page=='haveto'?'class="active"':''?> href="/have-to-have-it">HAVE TO HAVE IT</a></li>
                            <!--<li><a <?=$this->page=='final'?'class="active"':''?> href="/final-forecast">FINAL FORECAST</a></li>-->
                            <li class="noSlash"><a <?=$this->page=='about'?'class="active"':''?> href="/about">ABOUT</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row hidden-xs hidden-sm text-center">
            
                <a href="/"><img id="logo" class="img-responsive" src="/images/fsm-logo.png"></a>
            
                <div class="navbar navbar-fsm navbar-static-top" role="navigation" style="align-items: flex-end">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only white">Toggle navigation</span>
                            <span class="icon-bar white"></span>
                            <span class="icon-bar white"></span>
                            <span class="icon-bar white"></span>
                        </button>
                    </div>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li><a <?=$this->page=='fashion'?'class="active"':''?> href="/fashion-trends">FASHION TRENDS</a></li>
                            <li><a <?=$this->page=='style'?'class="active"':''?> href="/style-tips">STYLE TIPS</a></li>
                            <li><a <?=$this->page=='shopping'?'class="active"':''?> href="/shopping">SHOPPING</a></li>
                            <li><a <?=$this->page=='haveto'?'class="active"':''?> href="/have-to-have-it">HAVE TO HAVE IT</a></li>
                            <!--<li><a <?=$this->page=='final'?'class="active"':''?> href="/final-forecast">FINAL FORECAST</a></li>-->
                            <li class="noSlash"><a <?=$this->page=='about'?'class="active"':''?> href="/about">ABOUT</a></li>
                        </ul>
                    </div>
                </div>
            </div>
			<div class="col-xs-12 <?=$this->noSidebar?'col-md-12':'col-sm-8 col-md-8'?> blog-main">
<?php
	}
	else if ($template_area == 'bottom') {
		$haveTo = blog_post::getOne([
			"where"		=> "category = 'have to have it' and status = 1 and post_datetime <= now()",
			"sort"		=> "blog_post.post_datetime",
			"sort_dir"	=> "desc"
		]);
		
		if ($haveTo->articles) foreach($haveTo->articles as $article) {
			if ($article->category == 'sidebar') {
				$haveToSidebar = $article;
				break;
			}
		}
		
		$featured = blog_post::getOne([
			"where"		=> "featured = 1"
		]);
		
		if (!$featured->id) {
		
			$featured = blog_post::getOne([
				"where"		=> "category != 'have to have it' and category != 'fashion trend' and status = 1 and post_datetime <= now()",
				"sort"		=> "blog_post.post_datetime",
				"sort_dir"	=> "desc"
			]);
	
		}
		
		if ($featured->category == 'shopping') $featured->url = '/shopping/'.$featured->slug;
		else $featured->url = '/'.$featured->slug;
		
		$instagram = json_decode(GetCurlPage('http://api.instagram.com/oembed?url=http://instagr.am/p/1G6y8eIZwL/'));
?>
			</div>
<?php
		if (!$this->noSidebar) {
			
			$user_id = 654807150;
			$token = '654807150.42928b5.a6236e6ba0ff47e983187c0c9f5e38db';
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,'https://api.instagram.com/v1/users/'.$user_id.'/media/recent/?access_token='.$token);
			
			// Set so curl_exec returns the result instead of outputting it.
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);	
			
			// Get the response and close the channel.
			$response = json_decode(curl_exec($ch));
			curl_close($ch);
			
			foreach ($featured->articles as $art) {
				$articles[$art->category][] = $art;
			}
			$featuredImage = $articles['blogroll'][0]->img_src;
			
?>            
			<div class="row hidden-sm hidden-md hidden-lg side">
                <div class="col-xs-12">
                    <div class="row sidebar-rule">
                        <div class="col-xs-12">
<?php
                        if ($this->sidebar == 'how-to') {
?>
                            <a href="/about"><img src="/images/our-story.jpg" class="img-responsive auto-margin" align="Our Story"></a>
<?php
                        } 
                        else {
?>
                            <a href="/how-to-use"><img src="/images/how-to-use.png" class="img-responsive auto-margin" alt="How to use this site"></a>
<?php
                        }   
?>
                        </div>
                    </div>
                    <hr class="side-hr">
                    <div class="row sidebar-rule">
                        <div class="col-xs-12 text-center">
                            <div class="white-btn text-center">
								<a href="/have-to-have-it/<?=$haveToSidebar->slug?>"><?=$haveToSidebar->details[0]->name?></a>
                            </div>
                        </div>
                        <div class="col-xs-12" style="margin: 10px 0">
                            <a href="/have-to-have-it/<?=$haveToSidebar->slug?>"><img src="<?=$haveToSidebar->img_src?>" class="img-responsive auto-margin"></a>
                        </div>
                        <div class="col-xs-12 text-center">
                            <?=$haveToSidebar->details[0]->description?>
                            <p class="side-more"><a href="/have-to-have-it/<?=$haveToSidebar->slug?>">FOR MORE</a></p>
                        </div>
                    </div>
                    <hr class="side-hr">
                    <div class="row sidebar-rule">
                        <div class="col-xs-12 text-center">
                            <div class="white-btn text-center">
                                <a href="<?=$featured->url?>">FEATURED POST</a>
                            </div>
                        </div>
                        <div class="col-xs-12"  style="margin:10px auto">
                            <a href="<?=$featured->url?>"><img src="<?=$featuredImage?>" class="img-responsive auto-margin"></a>
                        </div>
                        <div class="col-xs-12 text-center">
                            <p class="featured-title"><?=$featured->title?></p>
                            <?=$featured->preview?>
                            <p class="side-more"><a href="<?=$featured->url?>">FOR MORE</a></p>
                        </div>
                    </div>
                    <!--
                    <hr class="side-hr">
                    <div class="row sidebar-rule text-center social">
                        <a class="socialSidebar" target="_blank" href="https://facebook.com/flirtskirtormarry"><img src="/images/icons/fb.png"></a>
                        <a class="socialSidebar" target="_blank" href="http://www.instagram.com/flirtskirtormarry"><img src="/images/icons/insta.png"></a>
                        <a class="socialSidebar" target="_blank" href="http://www.twitter.com/flskirtmarry"><img src="/images/icons/twitter.png"></a>
                        <a class="socialSidebar" target="_blank" href="https://www.pinterest.com/flirtskirtmarry/"><img src="/images/icons/pinterest.png"></a>
                    </div>
                    -->
                    <hr class="side-hr">
                    <div class="row sidebar-rule">
                        <div class="col-xs-12 text-center">
                            <div class="white-btn text-center insta-click">
                                INSTAGRAM
                            </div>
                        </div>
                        <div class="col-xs-12" style="margin: 10px auto">
                        	<div class="instaslides" id="instagram">
<?php
							foreach ($response->data as $image) {
?>
								<a target="_blank" href="<?=$image->link?>"><img src="<?=$image->images->standard_resolution->url?>"></a>
<?php
								break;
							}
?>
                                <div id="breakPoint"></div>
 							</div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="hidden-xs col-sm-3 col-sm-offset-1 blog-sidebar side">
                <div class="row sidebar-rule">
                    <div class="col-xs-12">
<?php
                        if ($this->sidebar == 'how-to') {
?>
                            <a href="/about"><img src="/images/our-story.jpg" class="img-responsive auto-margin" align="Our Story"></a>
<?php
                        } 
                        else {
?>
                            <a href="/how-to-use"><img src="/images/how-to-use.png" class="img-responsive auto-margin" alt="How to use this site"></a>
<?php
                        }   
?>                    </div>
                </div>
                <hr class="side-hr">
<?php
            if ($this->sidebar != 'how-to') {
?>                
                <div class="row sidebar-rule">
                    <div class="col-xs-12">
                        <div class="white-btn text-center">
                            <a href="/have-to-have-it/<?=$haveToSidebar->slug?>"><?=$haveToSidebar->details[0]->name?></a>
                        </div>
                    </div>
                    <div class="col-xs-12" style="margin: 10px">
                        <a href="/have-to-have-it/<?=$haveToSidebar->slug?>"><img src="<?=$haveToSidebar->img_src?>" class="img-responsive auto-margin"></a>
                    </div>
                    <div class="col-xs-12 text-center">
                       <?=$haveToSidebar->details[0]->description?>
	                   <p class="side-more"><a href="/have-to-have-it/<?=$haveToSidebar->slug?>">FOR MORE</a></p>
                    </div>
                </div>
                <hr class="side-hr">
                <div class="row sidebar-rule">                    
                    <div class="col-xs-12">
                        <div class="white-btn text-center">
                            <a href="<?=$featured->url?>">FEATURED POST</a>
                        </div>
                    </div>
                    <div class="col-xs-12" style="margin:10px auto">
                        <a href="<?=$featured->url?>"><img src="<?=$featuredImage?>" class="img-responsive auto-margin"></a>
                    </div>
                    <div class="col-xs-12 text-center">
                       <p class="featured-title"><?=$featured->title?></p>
                       <?=$featured->preview?>
	                   <p class="side-more"><a href="<?=$featured->url?>">FOR MORE</a></p>
                    </div>      
                    <!--              
                    <div class="col-xs-12 text-center">
                        <a href="http://nordstrom.com"><img src="/images/ads/nordstrom.jpg" class="img-responsive auto-margin"></a>
                    </div>
                    -->
                </div>
                <hr class="side-hr">
<?php
            }
?>                
                <div class="row sidebar-rule text-center social">
                    <a class="socialSidebar" target="_blank" href="https://facebook.com/flirtskirtormarry"><img src="/images/icons/fb.png" class="social img-responsive"></a>
                    <a class="socialSidebar" target="_blank" href="http://www.instagram.com/flirtskirtormarry"><img src="/images/icons/insta.png" class="social img-responsive"></a>
                    <a class="socialSidebar" target="_blank" href="http://www.twitter.com/flskirtmarry"><img src="/images/icons/twitter.png" class="social img-responsive"></a>
                    <a class="socialSidebar" target="_blank" href="https://www.pinterest.com/flirtskirtmarry/"><img src="/images/icons/pinterest.png" class="social img-responsive"></a>
                </div>
                <hr class="side-hr">
                <div class="row sidebar-rule">
                    <div class="col-xs-12">
                        <div class="white-btn text-center insta-click">
                            INSTAGRAM
                        </div>
                    </div>
                    <div class="col-xs-12" style="margin: 10px 0">
                        <div class="instaslides instaDesktop" id="instagram">
<?php
							foreach ($response->data as $image) {
?>
								<a target="_blank" href="<?=$image->link?>"><img src="<?=$image->images->standard_resolution->url?>"></a>
<?php
								break;
							}
?>
 							</div>
                    </div>
                </div>
            </div>
<?php
		}
?>
		</div>
        <div class="clear"></div>
		<footer class="container-fluid">
        	<div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 hidden-xs col-xs-12">
                    	<nav class="footer-nav">
                        	<li><a href="/about">ABOUT US</a></li>
                            <li><a href="/about#contact">CONTACT</a></li>
                            <li><a href="/archive">ARCHIVE</a></li>
                            <li><a href="/how-to-use">HOW TO USE THIS SITE</a></li>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-6 hidden-xs">
                    	<div class="float-right connect hidden-xs">
                        	<span class="hidden-xs">CONNECT WITH FLIRT SKIRT OR MARRY</span>
                            <a target="_blank" href="https://facebook.com/flirtskirtormarry"><img src="/images/icons/fb-footer.png"></a>
                            <a target="_blank" href="http://www.instagram.com/flirtskirtormarry"><img src="/images/icons/insta-footer.png"></a>
                            <a target="_blank" href="http://www.twitter.com/flskirtmarry"><img src="/images/icons/twitter-footer.png"></a>
                            <a target="_blank" href="https://www.pinterest.com/flirtskirtmarry/"><img src="/images/icons/pinterest-footer.png"></a>
                            <a target="_blank" href="http://<?=$_SERVER['SERVER_NAME']?>/feed"><img src="/images/icons/rss-footer.png"></a>
                        </div>
                    </div>
                    <div class="hidden-lg hidden-md hidden-sm col-xs-12 text-center">
                    	<div class="connect">
                        	<span class="hidden-xs">CONNECT WITH FLIRT SKIRT OR MARRY</span>
                            <a target="_blank" href="https://facebook.com/flirtskirtormarry"><img src="/images/icons/fb-footer.png"></a>
                            <a target="_blank" href="http://www.instagram.com/flirtskirtormarry"><img src="/images/icons/insta-footer.png"></a>
                            <a target="_blank" href="http://www.twitter.com/flskirtmarry"><img src="/images/icons/twitter-footer.png"></a>
                            <a target="_blank" href="https://www.pinterest.com/flirtskirtmarry/"><img src="/images/icons/pinterest-footer.png"></a>
                            <a target="_blank" href="http://<?=$_SERVER['SERVER_NAME']?>/feed"><img src="/images/icons/rss-footer.png"></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                	<div class="col-md-12 text-center footer-logo"><img class="img-responsive auto-margin" src="/images/fsm-logo-footer.png"></div>
                </div>
                <div class="row">
                	<div class="col-md-12 text-center copyright">&copy; FLIRT SKIRT OR MARRY <?=date('Y')?>. ALL RIGHTS RESERVED.</div>
                </div>
            </div>
        </footer>

        <div id="howToPopup">
            <a class="pull-right closePopup">close window</a>
            <img class="img-responsive" src="/images/pop-up/how-to.jpg">
            <div class="row">
                <div class="pull-right"><label><input type="checkbox" id="dont-show"> <span class="dont">don't show me this again</span></label>
            </div>
        </div>
       
<?php
		$this->template('html5','bottom');
	}