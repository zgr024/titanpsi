<?php

	use \FSM\Model\blog_post_comment;
	$this->title = "Comments";
	$this->page = 'comments';
	$this->template('cms','top');
	
	$limit = 25;
	$rs = sql_array("SELECT count(id) as count FROM blog_post_comment WHERE active = 1");
	$count = $rs[0]['count'];
	
	$qs = array();
    $sortQ = array();
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
	
	$sort = $_GET['s']?$_GET['s']:'status, insert_time';
	$sort_dir = $_GET['sd']?$_GET['sd']:'DESC';

	$offset = $_GET['pg']?($_GET['pg']*$limit) - $limit:0;
	
	if ($_GET['status']) $where[] = "status = ".$_GET['status'];
	else if ($_GET['deleted']) $where[] = "status = 3";
	else $where[] = "status = 0";
	
	$messages = blog_post_comment::getMany([
		'where'		=> $where,
		'sort'		=> $sort ,
		'sort_dir'	=> $sort_dir,
		'limit'		=> $limit,
		'offset'	=> $offset
	]);
	
	
	if ($_GET['s']) {
		$arrow[$_GET['s']] = '&nbsp;&nbsp;<img src="/images/icons/sort-'.$_GET['sd'].'.png" align="right">';
	}
	else {
		$arrow['insert_time'] = '&nbsp;&nbsp;<img src="/images/icons/sort-desc.png" align="right">';
		$arrow['status'] = '&nbsp;&nbsp;<img src="/images/icons/sort-asc.png" align="right">';
	}
?>
	<h1 class="page-header">Comments</h1>
    
    <ul class="nav nav-tabs">
      <li role="presentation" <?=!is_numeric($_GET['status'])?'class="active"':''?>><a href="/admin/comments">New</a></li>
      <li role="presentation" <?=$_GET['status'] == 1?'class="active"':''?>><a href="/admin/comments?status=1">Approved</a></li>
      <li role="presentation" <?=$_GET['status'] == 2?'class="active"':''?>><a href="/admin/comments?status=2">Flagged</a></li>
      <li role="presentation" <?=$_GET['status'] == 3?'class="active"':''?>><a href="/admin/comments?status=3">Deleted</a></li>
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
	          <th><a href="?<?=$sortQ!=''?$sortQ."&":''?>s=status&sd=<?=($_GET['s']=='status' && $_GET['sd']=='asc')?'desc':'asc'?>">Status<?=$arrow['status']?></a></th>
              <th><a href="?<?=$sortQ!=''?$sortQ."&":''?>s=full_name&sd=<?=($_GET['s']=='full_name' && $_GET['sd']=='asc')?'desc':'asc'?>">Name<?=$arrow['full_name']?></a></th>
              <th><a href="?<?=$sortQ!=''?$sortQ."&":''?>s=email&sd=<?=($_GET['s']=='email' && $_GET['sd']=='asc')?'desc':'asc'?>">Email<?=$arrow['email']?></a></th>
              <th><a href="?<?=$sortQ!=''?$sortQ."&":''?>s=website&sd=<?=($_GET['s']=='website' && $_GET['sd']=='asc')?'desc':'asc'?>">Website<?=$arrow['website']?></a></th>
              <th><a href="?<?=$sortQ!=''?$sortQ."&":''?>s=message&sd=<?=($_GET['s']=='message' && $_GET['sd']=='asc')?'desc':'asc'?>">Message<?=$arrow['message']?></a></th>
              <th><a href="?<?=$sortQ!=''?$sortQ."&":''?>s=insert_time&sd=<?=($_GET['s']=='insert_time' && $_GET['sd']=='asc')?'desc':'asc'?>">Date / Time<?=$arrow['insert_time']?></a></th>
              <th><a href="?<?=$sortQ!=''?$sortQ."&":''?>s=blog_post_id&sd=<?=($_GET['s']=='blog_post_id' && $_GET['sd']=='asc')?'desc':'asc'?>">Post<?=$arrow['blog_post_id']?></a></th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
<?php
	foreach($messages as $rec) {
?>
			<tr id="<?=$rec->ide?>">
              <td>
              	<select class="status">
                  <option value="0" <?=$rec->status==0?'selected':''?>>New</option>
                  <option value="1" <?=$rec->status==1?'selected':''?>>Approved</option>
                  <option value="2" <?=$rec->status==2?'selected':''?>>Flagged</option>
                  <option value="3" <?=$rec->status==3?'selected':''?>>Deleted</option>
                </select>
              </td>
              <td><?=$rec->full_name?></td>
              <td><a href="mailto:<?=$rec->email?>"><?=$rec->email?></a></td>
              <td><?=$rec->website?></td>
              <td><?=$rec->message?></td>
              <td><?=date(DATE_TIME,strtotime($rec->insert_time))?></td>
              <td><?=$rec->post->title?></td>
              <td><a class="delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
            </tr>
<?php
	}
?>
          </tbody>
        </table>
      </div>
<?php
	$this->template('cms','bottom');