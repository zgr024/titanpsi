<?php
	use \FSM\Model\user;
	
	$this->title = "Users";
	$this->page = 'users';
	$this->template('cms','top');
	
	$limit = 25;
	$rs = sql_array("SELECT count(id) as count FROM admin WHERE active = 1");
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
	
	$users = user::getMany([
		'sort'=>$sort ,
		'sort_dir'=>$sort_dir,
		'limit'=>$limit,
		'offset'=>$offset
	]);
	
	
	if ($_GET['s']) {
		$arrow[$_GET['s']] = '&nbsp;&nbsp;<img src="/images/icons/sort-'.$_GET['sd'].'.png" align="right">';
	}
	else $arrow['insert_time'] = '&nbsp;&nbsp;<img src="/images/icons/sort-desc.png" align="right">';
?>
	<h1 class="page-header"><?=$this->title?><a class="add-new" href="/admin/users/register">Add New User</a></h1>
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
              <th><a href="?<?=$sortQ!=''?$sortQ."&":''?>s=access_group&sd=<?=($_GET['s']=='access_group' && $_GET['sd']=='asc')?'desc':'asc'?>">Access Group<?=$arrow['access_group']?></a></th>
              <th><a href="?<?=$sortQ!=''?$sortQ."&":''?>s=status&sd=<?=($_GET['s']=='status' && $_GET['sd']=='asc')?'desc':'asc'?>">Status<?=$arrow['status']?></a></th>
              <th><a href="?<?=$sortQ!=''?$sortQ."&":''?>s=insert_time&sd=<?=($_GET['s']=='insert_time' && $_GET['sd']=='asc')?'desc':'asc'?>">Activated Date / Time<?=$arrow['insert_time']?></a></th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
<?php
	foreach($users as $rec) {
?>
			<tr id="<?=$rec->ide?>">
              <td><?=$rec->person->full_name?></td>
              <td><a href="mailto:<?=$rec->person->email?>"><?=$rec->person->email?></a></td>
              <td><?=$rec->access_group?></td>
              <td><?=$rec->status?'Active':'Inactive'?></td>
              <td><?=date(DATE_TIME,strtotime($rec->insert_time))?></td>
              <td><a href="/admin/users/edit/<?=$rec->ide?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>&nbsp;&nbsp;&nbsp;<a class="delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
            </tr>
<?php
	}
?>
          </tbody>
        </table>
      </div>
<?php
	$this->template('cms','bottom');