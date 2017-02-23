<?php
	$this->title = "New Post";
	$this->page = 'new-post';
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
?>
	<h1 class="page-header">New <span id="post-name">Post</span></h1>
	<ul class="nav nav-tabs">
        <li role="presentation" class="dropdown">
        	<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">Actions <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
	            <li><a id="new-post">New Post</a></li>
            	<li><a class="save">Save</a></li>
            </ul>
  		</li>
    </ul>
    <input type="hidden" id="blog_post_ide" value="">
    <section>
        <form role="form" enctype="multipart/form-data" id="postForm">
            <div class="form-group">
                <label for="post_datetime">Post Date/Time:</label>
                <input type="text" class="form-control datetimepicker" id="post_date" name="post_datetime" value="<?=date('m/d/Y h:i a')?>" placeholder="Post Date" />
            </div>
	        <div class="form-group">
                <label for="category">Category:</label>
                <select class="form-control" name="category" id="category">
                    <option value="">- Select Category -</option>
                    <option value="Fashion Trend">FASHION TREND</option>
                    <option value="Have to Have It">HAVE TO HAVE IT</option>
                    <option value="Shopping">SHOPPING</option>
                    <option value="other">OTHER</option>
                </select>
            </div>
            <div class="form-group other tempHide">
                <label for="other_category_name">Category Name:</label>
                <input type="text" class="form-control" id="other_category_name" name="other_category_name" placeholder="Name of Category">
            </div>
            <div class="form-group fashion-trend shopping have-to-have-it other tempHide">
	            <label for="status">Status:</label>
                <select class="form-control" name="status" id="status">
                    <option value="0">DRAFT</option>
                    <option value="1">PUBLISH</option>
                    <option value="2">ARCHIVE</option>
                </select>
            </div>            
            <div class="form-group fashion-trend shopping have-to-have-it other tempHide">
                <label for="name">Title:</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Title of Post">
            </div>
            <div class="form-group fashion-trend shopping have-to-have-it other tempHide">
                <label for="slug">Slug:</label>
                <input type="text" class="form-control" id="slug" name="slug" placeholder="Ex: name-of-post">
            </div>
            <div class="form-group have-to-have-it other tempHide">
                <label for="meta_keywords">Meta Keywords:</label>
                <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Meta Keywords">
            </div>
            <div class="form-group have-to-have-it other tempHide">
                <label for="meta_description">Meta Description:</label>
                <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Meta Description">
            </div>
            <div class="form-group shopping tempHide">
                <label for="shopping_keywords">Meta Keywords:</label>
                <input type="text" class="form-control" id="shopping_keywords" name="shopping_keywords" placeholder="Meta Keywords">
            </div>
            <div class="form-group shopping tempHide">
                <label for="shopping_description">Meta Description:</label>
                <input type="text" class="form-control" id="shopping_description" name="shopping_description" placeholder="Meta Description">
            </div>
            <div class="form-group fashion-trend tempHide">
                <label for="tagline">Tagline:</label>
                <input type="text" class="form-control" id="tagline" name="tagline" placeholder="Tagline (overlay)">
            </div>
            <div class="form-group fashion-trend tempHide">
                <label for="description">Description: (shows on style-tips)</label>
                <textarea class="form-control" id="description" name="description" placeholder="Post Description"></textarea>
            </div>
            <div class="form-group shopping have-to-have-it other tempHide">
                <label for="preview">Post Preview: (shows on blogroll)</label>
                <textarea class="form-control froala2" id="preview" name="preview" placeholder="Post Preview"></textarea>
            </div>
            <div class="form-group fashion-trend have-to-have-it other tempHide">
                <label for="body" class="body-name">Post Body:</label>
                <textarea class="form-control froala" id="body" name="body" placeholder="Post Body"></textarea>
            </div>
            <div class="form-group fashion-trend shopping have-to-have-it other tempHide">
            	<label for="carousel" class="bigLabel">Carousel Image (597 x 395)</label>
                <div class="uploaderContainer">
                    <div id="carouselContainer" class="imageContainer"></div>
                    <input type="file" name="carousel" id="carousel">
                </div>
           	</div>
            <div class="form-group shopping other have-to-have-it tempHide">
            	<label for="blogroll" class="bigLabel">Blog Roll Image (200 x 275)</label>
                <div id="blogrollContainer" class="imageContainer"></div>
            	<input type="file" name="blogroll" id="blogroll">
           	</div>
            <label class="bigLabel fashion-trend tempHide">Style Tips</label><br>
            <div class="form-group fashion-trend tempHide">
                <label for="meta_keywords">Keywords (meta):</label>
                <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Meta Keywords">
            </div>
            <div class="form-group fashion-trend tempHide">
                <label for="meta_description">Description (meta):</label>
                <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Meta Description">
            </div>
            <div class="form-group fashion-trend tempHide" data-section="style">
            	<label>Style Items (400 x 400)</label>
            	<div class="row">
                    <div class="uploaderContainer col-md-3 text-center">
                        <div class="imageContainer styleContainer"></div>
                        <input type="file" name="style[]">
                    </div>
                </div>
           	</div>
            <label class="bigLabel fashion-trend tempHide">Shopping</label><br>
            <div class="form-group fashion-trend tempHide">
                <label for="shopping_keywords">Keywords (meta):</label>
                <input type="text" class="form-control" id="shopping_keywords" name="shopping_keywords" placeholder="Shopping Keywords">
            </div>
            <div class="form-group fashion-trend tempHide">
                <label for="shopping_description">Description (meta):</label>
                <input type="text" class="form-control" id="shopping_description" name="shopping_description" placeholder="Shopping Description">
            </div>
            <div class="form-group fashion-trend tempHide" data-section="marry">
            	<label class="bigLabel">Marry Items (150 x 150)</label>
                <div class="row">
                    <div class="uploaderContainer col-md-4 text-center">
                        <div class="imageContainer marryContainer"></div>
                        <input type="file" name="marry[]">
                    </div>
                </div>
           	</div>
            <div class="form-group fashion-trend tempHide" data-section="skirt">
            	<label class="bigLabel">Skirt Items (150 x 150)</label>
            	<div class="row">
                    <div class="uploaderContainer col-md-4 text-center">
                        <div class="imageContainer skirtContainer"></div>
                        <input type="file" name="skirt[]">
                    </div>
                </div>
           	</div>
            <div class="form-group shopping tempHide" data-section="shopping">
            	<label class="bigLabel">Shopping Items (150 x 150)</label>
            	<div class="row">
                    <div class="uploaderContainer col-md-4 text-center">
                        <div class="imageContainer shoppingContainer"></div>
                        <input type="file" name="shopping[]">
                    </div>
                </div>
           	</div>
            
            <div class="form-group have-to-have-it tempHide" data-section="haveto-sidebar">
            	<label for="sidebar" class="bigLabel">Sidebar Image</label>	
                <div class="row">
                    <div class="uploaderContainer col-md-12">
                        <div class="imageContainer" id="haveContainer"></div>
                        <div class="inputContainer"></div>
                        <input type="file" id="sidebar" name="sidebar">
                    </div>
                </div>
           	</div>            
            <div class="form-group have-to-have-it tempHide" data-section="haveto">
            	<label for="have_to" class="bigLabel">Have To Have It Image (600 x 430) or (600 x 840)</label>
                <input type="hidden" name="orientation" id="orientation" value="">            	
                <div class="row">
                    <div class="uploaderContainer col-md-12">
                        <div class="imageContainer" id="haveContainer"></div>
                        <div class="inputContainer"></div>
                        <input type="file" id="have_to" name="have_to">
                    </div>
                </div>
           	</div>
            <label class="bigLabel fashion-trend tempHide">Final Forecast</label><br>
            <div class="form-group fashion-trend tempHide">
                <label for="final_keywords">Keywords (meta):</label>
                <input type="text" class="form-control" id="final_keywords" name="final_keywords" placeholder="Final Forecast Keywords">
            </div>
            <div class="form-group fashion-trend tempHide">
                <label for="final_description">Description (meta):</label>
                <input type="text" class="form-control" id="final_description" name="final_description" placeholder="Final Forecast Description">
            </div>
            <div class="form-group fashion-trend tempHide">
            	<label for="final_title">Page Header</label>
                <input type="text" class="form-control" id="final_title" name="final_title"  placeholder="Final Forecast Header">
            </div>          
            <div class="form-group fashion-trend tempHide">
            	<label for="final_description">Header Description</label>
                <input type="text" class="form-control" id="final_description" name="final_description"  placeholder="Final Forecast Header Description">
            </div>
            <div class="form-group fashion-trend tempHide">
            	<label># of Votes</label>
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <label for="final_flirt">Flirt</label>
                        <input type="number" min="0" class="form-control vote-input" name="final_flirt[west]" placeholder="W">
                        <input type="number" min="0" class="form-control vote-input" name="final_flirt[southwest]" placeholder="SW">
                        <input type="number" min="0" class="form-control vote-input" name="final_flirt[midwest]" placeholder="MW">
                        <input type="number" min="0" class="form-control vote-input" name="final_flirt[northeast]" placeholder="NE">
                        <input type="number" min="0" class="form-control vote-input" name="final_flirt[southeast]" placeholder="SE">
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <label for="final_flirt">Skirt</label>
                        <input type="number" min="0" class="form-control vote-input" name="final_skirt[west]" placeholder="W">
                        <input type="number" min="0" class="form-control vote-input" name="final_skirt[southwest]" placeholder="SW">
                        <input type="number" min="0" class="form-control vote-input" name="final_skirt[midwest]" placeholder="MW">
                        <input type="number" min="0" class="form-control vote-input" name="final_skirt[northeast]" placeholder="NE">
                        <input type="number" min="0" class="form-control vote-input" name="final_skirt[southeast]" placeholder="SE">
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <label for="final_flirt">Marry</label>
                        <input type="number" min="0" class="form-control vote-input" name="final_marry[west]" placeholder="W">
                        <input type="number" min="0" class="form-control vote-input" name="final_marry[southwest]" placeholder="SW">
                        <input type="number" min="0" class="form-control vote-input" name="final_marry[midwest]" placeholder="MW">
                        <input type="number" min="0" class="form-control vote-input" name="final_marry[northeast]" placeholder="NE">
                        <input type="number" min="0" class="form-control vote-input" name="final_marry[southeast]" placeholder="SE">
                    </div>
            	</div>
            </div>
            
            <label class="bigLabel">&nbsp;</label>
            <button type="submit" class="btn btn-default save">Submit</button>
            <div class="saveMessage"></div>
        </form>
    </section>    
<?php
	$this->template('cms','bottom');