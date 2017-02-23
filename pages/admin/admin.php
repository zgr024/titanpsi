<?php

	use \FSM\Model\blog_post;
	
	$this->title = 'Overview';
	$this->page = 'overview';
	$this->template('cms','top');
	
	$comment = sql_array("SELECT COUNT(id) AS count FROM blog_post_comment WHERE status = 0 AND active = 1");
	$submission = sql_array("SELECT COUNT(id) AS count FROM incoming WHERE status = 0 AND active = 1");
	$vote = sql_array("SELECT COUNT(id) AS count FROM blog_post_vote WHERE DATE(insert_time) = DATE(now()) AND active = 1");
?>
    <h1 class="page-header"><?=$this->title?></h1>

      <div class="row placeholders">
        
        <div class="col-xs-6 col-sm-3 overview">
          <a class="admin" href="https://www.google.com/analytics/web/" target="_blank">
          	<img src="/images/admin/pie-chart.png" class="img-responsive" alt="Generic placeholder thumbnail">
          	<h4>Google</h4>
          	<span class="text-muted">Analytics</span>
          </a>
        </div>
        <div class="col-xs-6 col-sm-3 overview">
          <a class="admin" href="/admin/comments">
          	<img src="/images/admin/comments.png" class="img-responsive" alt="Generic placeholder thumbnail">
          	<h4><?=$comment[0]['count']?> New</h4>
          	<span class="text-muted">Comments</span>
          </a>
        </div>
        <div class="col-xs-6 col-sm-3 overview">
          <a class="admin" href="/admin/submissions">
          	<img src="/images/admin/form.png" class="img-responsive" alt="Generic placeholder thumbnail">
          	<h4><?=$submission[0]['count']?> New</h4>
          	<span class="text-muted">Form Submissions</span>
          </a>
        </div>
        <div class="col-xs-6 col-sm-3 overview">
          <a class="admin" href="/admin/votes">
          	<img src="/images/admin/vote.png" class="img-responsive" alt="Generic placeholder thumbnail">
          	<h4><?=$vote[0]['count']?> New</h4>
          	<span class="text-muted">Votes</span>
          </a>
        </div>
      </div>
<?php
    $limit = 10;
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
	
	if (!$_GET['deleted']) $where = "status != 3";
	else $where = "status = 3";
	
	$posts = blog_post::getMany([
		'where' 	=> $where,
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
	<h2 class="sub-header">Recent Posts</h2>

      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
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
              <td><?=$rec->title?></td>
              <td><?=ucwords($rec->category)?></td>
              <td><?=$body?>...</td>
              <td><?=$rec->post_datetime?date('m/d/Y g:ia',strtotime($rec->post_datetime)):''?></td>
              <td><?=$status?><?=$rec->featured?' <strong><i class="fa fa-star"></i></strong>':''?></td>
              <td><nobr><a target="_blank" href="<?=$path?>/<?=$rec->slug?>?preview=true"><span class="glyphicon glyphicon-eye-open"></span></a>&nbsp;&nbsp;&nbsp;<a href="/admin/edit-post/<?=$rec->ide?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>&nbsp;&nbsp;&nbsp;<a class="delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></nobr></td>
            </tr>
<?php
	}
?>
          </tbody>
        </table>
      </div>
<?php
	$this->template('cms','bottom');