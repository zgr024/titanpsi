<?php
	//use \FSM\Model\analytics;
	$this->title = "Analytics";
	$this->page = 'analytics';
	$this->template('cms','top');
?>	
	<h1 class="page-header">Analytics</h1>
    <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th><a href="?<?=$sortQ!=''?$sortQ."&":''?>s=name&sd=<?=($_GET['s']=='name' && $_GET['sd']=='asc')?'desc':'asc'?>">Name<?=$arrow['name']?></a></th>
          <th><a href="?<?=$sortQ!=''?$sortQ."&":''?>s=email&sd=<?=($_GET['s']=='email' && $_GET['sd']=='asc')?'desc':'asc'?>">Email<?=$arrow['email']?></a></th>
          <th><a href="?<?=$sortQ!=''?$sortQ."&":''?>s=subject&sd=<?=($_GET['s']=='subject' && $_GET['sd']=='asc')?'desc':'asc'?>">Subject<?=$arrow['subject']?></a></th>
          <th><a href="?<?=$sortQ!=''?$sortQ."&":''?>s=message&sd=<?=($_GET['s']=='message' && $_GET['sd']=='asc')?'desc':'asc'?>">Message<?=$arrow['message']?></a></th>
          <th><a href="?<?=$sortQ!=''?$sortQ."&":''?>s=insert_time&sd=<?=($_GET['s']=='insert_time' && $_GET['sd']=='asc')?'desc':'asc'?>">Date / Time<?=$arrow['insert_time']?></a></th>
        </tr>
      </thead>
      <tbody>
<?php
/*	foreach($messages as $rec) {
?>
		<tr>
		  <td><?=$rec->name?></td>
		  <td><a href="mailto:<?=$rec->email?>"><?=$rec->email?></a></td>
		  <td><?=$rec->subject?></td>
		  <td><?=$rec->message?></td>
		  <td><?=date(DATE_TIME,strtotime($rec->insert_time))?></td>
		</tr>
<?php
	}
	*/
?>
          </tbody>
        </table>
      </div>
<?php
	$this->template('cms','bottom');