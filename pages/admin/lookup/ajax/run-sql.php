<?
	if (strpos(trim($_POST['sql']),'SELECT') !== false) {
		print_a(
			sql_array(
				trim($_POST['sql'])
			)
		);
	}
	else {
		sql(trim($_POST['sql']));
		exit ("Query executed");
	}