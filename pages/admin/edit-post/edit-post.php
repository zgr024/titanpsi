<?php

	use \FSM\Model\blog_post;
	
	$post = new blog_post(IDE);
	if (!$post->ide) redirect ('/admin/new-post');
	
	if (count($post->articles)) foreach ($post->articles as $art) {
		$articles[$art->category][] = $art;
	}
	
	$this->title = "Edit Post - ".$post->title;
	$this->page = 'posts';
	$this->js[] = '/lib/froala/js/froala_editor.min.js';
	$this->js[] = '/lib/froala/js/plugins/tables.min.js';
	$this->js[] = '/lib/froala/js/plugins/block_styles.min.js';
	$this->js[] = '/lib/froala/js/plugins/char_counter.min.js';
	$this->js[] = '/lib/froala/js/plugins/colors.min.js';
	$this->js[] = '/lib/froala/js/plugins/font_family.min.js';
	$this->js[] = '/lib/froala/js/plugins/font_size.min.js';
	$this->js[] = '/lib/froala/js/plugins/fullscreen.min.js';
	$this->js[] = '/lib/froala/js/plugins/inline_styles.min.js';
	$this->js[] = '/lib/froala/js/plugins/lists.min.js';
	$this->js[] = '/lib/froala/js/plugins/media_manager.min.js';
	$this->js[] = '/lib/froala/js/plugins/urls.min.js';
	$this->js[] = '/lib/froala/js/plugins/video.min.js';
	
	$this->css[] = '/lib/froala/css/froala_editor.min.css';
	$this->css[] = '/lib/froala/css/froala_style.min.css';
	$this->css[] = '/lib/froala/css/themes/dark.min.css';
	$this->css[] = '/lib/froala/css/font-awesome.min.css';
	
	$this->template('cms','top');
	if ($_GET['post_debug']) d($post);
?>
	<h1 class="page-header">Edit <span id="post-name">Post - <?=$post->title?></span></h1>
	<ul class="nav nav-tabs">
        <li role="presentation" class="dropdown">
        	<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">Actions <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
	            <li><a id="new-post">New Post</a></li>
            	<li><a class="save">Save</a></li>
                <li><a id="delete">Delete</a></li>
            </ul>
  		</li>
    </ul>
    <input type="hidden" id="blog_post_ide" value="<?=$post->ide?>">
    <div class="saveMessage"></div>
    <section>        
        <form role="form" enctype="multipart/form-data" id="postForm">
	        <input type="hidden" name="test" value="<?=$_GET['test']?>">
            <div class="form-group">
                <label for="post_datetime">Post Date:</label>
                <input type="text" class="form-control datetimepicker" id="post_datetime" name="post_datetime" value="<?=$post->post_datetime?date('m/d/Y h:i a',strtotime($post->post_datetime)):''?>" placeholder="Post Date" />
            </div>
            <div class="form-group">
                <label for="other_category_name">Category:</label>
                <input type="hidden" name="category" value="<?=$post->category?>">
                <div><?=ucwords($post->category)?></div>
            </div>
<?php
	if ($post->category	== 'other') {
?>
		    <div class="form-group">
                <label for="other_category_name">Category Name:</label>
                <input type="text" class="form-control" id="other_category_name" name="other_category_name" value="<?=$post->other_category_name?>" placeholder="Name of Category">
            </div>
<?php
	}
	if (in_array($post->category,['other','shopping'])) {
?>
			<div class="form-group">
	            <label for="status">Featured:</label>
            	<div class="onoffswitch">
                    <input type="checkbox" name="featured" value="1" <?=$post->featured?'checked':''?> class="onoffswitch-checkbox" id="myonoffswitch">
                    <label class="onoffswitch-label" for="myonoffswitch">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
<?php
	}
?>
            <div class="form-group">
	            <label for="status">Status:</label>
                <select class="form-control" name="status" id="status">
                    <option value="0">DRAFT</option>
                    <option value="1" <?=$post->status==1?'selected':''?>>PUBLISHED</option>
                    <option value="2" <?=$post->status==2?'selected':''?>>ARCHIVED</option>
                    <option value="3" <?=$post->status==3?'selected':''?>>DELETED</option>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Title:</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Title of Post" value="<?=$post->title?>">
            </div>
            <div class="form-group">
                <label for="slug">Slug:</label>
                <input type="text" class="form-control" id="slug" name="slug" placeholder="Ex: name-of-post" value="<?=$post->slug?>">
            </div>
            
