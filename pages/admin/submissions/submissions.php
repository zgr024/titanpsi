<?php
	use \FSM\Model\incoming;
	$this->title = "Contact Form Submissions";
	$this->page = 'submissions';
	$this->template('cms','top');
	
	$limit = 25;
	$rs = sql_array("SELECT count(id) as count FROM incoming");
	$count = $rs[0]['count'];
	
	$where = [];
	if (is_numeric($_GET['status'])) $where[] = "status = {$_GET['status']}";
	
	$qs = [];
    $sortQ = [];
    foreach ($_GET as $q => $v) {
        if ($q != 'pg') {
            if ($q != 's' && $q != 'sd')
                $sortQ[] = $q . '=' . $v;
            if (is_array($v))
                foreach ($v as $val)
                    $qs[] = $q . '%5B%5D=' . $v;
            else
                $qs[] = $q . '=' . $v;
        }
    }
	$query_string = implode('&', $qs);
    $sortQ = implode('&', $sortQ);
	
	$sort = $_GET['s']?$_GET['s']:'insert_time';
	$sort_dir = $_GET['sd']?$_GET['sd']:'DESC';

	$offset = $_GET['pg']?($_GET['pg']*$limit) - $limit:0;
	
	$where = empty($where)?'true':$where;
	
	$messages = incoming::getMany([
		'where'		=> $where,
		'sort'		=> $sort,
		'sort_dir'	=> $sort_dir,
		'limit'		=> $limit,
		'offset'	=> $offset
	]);
	
	
	if ($_GET['s']) {
		$arrow[$_GET['s']] = '&nbsp;&nbsp;<img src="/images/icons/sort-'.$_GET['sd'].'.png" align="right">';
	}
	else $arrow['insert_time'] = '&nbsp;&nbsp;<img src="/images/icons/sort-desc.png" align="right">';
?>
	<h1 class="page-header">Contact Form Submissions</h1>
    
    <ul class="nav nav-tabs">
      <li role="presentation" <?=!is_numeric($_GET['status'])?'class="active"':''?>><a href="/admin/submissions">All</a></li>
      <li role="presentation" <?=is_numeric($_GET['status']) && !$_GET['status']?'class="active"':''?>><a href="/admin/submissions?status=0">Unread</a></li>
      <li role="presentation" <?=$_GET['status'] == 1?'class="active"':''?>><a href="/admin/submissions?status=1">Read</a></li>
      <li role="presentation" <?=$_GET['status'] == 3?'class="active"':''?>><a href="/admin/submissions?status=3">Deleted</a></li>
	</ul>
<?php
	if ($count > $limit) {
		$pages = ceil($count / $limit);
?>
		<ul class="pagination">
<?php
		for ($x = 1; $x <= $pages; $x++) {
?>
        	<li <?=$_GET['pg']==$x || ($x==1 && !$_GET['pg'] )?'class="active"':''?>><a href="?pg=<?=$x?><?=$query_string ? '&' . $query_string : '' ?>"><?=$x?></a></li>
<?php
		}
?>
		</ul>
<?php
	}
?>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th><a href="?<?=$sortQ!=''?$sortQ."&":''?>s=name&sd=<?=($_GET['s']=='name' && $_GET['sd']=='asc')?'desc':'asc'?>">Name<?=$arrow['name']?></a></th>
              <th><a href="?<?=$sortQ!=''?$sortQ."&":''?>s=email&sd=<?=($_GET['s']=='email' && $_GET['sd']=='asc')?'desc':'asc'?>">Email<?=$arrow['email']?></a></th>
              <th><a href="?<?=$sortQ!=''?$sortQ."&":''?>s=subject&sd=<?=($_GET['s']=='subject' && $_GET['sd']=='asc')?'desc':'asc'?>">Subject<?=$arrow['subject']?></a></th>
              <th><a href="?<?=$sortQ!=''?$sortQ."&":''?>s=message&sd=<?=($_GET['s']=='message' && $_GET['sd']=='asc')?'desc':'asc'?>">Message<?=$arrow['message']?></a></th>
              <th><a href="?<?=$sortQ!=''?$sortQ."&":''?>s=insert_time&sd=<?=($_GET['s']=='insert_time' && $_GET['sd']=='asc')?'desc':'asc'?>">Date / Time<?=$arrow['insert_time']?></a></th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
<?php
	foreach($messages as $rec) {
?>
			<tr <?=$rec->status==0?'class="bold"':''?> id="<?=$rec->ide?>">
              <td><?=$rec->name?></td>
              <td><a href="mailto:<?=$rec->email?>"><?=$rec->email?></a></td>
              <td><?=$rec->subject?></td>
              <td><?=$rec->message?></td>
              <td><?=date(DATE_TIME,strtotime($rec->insert_time))?></td>
              <td><nobr><a class="view"><span class="glyphicon glyphicon-eye-open"></span></a>&nbsp;&nbsp;&nbsp;<a class="delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></nobr></td>            </tr>
<?php
	}
?>
          </tbody>
        </table>
      </div>
<?php
	$this->template('cms','bottom');