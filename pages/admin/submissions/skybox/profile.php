<?php
	use \FSM\Model\incoming;
	
	$submission = new incoming(IDE);
	$submission->update([
		'status'	=> 1
	]);
	
?>
	<div id="infowindow">
        <table class="table-responsive" width="100%">
            <tr>
                <th width="160">Name</th>
                <td width="180"><?=$submission->name?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?=$submission->email?></td>
            </tr>
            <tr>
                <th>Subject</th>
                <td><?=$submission->subject?></td>
            </tr>
            <tr>
                <th>Message</th>
                <td><?=$submission->message?></td>
            </tr>
            <tr>
                <th>Date/Time</th>
                <td><?=date(DATE_TIME,strtotime($submission->insert_time))?></td>
            </tr>
        </table>
	</div>