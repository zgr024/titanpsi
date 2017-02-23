<?php
	use \FSM\Model\blog_post_vote;
	
	$this->title = "Fashion Trend Votes";
	$this->page = 'votes';
	$this->template('cms','top');
	
	$limit = 25;
	$rs = sql_array("SELECT count(id) as count FROM blog_post_vote");
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
	
	$votes = blog_post_vote::getMany([
		'sort'=>$sort,
		'sort_dir'=>$sort_dir,
		'limit'=>$limit,
		'offset'=>$offset
	]);
	
	
	if ($_GET['s']) {
		$arrow[$_GET['s']] = '&nbsp;&nbsp;<img src="/images/icons/sort-'.$_GET['sd'].'.png" align="right">';
	}
	else $arrow['insert_time'] = '&nbsp;&nbsp;<img src="/images/icons/sort-desc.png" align="right">';
?>
	<h1 class="page-header"><?=$this->title?></h1>
    
    <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a href="/admin/votes">List View</a></li>
        <li role="presentation"><a href="/admin/votes/map">Map View</a></li>
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
        <table class="table table-striped" id="votesTable">
          <thead>
            <tr>
              <th><a href="?<?=$sortQ!=''?$sortQ."&":''?>s=title&sd=<?=($_GET['s']=='title' && $_GET['sd']=='asc')?'desc':'asc'?>">Post<?=$arrow['title']?></a></th>
              <th><a href="?<?=$sortQ!=''?$sortQ."&":''?>s=location&sd=<?=($_GET['s']=='location' && $_GET['sd']=='asc')?'desc':'asc'?>">Location<?=$arrow['location']?></a></th>
              <th><a href="?<?=$sortQ!=''?$sortQ."&":''?>s=ip_address&sd=<?=($_GET['s']=='ip_address' && $_GET['sd']=='asc')?'desc':'asc'?>">IP Address<?=$arrow['ip_address']?></a></th>
              <th><a href="?<?=$sortQ!=''?$sortQ."&":''?>s=vote&sd=<?=($_GET['s']=='vote' && $_GET['sd']=='asc')?'desc':'asc'?>">Vote<?=$arrow['vote']?></a></th>
              <th><a href="?<?=$sortQ!=''?$sortQ."&":''?>s=insert_time&sd=<?=($_GET['s']=='insert_time' && $_GET['sd']=='asc')?'desc':'asc'?>">Date / Time<?=$arrow['insert_time']?></a></th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
<?php
	foreach($votes as $rec) {
?>
			<tr id="<?=$rec->ide?>">
              <td><?=$rec->title?></td>
              <td><?=$rec->location?></a></td>
              <td><?=$rec->ip_address?></td>
              <td><?=$rec->vote?></td>
              <td><?=date(DATE_TIME,strtotime($rec->insert_time))?></td>
              <td><a href="/admin/votes/map/single/<?=$rec->ide?>">View on Map</a></td>
            </tr>
<?php
	}
?>
          </tbody>
        </table>
      </div>
      <input type="hidden" id="lastID" value="<?=blog_post_vote::getLastID()?>">
<?php
	$this->template('cms','bottom');