<?php
	if (in_array($post->category,['other','shopping'])) {
?>
			<div class="form-group">
	            <label for="meta_keywords">Meta Keywords:</label>
                <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Meta Keywords" value="<?=$post->meta_keywords?>">
            </div>
<?php
	}
	if ($post->category == 'fashion trend') {
?>
            <div class="form-group">
                <label for="tagline">Tagline:</label>
                <input type="text" class="form-control" id="tagline" name="tagline" placeholder="Tagline (overlay)" value="<?=$post->tagline?>">
            </div>
            <div class="form-group fashion-trend tempHide">
                <label for="description">Description: (shows on style-tips)</label>
                <textarea class="form-control" id="description" name="description" placeholder="Post Description" value="<?=$post->description?>"></textarea>
            </div>

<?php
	}
	else {
?>
            <div class="form-group">
                <label for="preview">Post Preview (shows on blogroll):</label>
                <textarea class="form-control froala2" id="preview" name="preview" placeholder="Post Preview"><?=$post->preview?></textarea>
            </div>
<?php
	}
	if (in_array($post->category,array('fashion trend','other','have to have it'))) {
?>
            <div class="form-group">
                <label for="body" class="body-name">Post Body:</label>
                <textarea class="form-control froala" id="body" name="body" placeholder="Post Body"><?=$post->body?></textarea>
            </div>
<?php
	}
?>
			<div class="form-group"  data-section="carousel">
            	<label for="carousel" class="bigLabel">Carousel Image (597 x 395)</label>
                <div class="uploaderContainer">
<?php
				if ($articles['carousel'][0]->img_src) {
?>
                    <input type="hidden" name="carousel_ide" value="<?=$articles['carousel'][0]->ide?>">
                    <div id="carouselContainer" class="imageContainer"><img src="<?=$articles['carousel'][0]->img_src?>" class="img-responsive"></div>
                    <div class="inputContainer"></div>
                    <a class="change-image" data-type="carousel">change image</a>
<?php
				}
				else {
?>
                    <div id="blogrollContainer" class="imageContainer"></div>
                    <div class="inputContainer"></div>
                    <input type="file" id="carousel" name="carousel">
<?php
				}
?>
				</div>
           	</div>
