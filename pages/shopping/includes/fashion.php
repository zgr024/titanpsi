<?php
	if ($post->articles) foreach($post->articles as $art) {
		if ($art->category == 'marry') {
			$data['marry'][] = $art;
		} 
		else if ($art->category == 'skirt') {
			$data['skirt'][] = $art;
		}
	}
?>
	<div class="row">
       	<h4>(MARRY)</h4>
		<h2>Must Have <?=$post->title?></h2>
    </div>
<!--
	<div class="row">
    	<div class="col-md-8 col-md-offset-2 text-center serif italic header-text"><?=$data['marry']['description']?></div>
    </div>
-->
    <div class="row shopping marry">
<?php
	if ($data['marry']) foreach ($data['marry'] as $key => $item) {
?>
    	<div class="col-md-4 col-sm-4 text-center">
        	<div class="col-md-12">
	            <a target="_blank" href="<?=$item->details[0]->href?>"><img class="img-responsive" src="<?=$item->img_src?>"></a>
            </div>
            <div class="col-md-12 text-center info">
	            <a target="_blank" href="<?=$item->details[0]->href?>"><?=$item->details[0]->name?></a><br>
                <span class="price">$<?=$item->details[0]->price?></span>
            </div>            
        </div>
<?php
		if (!(($key+1) % 3)) {
?>
	</div>
	<div class="row shopping marry">      
<?php
		}
	}
?>
	</div>
    
    <div class="row mainTrend">
        <div class="would-you hidden-xs hidden-sm col-md-6 col-md-offset-2 panel">
            <a>WOULD YOU RATHER?</a><br>
            INTERESTING IN SEEING WHAT <strong>FLIRT</strong> OR <strong>SKIRT</strong> HAS TO OFFER FOR THIS TREND?
            <i class="fa fa-arrow-right circle-arrow"></i>
        </div>
        <div class="votes hidden-xs col-sm-6 col-md-5 text-center panel">
            <img data-section="flirt" src="/images/icons/flirt.png" class="img-responsive vote-button" style="margin:0 auto">
            <img data-section="skirt" src="/images/icons/skirt.png" class="img-responsive vote-button" style="margin:0 auto">
            <img src="/images/icons/click-here.png" class="img-responsive vote-button" style="margin:0 auto; cursor: default">
        </div>
    </div>
    <div class="row">
        <div class="votes col-xs-12 hidden-sm hidden-md hidden-lg text-center panel">
            <img data-section="flirt" src="/images/icons/flirt.png" class="img-responsive vote-button" style="margin:0 auto">
            <img data-section="skirt" src="/images/icons/skirt.png" class="img-responsive vote-button" style="margin:0 auto">
            <img src="/images/icons/click-here.png" class="img-responsive vote-button" style="margin:0 auto; cursor: default">
        </div>
    </div>
    
    <div class="row header">
       	<h4>(SKIRT)</h4>
        <h2>Move Over <?=$post->title?></h2>
    </div>
<!--
	<div class="row">
    	<div class="col-md-8 col-md-offset-2 text-center serif italic header-text"><?=$data['skirt']['description']?></div>
    </div>
-->
    <div class="row shopping skirt" id="skirtStart">
<?php
	$numItems = count($data['skirt']);
	if ($data['skirt']) foreach ($data['skirt'] as $key => $item) {
?>
    	<div class="col-md-4 col-sm-4 text-center">
        	<div class="col-md-12">
<?php
		if ($key == 0) {
?>
			<a id="most-similar" class="similar" target="_blank" href="<?=$item->details[0]->href?>">
                <img src="/images/icons/right-arch-arrow.png" style="margin-left: 15px;">
                MOST<br>SIMILAR
            </a>
<?php
		}
		else if ($key == ($numItems-1)) {
?>
			<a id="least-similar" class="similar" target="_blank" href="<?=$item->details[0]->href?>">
               <img src="/images/icons/left-arch-arrow.png" style="margin-left: -15px;">
               LEAST<br>SIMILAR
            </a
><?php
		}
?>
	            <a target="_blank" href="<?=$item->details[0]->href?>"><img class="img-responsive" src="<?=$item->img_src?>"></a>
            </div>
            <div class="col-md-12 text-center info">
	            <div class="circle-number hidden-xs"><?=$key+1?></div>
	            <div class="brand-price">
                    <a target="_blank" href="<?=$item->details[0]->href?>"><?=$item->details[0]->name?></a><br>
                    <span class="price">$<?=$item->details[0]->price?></span></div>
                <div class="description"><?=$item->details[0]->description?></div>
            </div>            
        </div>
<?php
		if ( !(($key+1) % 3)) {
?>
	</div>
	<div class="row shopping skirt">      
<?php
		}
	}
?>
	</div>
        
    <div class="row mainTrend skirt">
        <div class="would-you hidden-xs hidden-sm col-md-6 col-md-offset-2 panel">
            <a>WOULD YOU RATHER?</a><br>
            INTERESTING IN SEEING WHAT <strong>FLIRT</strong> OR <strong>MARRY</strong> HAS TO OFFER FOR THIS TREND?
            <i class="fa fa-arrow-right circle-arrow"></i>
        </div>
        <div class="votes hidden-xs col-sm-6 col-md-5 text-center panel">
            <img data-section="flirt" src="/images/icons/flirt.png" class="img-responsive vote-button" style="margin:0 auto">
            <img data-section="marry" src="/images/icons/marry.png" class="img-responsive vote-button" style="margin:0 auto">
            <img src="/images/icons/click-here.png" class="img-responsive vote-button" style="margin:0 auto; cursor: default">
        </div>
    </div>
    <div class="row">
        <div class="votes col-xs-12 hidden-sm hidden-md hidden-lg text-center panel">
            <img id="flirt" src="/images/icons/flirt.png" class="img-responsive vote-button" style="margin:0 auto">
            <img id="marry" src="/images/icons/marry.png" class="img-responsive vote-button" style="margin:0 auto">
            <img src="/images/icons/click-here.png" class="img-responsive vote-button" style="margin:0 auto; cursor: default">
        </div>
    </div>