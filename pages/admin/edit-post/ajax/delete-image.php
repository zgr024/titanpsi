<?php
	global $skyphp_storage_path;
	//print_r($_POST);
	
	$img = str_replace('/img/',$skyphp_storage_path.'images/',$_POST['src']);
	
	unlink ($img);
	exit('Image Removed');