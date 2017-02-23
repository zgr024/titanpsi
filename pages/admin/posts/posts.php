<?php

	use \FSM\Model\blog_post;
	
	$this->title = 'Posts';
	$this->page = 'posts';
	$this->js[] = '/pages/admin/admin.js';
	$this->css[] = '/pages/admin/admin.css';
	$this->template('cms','top');
?>
	<h1 class="page-header"><?=$this->title?></h1>
    
    <ul class="nav nav-tabs">
      <li role="presentation" <?=!is_numeric($_GET['status'])?'class="active"':''?>><a href="/admin/posts">All Active</a></li>
      <li role="presentation" <?=$_GET['status'] === 0?'class="active"':''?>><a href="/admin/posts?status=0">Draft</a></li>
      <li role="presentation" <?=$_GET['status'] == 1?'class="active"':''?>><a href="/admin/posts?status=1">Published</a></li>
      <li role="presentation" <?=$_GET['status'] == 2?'class="active"':''?>><a href="/admin/posts?status=2">Archived</a></li>
      <li role="presentation" <?=$_GET['status'] == 3?'class="active"':''?>><a href="/admin/posts?status=3">Deleted</a></li>
	</ul>
<?php

	
	$limit = 25;
	$rs = sql_array("SELECT count(id) as count FROM blog_post WHERE active = 1");
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
	
	$sort = $_GET['s']?$_GET['s']:'insert_time';
	$sort_dir = $_GET['sd']?$_GET['sd']:'DESC';

	$offset = $_GET['pg']?($_GET['pg']*$limit) - $limit:0;
	
	if (is_numeric($_GET['status'])) $where = "status = ".$_GET['status'];
	else $where = "status != 3";
	
	$posts = blog_post::getMany([
		'where'		=> $where,
		'sort'		=> $sort ,
		'sort_dir'	=> $sort_dir,
		'limit'		=> $limit,
		'offset'	=> $offset
	]);
	
	
	if ($_GET['s']) {
		$arrow[$_GET['s']] = '&nbsp;&nbsp;<img src="/images/icons/sort-'.$_GET['sd'].'.png" align="right">';
	}
	else $arrow['insert_time'] = '&nbsp;&nbsp;<img src="/images/icons/sort-desc.png" align="right">';

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
<?			if (PERSON_ID == 1) { ?>
              <th><a href="?<?=$sortQ!=''?$sortQ."&":''?>s=id&sd=<?=($_GET['s']=='id' && $_GET['sd']=='asc')?'desc':'asc'?>">ID<?=$arrow['id']?></a></th>
<?  		} ?>  
              <th><a href="?<?=$sortQ!=''?$sortQ."&":''?>s=title&sd=<?=($_GET['s']=='title' && $_GET['sd']=='asc')?'desc':'asc'?>">Name<?=$arrow['title']?></a></th>
              <th><a href="?<?=$sortQ!=''?$sortQ."&":''?>s=category&sd=<?=($_GET['s']=='category' && $_GET['sd']=='asc')?'desc':'asc'?>">Category<?=$arrow['category']?></a></th>
              <th><a href="?<?=$sortQ!=''?$sortQ."&":''?>s=body&sd=<?=($_GET['s']=='body' && $_GET['sd']=='asc')?'desc':'asc'?>">Body<?=$arrow['body']?></a></th>
              <th><a href="?<?=$sortQ!=''?$sortQ."&":''?>s=post_datetime&sd=<?=($_GET['s']=='post_datetime' && $_GET['sd']=='asc')?'desc':'asc'?>">Post Date/Time<?=$arrow['post_datetime']?></a></th>              
              <th><a href="?<?=$sortQ!=''?$sortQ."&":''?>s=status&sd=<?=($_GET['s']=='status' && $_GET['sd']=='asc')?'desc':'asc'?>">Status<?=$arrow['status']?></a></th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
<?php
	foreach($posts as $rec) {
		
		$body = explode(' ',strip_tags($rec->body),20);
		array_pop($body);
		$body = implode(' ',$body);
		if (strlen($body) > 100) $body = substr($body,0,100);
		
		switch($rec->category) {
			case 'fashion trend':
				$path = '/style-tips';
				break;
			case 'shopping':
				$path = '/shopping';
				break;
			case 'have to have it':
				$path = 'have-to-have-it';
				break;
			default:
				$path = '';
		}
		
		switch ($rec->status) {
			case 0: $status = 'Draft'; break;
			case 1: $status = 'Published'; break;		
			case 2: $status = 'Archived'; break;
			case 3: $status = 'Deleted'; break;
		}
		
?>
			<tr id="<?=$rec->ide?>">
<?			if (PERSON_ID == 1) { ?>
              <td><?=$rec->id?></td>
<?  		} ?>              
			  <td><?=$rec->title?></td>
              <td><?=ucwords($rec->category)?></td>
              <td><?=$body?>...</td>
              <td><?=$rec->post_datetime?date('m/d/Y g:ia',strtotime($rec->post_datetime)):''?></td>
              <td><?=$status?><?=$rec->featured?' <strong><i class="fa fa-star"></i></strong>':''?></td>
              <td>	
              	<nobr>
                  <a target="_blank" href="<?=$path?>/<?=$rec->slug?>?preview=true"><span class="glyphicon glyphicon-eye-open"></span></a>&nbsp;&nbsp;&nbsp;
                  <a href="/admin/edit-post/<?=$rec->ide?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>&nbsp;&nbsp;&nbsp;
                  <a class="delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                </nobr>
              </td>
            </tr>
<?php
	}
?>
          </tbody>
        </table>
	</div>
    
<?php
	$this->template('cms','bottom');