<?php
	if (in_array($post->category,array('shopping','other','have to have it'))) {
?>
			<div class="form-group"  data-section="blogroll">
            	<label for="blogroll" class="bigLabel">Blog Roll Image (627 x 414)</label>
                <div class="uploaderContainer">
<?php
				if ($articles['blogroll'][0]->img_src) {
?>
                    <input type="hidden" name="blogroll_ide" value="<?=$articles['blogroll'][0]->ide?>">
                    <div id="blogrollContainer" class="imageContainer"><img src="<?=$articles['blogroll'][0]->img_src?>" class="img-responsive"></div>
                    <div class="inputContainer"></div>
                    <a class="change-image" data-type="blogroll">change image</a>
<?php
				}
				else {
?>
                    <div id="blogrollContainer" class="imageContainer"></div>
                    <div class="inputContainer"></div>
                    <input type="file" id="blogroll" name="blogroll">
<?php
				}
?>
				</div>
           	</div>
<?php
	}
	if ($post->category == 'fashion trend') {
?>            
            <div class="form-group">
	            <label for="meta_keywords">Style Tips Keywords (meta):</label>
                <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Style Tips Keywords" value="<?=$post->meta_keywords?>">
            </div>
            <div class="form-group fashion-trend tempHide">
                <label for="meta_description">Style Tips Description (meta):</label>
                <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Meta Description"  value="<?=$post->meta_description?>">
            </div>
            <div class="form-group" data-section="style">
            	<label class="bigLabel">Style Tips Items (400 x 400)</label>
            	<div class="row">
<?php
			$styleCount = 0;
			if ($articles['style']) {
				foreach($articles['style'] as $key => $art) {
					$dets = array();
					foreach ($art->details as $num => $det) {
						$dets[$det->category][] = $det;
					}
?>
                    <div class="uploaderContainer col-md-3 text-center">
                        <div class="imageContainer styleContainer" data-length="<?=$key+1?>"><img src="<?=$art->img_src?>" width="400" class="img-responsive">
                            <a class="remove" data-ide="<?=$art->ide?>">remove style tip</a>
                            <div class="clear"></div>
                            <input type="hidden" name="style_ide[<?=$key+1?>]" value="<?=$art->ide?>">
                            <input class="form-control styleName" name="style[<?=$key+1?>][style_name]" placeholder="Style Name" value="<?=$dets['main_style'][0]->name?>">
                            <textarea class="form-control styleDesc" name="style[<?=$key+1?>][style_description]" placeholder="Style Description"><?=$dets['main_style'][0]->description?></textarea>
<?php
						if ($dets['style_product']) {
							$productCount = count($dets['style_product']);
							foreach ($dets['style_product'] as $num => $det) {
?>
		                        <input type="hidden" name="style[<?=$key+1?>][detail_ide][<?=$num?>]" value="<?=$det->ide?>">
								<input class="form-control shoppingName" name="style[<?=$key+1?>][name][<?=$num?>]" placeholder="Product Name" value="<?=$det->name?>">
								<input class="form-control shoppingPrice" name="style[<?=$key+1?>][price][<?=$num?>]" placeholder="Price" type="number" value="<?=$det->price?>">
								<input class="form-control shoppingLink" name="style[<?=$key+1?>][description][<?=$num?>]" placeholder="Product Description" value="<?=$det->description?>">
								<input class="form-control shoppingLink" name="style[<?=$key+1?>][href][<?=$num?>]" placeholder="Link" value="<?=$det->href?>">
								<input class="form-control shoppingLink" name="style[<?=$key+1?>][href_display][<?=$num?>]" placeholder="Link Display" value="<?=$det->href_display?>">
								<a class="addItem">+</a><? if ($num != 0) {?> <a class="removeItem" data-ide="<?=$det->ide?>">-</a><? } ?>
<?php
								if ($num < $productCount - 1) {
?>
									<div class="clear"></div>
                                	<hr>
<?php
								}
							}
						}
						else {
?>
							<input class="form-control shoppingName" name="style[<?=$key+1?>][name][<?=$num?>]" placeholder="Product Name">
                            <input class="form-control shoppingPrice" name="style[<?=$key+1?>][price][<?=$num?>]" placeholder="Price" type="number">
                            <input class="form-control shoppingLink" name="style[<?=$key+1?>][description][<?=$num?>]" placeholder="Product Description">
                            <input class="form-control shoppingLink" name="style[<?=$key+1?>][href][<?=$num?>]" placeholder="Link">
                            <input class="form-control shoppingLink" name="style[<?=$key+1?>][href_display][<?=$num?>]" placeholder="Link Display">
							<a class="addItem">+</a>
<?php
						}
?>
						</div>
                    </div>
<?php
				}
				for ($x = 3; $x > $key; $x--) {
?>
					<div class="uploaderContainer col-md-3 text-center">
                        <div class="imageContainer styleContainer"></div>
                        <input type="file" name="style[<?=$x?>]" class="styleUpload" >
                	</div>
<?php
				}
			}
			else {
?>
					<div class="uploaderContainer col-md-3 text-center">
                        <div class="imageContainer styleContainer"></div>
                        <input type="file" name="style[]">
                	</div>
<?php
			}
?>
				</div>
           	</div>
            <div class="form-group">
	            <label for="shopping_keywords">Shopping Keywords (meta):</label>
                <input type="text" class="form-control" id="shopping_keywords" name="shopping_keywords" placeholder="Shopping Keywords" value="<?=$post->shopping_keywords?>">
            </div>
            <div class="form-group fashion-trend tempHide">
                <label for="shopping_description">Shopping Description (meta):</label>
                <input type="text" class="form-control" id="shopping_description" name="shopping_description" placeholder="Shopping Description" value="<?=$post->shopping_description?>">
            </div>
            <div class="clear"></div>
            <div class="form-group" data-section="marry">
            	<label class="bigLabel">Marry Items (150 x 150)</label>
                <div class="row">
<?php
			if ($articles['marry']) {
				foreach ($articles['marry'] as $key => $art) {
?>
                    <div class="uploaderContainer col-md-4 text-center">
                        <div class="imageContainer marryContainer"><img src="<?=$art->img_src?>" width="150" class="img-responsive auto-margin"></div>
						<a class="remove" data-ide="<?=$art->ide?>">remove item</a>
                        <div class="clear"></div>
                        <input type="hidden" name="marry_ide[<?=$key?>]" value="<?=$art->ide?>">
                        <input class="form-control shoppingName" name="marry_name[<?=$key?>]" placeholder="Name" value="<?=$art->details[0]->name?>">
                        <input class="form-control shoppingPrice" name="marry_price[<?=$key?>]" placeholder="Price" type="number" value="<?=$art->details[0]->price?>">
                        <input class="form-control shoppingLink" name="marry_href[<?=$key?>]" placeholder="Link" value="<?=$art->details[0]->href?>">
                    </div>
<?php
                    if (($key+1) % 3 == 0) echo '</div><div class="row">';
				}
			}
			if ($key < 29) {
?>
					<div class="uploaderContainer col-md-4 text-center">
                        <div class="imageContainer marryContainer"></div>
                        <input type="file" name="marry[]">
                    </div>
<?php
			}
?>
                </div>
           	</div>
            <div class="form-group" data-section="skirt">
            	<label class="bigLabel">Skirt Items (150 x 150)</label>
            	<div class="row">
<?php
			if ($articles['skirt']) {
				foreach ($articles['skirt'] as $key => $art) {
?>
                    <div class="uploaderContainer col-md-4 text-center">
                        <div class="imageContainer skirtContainer"><img src="<?=$art->img_src?>" width="150" class="img-responsive auto-margin"></div>
                        <a class="remove" data-ide="<?=$art->ide?>">remove item</a>
                        <div class="clear"></div>
                        <input type="hidden" name="skirt_ide[<?=$key?>]" value="<?=$art->ide?>">
                        <input class="form-control shoppingName" name="skirt_name[<?=$key?>]" placeholder="Name" value="<?=$art->details[0]->name?>">
                        <input class="form-control shoppingPrice" name="skirt_price[<?=$key?>]" placeholder="Price" type="number" value="<?=$art->details[0]->price?>">
                        <textarea class="form-control shoppingDesc" name="skirt_description[<?=$key?>]" placeholder="Description"><?=$art->details[0]->description?></textarea>
                        <input class="form-control shoppingLink" name="skirt_href[<?=$key?>]" placeholder="Link" value="<?=$art->details[0]->href?>">
                    </div>
<?php
                    if (($key+1) % 3 == 0) echo '</div><div class="row">';
				}
			}
			if ($key < 29) {
?>
					<div class="uploaderContainer col-md-4 text-center">
                        <div class="imageContainer skirtContainer"></div>
                        <input type="file" name="skirt[]">
                    </div>
<?php
			}
?>
                </div>
           	</div>
			<input type="hidden" name="final_forecast_ide" value="<?=$articles['final_forecast'][0]->details[0]->ide?>">
            <div class="form-group">
	            <label for="final_keywords">Final Forecast Keywords (meta):</label>
                <input type="text" class="form-control" id="final_keywords" name="final_keywords" placeholder="Final Forecast Keywords" value="<?=$post->final_keywords?>">
            </div>
            <div class="form-group fashion-trend tempHide">
                <label for="final_description">Final Forecast Description (meta):</label>
                <input type="text" class="form-control" id="final_description" name="final_description" placeholder="Final Forecast Description" value="<?=$post->final_description?>">
            </div>
            <div class="form-group">
            	<label for="final_title" class="bigLabel">Final Forecast Title</label>
                <input type="text" class="form-control" id="final_title" name="final_title" placeholder="Final Forecast Title" value="<?=$articles['final_forecast'][0]->details[0]->name?>">
            </div>
            <div class="form-group">
            	<label for="final_description">Final Forecast Description</label>
                <input type="text" class="form-control" id="final_description" name="final_description" placeholder="Final Forecast Header Description" value="<?=$articles['final_forecast'][0]->details[0]->description?>">
            </div>
            <div class="form-group">
            	<label># of Votes</label>
<?php
	//d($post->total_votes);
	$votes = array();
	foreach($post->total_votes as $vote) {
		$votes[$vote->type]['ide'] = $vote->ide;
		$votes[$vote->type]['west'] = $vote->west;
		$votes[$vote->type]['southwest'] = $vote->southwest;
		$votes[$vote->type]['midwest'] = $vote->midwest;
		$votes[$vote->type]['northeast'] = $vote->northeast;
		$votes[$vote->type]['southeast'] = $vote->southeast;
	}
?>
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <label for="final_flirt">Flirt</label>
                        <input type="hidden" name="final_flirt[ide]" value="<?=$votes['flirt']['ide']?>">
                        <input type="number" min="0" class="form-control vote-input" name="final_flirt[west]" placeholder="W" value="<?=$votes['flirt']['west']?>">
                        <input type="number" min="0" class="form-control vote-input" name="final_flirt[southwest]" placeholder="SW" value="<?=$votes['flirt']['southwest']?>">
                        <input type="number" min="0" class="form-control vote-input" name="final_flirt[midwest]" placeholder="MW" value="<?=$votes['flirt']['midwest']?>">
                        <input type="number" min="0" class="form-control vote-input" name="final_flirt[northeast]" placeholder="NE" value="<?=$votes['flirt']['northeast']?>">
                        <input type="number" min="0" class="form-control vote-input" name="final_flirt[southeast]" placeholder="SE" value="<?=$votes['flirt']['southeast']?>">
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <label for="final_flirt">Skirt</label>
                        <input type="hidden" name="final_skirt[ide]" value="<?=$votes['skirt']['ide']?>">
                        <input type="number" min="0" class="form-control vote-input" name="final_skirt[west]" placeholder="W" value="<?=$votes['skirt']['west']?>">
                        <input type="number" min="0" class="form-control vote-input" name="final_skirt[southwest]" placeholder="SW" value="<?=$votes['skirt']['southwest']?>">
                        <input type="number" min="0" class="form-control vote-input" name="final_skirt[midwest]" placeholder="MW" value="<?=$votes['skirt']['midwest']?>">
                        <input type="number" min="0" class="form-control vote-input" name="final_skirt[northeast]" placeholder="NE" value="<?=$votes['skirt']['northeast']?>">
                        <input type="number" min="0" class="form-control vote-input" name="final_skirt[southeast]" placeholder="SE" value="<?=$votes['skirt']['southeast']?>">
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <label for="final_flirt">Marry</label>
                        <input type="hidden" name="final_marry[ide]" value="<?=$votes['marry']['ide']?>">
                        <input type="number" min="0" class="form-control vote-input" name="final_marry[west]" placeholder="W" value="<?=$votes['marry']['west']?>">
                        <input type="number" min="0" class="form-control vote-input" name="final_marry[southwest]" placeholder="SW" value="<?=$votes['marry']['southwest']?>">
                        <input type="number" min="0" class="form-control vote-input" name="final_marry[midwest]" placeholder="MW" value="<?=$votes['marry']['midwest']?>">
                        <input type="number" min="0" class="form-control vote-input" name="final_marry[northeast]" placeholder="NE" value="<?=$votes['marry']['northeast']?>">
                        <input type="number" min="0" class="form-control vote-input" name="final_marry[southeast]" placeholder="SE" value="<?=$votes['marry']['southeast']?>">
                    </div>
            	</div>
            </div>
<?php
	}
	
	else if ($post->category == 'shopping') {
?>
               
            <div class="form-group" data-section="marry">
            	<label class="bigLabel">Shopping Items (150 x 150)</label>
                <div class="row">
<?php
			if ($articles['shopping']) {
				foreach ($articles['shopping'] as $key => $art) {
?>
                    <div class="uploaderContainer col-md-4 text-center">
                        <div class="imageContainer shoppingContainer"><img src="<?=$art->img_src?>" width="150" class="img-responsive auto-margin"></div>
						<a class="remove" data-ide="<?=$art->ide?>">remove item</a>
                        <div class="clear"></div>
                        <input type="hidden" name="shopping_ide[<?=$key?>]" value="<?=$art->ide?>">
                        <input class="form-control shoppingName" name="shopping_name[<?=$key?>]" placeholder="Name" value="<?=$art->details[0]->name?>">
                        <input class="form-control shoppingPrice" name="shopping_price[<?=$key?>]" placeholder="Price" type="number" value="<?=$art->details[0]->price?>">
                        <input class="form-control shoppingLink" name="shopping_href[<?=$key?>]" placeholder="Link" value="<?=$art->details[0]->href?>">
                    </div>
<?php
				}
				if ($x < 15) {
?>
					<div class="uploaderContainer col-md-4 text-center">
                        <div class="imageContainershoppingContainer"></div>
                        <input type="file" name="shopping[]">
                    </div>
<?php
				}
			}
			else {
?>
					<div class="uploaderContainer col-md-4 text-center">
                        <div class="imageContainer shoppingContainer"></div>
                        <input type="file" name="shopping[]">
                    </div>
<?php
			}
?>
                </div>
           	</div>
<?php
	}
	
	else if ($post->category == 'have to have it') {
		$have_to = $articles['main'][0];
		$have_to_details = $have_to->details[0];
		$blogroll = $articles['blogroll'][0];
		$sidebar = $articles['sidebar'][0];
		$sidebar_details = $sidebar->details[0];
		
		if ($have_to->ide) {
?>
            <div class="form-group" data-section="haveto">
            	<label for="have_to" class="bigLabel">Have To Have It Image (600 x 430) or (600 x 840)</label>
                <input type="hidden" name="have_to_ide" value="<?=$have_to->ide?>">         	
                <div class="row">
                    <div class="uploaderContainer col-md-12">
                        <div class="imageContainer" id="haveContainer">
                            <div class="leftBubble" style="top: <?=$have_to_details->ht_left_bubble_top?>%"><span><?=$have_to_details->ht_left_bubble?></span></div>
                            <img src="<?=$have_to->img_src?>" width="600" class="img-responsive">
                            <div class="rightBubble" style="top: <?=$have_to_details->ht_right_bubble_top?>%"><span><?=$have_to_details->ht_right_bubble?></span></div>
                        </div>
                        <div class="inputContainer">
                            <input class="form-control bubbleInput" maxlength="110" name="left_bubble" id="left_bubble" placeholder="Left Bubble Text" value="<?=$have_to_details->ht_left_bubble?>">
                            <input type="number" class="form-control percent" id="left_top" name="left_top" min="1" max="99" placeholder="Left Top %" value="<?=$have_to_details->ht_left_bubble_top?>"> % from top
                            <input class="form-control bubbleInput" maxlength="110" name="right_bubble" id="right_bubble" placeholder="Right Bubble Text" value="<?=$have_to_details->ht_right_bubble?>">
                            <input type="number" class="form-control percent" id="right_top" name="right_top" min="1" max="99" placeholder="Right Top %" value="<?=$have_to_details->ht_right_bubble_top?>"> % from top
                            <input class="form-control product" id="product" name="product" placeholder="Product" value="<?=$have_to_details->description?>">$<input class="form-control price" id="price" name="price" placeholder="price" value="<?=$have_to_details->price?>">
                            <input class="form-control link" id="href" name="href" placeholder="Link" value="<?=$have_to_details->href?>">
                            <input class="form-control link_disp" id="href_display" name="href_display" placeholder="Link Display" value="<?=$have_to_details->href_display?>">
                        	<a class="change-image" data-type="have_to">change image</a>
                        </div>
                    </div>
                </div> 
           	</div>
<?php
		}		
		else {
?>
			<div class="form-group" data-section="haveto">
            	<label for="have_to" class="bigLabel">Have To Have It Image (600 x 430) or (600 x 840)</label>   	
                <div class="row">
                    <div class="uploaderContainer col-md-12">
                        <div class="imageContainer" id="haveContainer"></div>
                        <div class="inputContainer"></div>
                        <input type="file" name="have_to">
                    </div>
                </div>
           	</div>
<?php
		}
		if ($sidebar->ide) {
?>
			<div class="form-group" data-section="haveto-sidebar">
            	<label for="sidebar" class="bigLabel">Sidebar Image</label>	
                <input type="hidden" name="sidebar_ide" value="<?=$sidebar->ide?>">
                <div class="row">
                    <div class="uploaderContainer col-md-12">
                        <div class="imageContainer" id="haveContainer"><img class="img-responsive" width="150" src="<?=$articles['sidebar'][0]->img_src?>"></div>
                        <div class="inputContainer">
                        	<input class="form-control haveToHeader" id="sidebar_title" name="sidebar_title" placeholder="Header" value="<?=$sidebar_details->name?>">
                            <textarea class="form-control froala" id="sidebar_text" name="sidebar_text" placeholder="Description"><?=$sidebar_details->description?></textarea>
                        </div>
                        <a class="change-image" data-type="sidebar">change image</a>
                    </div>
                </div>
			</div>
<?php
		}
		else {
?>            
			<div class="form-group" data-section="haveto-sidebar">
            	<label for="sidebar" class="bigLabel">Sidebar Image</label>	
                <div class="row">
                    <div class="uploaderContainer col-md-12">
                        <div class="imageContainer" id="haveContainer"></div>
                        <div class="inputContainer"></div>
                        <input type="file" id="sidebar" name="sidebar">
                    </div>
                </div>
           	</div>
<?php
		}
	}
	if ($_GET['article_debug']) d($articles);
?>
            <div class="clear"></div>
            <div class="bigLabel">&nbsp;</div>
            <button type="submit" class="btn btn-default save">Save</button>
            <div class="saveMessage"></div>
        </form>
    </section>    
<?php
	$this->template('cms','bottom');