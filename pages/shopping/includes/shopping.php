<?php
	/**
	 * SHOPPING
	 */
?>
<div class="row">
		<h4>(SHOPPING)</h4>
       	<h2><?=$post->title?></h2>
    </div>
<!--
	<div class="row">
    	<div class="col-md-8 col-md-offset-2 text-center serif italic header-text"><?=$data['marry']['description']?></div>
    </div>
-->
    <div class="row shopping marry">
<?php
	$count = 0;
	if ($post->articles) foreach ($post->articles as $key => $item) {
		if ($item->category == 'blogroll' || $item->category == 'carousel') continue;
	
		if ($count && !($count%3)) {
?>
	</div>
	<div class="row shopping marry">
<?php
		}
		$count++;
?>
    	<div class="col-md-4 col-sm-4 text-center">
        	<div class="col-md-12">
	            <a target="_blank" href="<?=$item->details[0]->href?>"><img class="img-responsive" src="<?=$item->img_src?>"></a>
            </div>
            <div class="col-md-12 text-center">
	            <a target="_blank" href="<?=$item->details[0]->href?>"><?=$item->details[0]->name?></a><br>
                <span class="price">$<?=$item->details[0]->price?></span>
            </div>            
        </div>
<?php
	}
?>
	</div>