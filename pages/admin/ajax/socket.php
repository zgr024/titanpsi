<?
	use \FSM\Model\blog_post_vote;
	$arr = [
		'html' 		=> '',
		'changed'	=> false
	];
	switch (IDE) {
	
		case 'votes':
			$votes = blog_post_vote::getMany([
				'where' 	=> 'id > '.$_GET['lastID'],
				'sort'		=> 'id DESC'
			]);
			$c = count($votes);
			if ($c) {
				$arr['changed'] = true;
				foreach ($votes as $key => $row) {
					$arr['html'] .= '<tr class="new" id="'.$row->ide.'">';
					$arr['html'] .= '	<td>'.$row->title.'</td>';
					$arr['html'] .= '	<td>'.$row->location.'</td>';
					$arr['html'] .= '	<td>'.$row->ip_address.'</td>';
					$arr['html'] .= '	<td>'.$row->vote.'</td>';
					$arr['html'] .= '	<td>'.date(DATE_TIME,strtotime($row->insert_time)).'</td>';
					$arr['html'] .= '<tr>';
					if ($key == $c-1) {
						$arr['lastID'] = $row->id;
					}												
				}
			}
		break;
	
	}
	
	exit(json_encode($arr));