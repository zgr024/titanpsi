<?php
	redirect('/');

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
			'sort_dir'	=> 'DESC',
		]);
	}
	
	$this->title = 'Final Forecast - '.$post->title.' | Flirt Skirt or Marry';
	$this->head[]= '
		<meta name="copyright" content="Copyright '.date('Y').' Flirt Skirt or Marry, LLC">
		<meta name="description" content="'.$post->final_description.'">
		<meta name="keywords" content="'.$post->final_keywords.'">
		<meta name="DC.title" content="'.$this->title.'">
	';
	$this->page = 'final';
	$this->js[] = "/pages/final-forecast/includes/pie-chart.js";
	$this->template('website','top');
	
	
	
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
	
	if ($post->articles) foreach ($post->articles as $art) {
		$articles[$art->category][] = $art;
	}
	
	$total = 0;
	$x = 0;
	$votes = array();
	
	if (count($post->total_votes) > 0) {
		foreach($post->total_votes as $vote) {
			$votes[$vote->type]['west'] = $vote->west;
			$votes[$vote->type]['southwest'] = $vote->southwest;
			$votes[$vote->type]['midwest'] = $vote->midwest;
			$votes[$vote->type]['northeast'] = $vote->northeast;
			$votes[$vote->type]['southeast'] = $vote->southeast;
			$votes[$vote->type]['total'] = $vote->west + $vote->southwest + $vote->midwest + $vote->northeast + $vote->southeast;
			$total += $votes[$vote->type]['total'];
			if (!$previous_type) { $max = $votes[$vote->type]['total']; $slice = $x; }
			else if ($votes[$vote->type]['total'] > $votes[$previous_type]['total']) { $max = $votes[$vote->type]['total']; $slice = $x; }
			$previous_type = $vote->type;
			$x++;
		}
	}
	else {
	
		$votes = [
			'flirt'	=> [
				'west' 		=> 20,
				'southwest'	=> 29,
				'midwest'	=> 35,
				'northeast'	=> 40,
				'southeast'	=> 24
			],
			'skirt'	=> [
				'west' 		=> 12,
				'southwest'	=> 13,
				'midwest'	=> 15,
				'northeast'	=> 20,
				'southeast'	=> 14
			],
			'marry'	=> [
				'west' 		=> 2,
				'southwest'	=> 2,
				'midwest'	=> 3,
				'northeast'	=> 4,
				'southeast'	=> 2
			]
		];
		
		
		foreach ($votes as $item => $arr) {
			$votes[$item]['total'] = array_sum(array_values($arr));
			$total += $votes[$item]['total'];
		}
		
		
		$max = 148;
		$slice = 0;		
	}
	
	$top = [
		30,
		81,
		132
	];
	
	if ($votes['flirt']['total'] == $max) $text = 'and many of you are willing to flirt with it!';
	else if ($votes['skirt']['total'] == $max) $text = 'but many of you are interested in purchasing alternatives.';
	else if ($votes['marry']['total'] == $max) $text = 'and you agree it\'s the trend to marry!';
