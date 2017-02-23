<?php
	use \FSM\Model\blog_post_vote;
	
	$this->title = "View on Map";
	$this->page = 'votes';
	$this->head[] = '<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.14&key=AIzaSyBOJtPmKJGxis_ALq9e3lyvEc9q704dbT4&sensor=false"></script>';
	$this->template('cms','top');
	
	$vote = new blog_post_vote(IDE);
	
?>
	<div class="back"><a href="javascript:history.back()"><img src="/images/icons/go-back.png" width="50"></a></div>
	<input type="hidden" id="lat" value="<?=$vote->lat?>">
    <input type="hidden" id="lng" value="<?=$vote->lng?>">
    <input type="hidden" id="title" value="<?=$vote->title?>">
    <input type="hidden" id="post_ide" value="<?=$vote->ide?>">

	<table class="table-responsive info">
    	<tr>
        	<th width="20%">Title</th>
            <td><?=$vote->title?></td>
        </tr>
        <tr>
        	<th>Location</th>
            <td><?=$vote->location?></td>
        </tr>
        <tr>
        	<th>IP Address</th>
            <td><?=$vote->ip_address?></td>
        </tr>
        <tr>
        	<th>Latitude</th>
            <td><?=$vote->lat?></td>
        </tr>
        <tr>
        	<th>Longitude</th>
            <td><?=$vote->lng?></td>
        </tr>
        <tr>
        	<th>Vote</th>
            <td><?=ucwords($vote->vote)?></td>
        </tr>
        <tr>
        	<th>Date/Time</th>
            <td><?=date(DATE_TIME,strtotime($vote->insert_time))?></td>
        </tr>
    </table>
    
	<div id="mapCanvas"></div>

<?php
	$this->template('cms','bottom');	