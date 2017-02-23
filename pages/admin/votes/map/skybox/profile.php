<?php
	use \FSM\Model\blog_post_vote;
	
	$vote = new blog_post_vote(IDE);
	
?>
	<div id="infowindow">
        <table class="table-responsive" width="100%">
            <tr>
                <th width="160">Title</th>
                <td width="180"><?=$vote->title?></td>
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
	</div>