?>
	<input type="hidden" id="finalStart1" value="<?=$slice?>">
	<div class="row">
    	<h4>(FINAL FORECAST)</h4>
       	<h2><?=$post->title?></h2>
    </div>
    <div class="row">
    	<div class="col-md-10 col-md-offset-1 text-center header-text">We've added up your clicks, and gone through your data.<br>Runway show after runway show flaunted the trend, <?=$text?></div>
    </div>
    <div class="row dotted-border">
    	<div class="col-lg-4 col-md-4 hidden-sm hidden-xs text-center">
        	<div id="pie-chart">
				<?php include 'includes/pie-chart.php' ?>
                <img src="/images/final-forecast/right-arrow.png" class="arrow">
			</div>            
        </div>        
        <div class="col-md-3 col-sm-3 col-xs-5 text-center vote-buttons">
        	<div class="reveal-box <? if ($votes['flirt']['total'] == $max) { echo 'on'; $selected = true; } else { echo 'off'; } ?>" data-color="#1ac3f4" data-value="<?=$votes['flirt']['total']?>" data-percent="<?=number_format($votes['flirt']['total']/$total*100,1)?>" id="flirt">FLIRT</div>
            <div class="reveal-box <? if ($votes['skirt']['total'] == $max && !$selected) { echo 'on'; $selected = true; } else { echo 'off'; } ?>" data-color="#6dcff6" data-value="<?=$votes['skirt']['total']?>" data-percent="<?=number_format($votes['skirt']['total']/$total*100,1)?>" id="skirt">SKIRT</div>
            <div class="reveal-box <? if ($votes['marry']['total'] == $max && !$selected) { echo 'on'; } else { echo 'off'; } ?>" data-color="#9ddcf9" data-value="<?=$votes['marry']['total']?>" data-percent="<?=number_format($votes['marry']['total']/$total*100,1)?>" id="marry">MARRY</div>
            <img src="/images/final-forecast/right-arrow.png" id="dynamic-arrow" style="top: <?=$top[$slice]?>px">
        </div>
        <div class="col-md-5 col-sm-7 col-xs-7 text-center">
        	<div class="results-box"><?=number_format($max/$total*100,1)?>%</div>
        </div>
    </div>
    <div class="row">
    	<div class="col-md-6 col-md-offset-3 text-center map-instructions">
        	<strong><?=strtoupper($articles['final_forecast'][0]->details[0]->name)?></strong><br><br>
            CLICK ON THE REGION TO DISCOVER<br>HOW OUR DATA MEASURED UP<br>ACROSS THE COUNTRY<br>
            <img src="/images/final-forecast/down-arrow.png" class="down-arrow">            
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 hidden-sm hidden-xs">
			<div id="mapContainer">
                <img src="/images/final-forecast/grey-map.png" class="img-responsive auto-margin">
                <img src="/images/final-forecast/west.png" id="west" class="img-responsive hidden-map">
                <img src="/images/final-forecast/southwest.png" id="southwest" class="img-responsive hidden-map" >
                <img src="/images/final-forecast/midwest.png" id="midwest" class="img-responsive hidden-map">
                <img src="/images/final-forecast/northeast.png" id="northeast" class="img-responsive hidden-map">
                <img src="/images/final-forecast/southeast.png" id="southeast" class="img-responsive hidden-map">
                
<?
			$locations = [
				'west',
				'southwest',
				'midwest',
				'northeast',
				'southeast'
			];
			$types = [
				'flirt',
				'skirt',
				'marry'
			];
			
			$percentage = $totals = [];
			foreach($locations as $location) {
				$totals[$location] = $votes['flirt'][$location] + $votes['skirt'][$location] + $votes['marry'][$location];
?>
				<div class="hidden-number" id="votes-<?=$location?>">
<?
				$runningTotal = 0;
				foreach ($types as $key => $type) {
					if ($totals[$location] > 0) {
						$percentage[$type][$location] = number_format($votes[$type][$location]/$totals[$location] * 100,0);					
						if ($key < 2) $runningTotal += $percentage[$type][$location];
						else $percentage[$type][$location] = 100 - $runningTotal;					
					} else $percentage[$type][$location] = 0;
					
?>
                    <div class="map-number"><?=$percentage[$type][$location]?>%</div>
<?
				}
?>
                </div>
                <div class="map-location" id="location-<?=$location?>"><?=strtoupper($location)?></div>
<?
			}
?>
            </div>
        </div>
        <div class="hidden-lg hidden-md col-sm-12 col-xs-12">
            <div id="mapContainer">
                <img src="/images/final-forecast/grey-map.png" class="img-responsive auto-margin">
<?
			foreach($locations as $location) {
?>
                <div class="text-box" id="box-<?=$location?>">
<?
				$runningTotal = 0;
				foreach ($types as $type) {
?>
                    <div class="col-xs-6"><?=strtoupper($type)?></div>
                    <div class="col-xs-6 num"><?=$percentage[$type][$location]?>%</div>
<?				
				}
?>
				</div>
<?
			}
?>
            </div>
            <div class="text-location">WEST</div>
            <div class="text-location">SOUTHWEST</div>
            <div class="text-location">MIDWEST</div>
            <div class="text-location">NORTHEAST</div>
            <div class="text-location">SOUTHEAST</div>
        </div>    
    </div>
   
<?php
	if ($prev || $next) {
?>
		<input type="hidden" id="blog_post_slug" value="<?=$post->slug?>">	
    <div class="row next-prev">
    	<div class="col-md-2">
<?php
		if ($prev) {
?>        
            <img src="/images/icons/pagination-left-arrow.png">
            <a href="/final-forecast/<?=$prev?>">PREV</a>
<?	
		}
?>
        </div>
        <div class="col-md-2 col-md-offset-8 text-right">
<?php
		if ($next) {
?>
            <a href="/final-forecast/<?=$next?>">NEXT </a>
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
		'category'	=> 'final-forecast'
	];
	include 'pages/common/comments.php';
	
	$this->template('website','bottom');