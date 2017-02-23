<?php
	use \FSM\Model\blog_post_vote;
	
	$this->title = "Fashion Trend Votes";
	$this->page = 'votes';
	$this->head[] = '<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.14&key=AIzaSyBOJtPmKJGxis_ALq9e3lyvEc9q704dbT4&sensor=false"></script>';
	$this->template('cms','top');
	
?>

	<h1 class="page-header"><?=$this->title?></h1>
    
    <ul class="nav nav-tabs">
        <li role="presentation"><a href="/admin/votes">List View</a></li>
        <li role="presentation" class="active"><a href="/admin/votes/map">Map View</a></li>
    </ul>
    
	<input type="hidden" id="lat" value="38.8833">
    <input type="hidden" id="lng" value="-85.0167">
    
    <div id="mapCanvas"></div>
	
<?php
	$this->template('cms','bottom');