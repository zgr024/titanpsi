<?php
	$data = blog_post::getMany([
		'sort'=>'blog_post.insert_time',
		'sort_dir'=>'DESC'
	]);
	
	$data = new stdClass();
	$data->name = 'Oversized Jumper';
	$data->posts = array();
	$data->posts[0] = new stdClass();
	$data->posts[1] = new stdClass();
	
	$data->posts[0]->image = '/images/temp/have-to-landscape.jpg';
	$data->posts[0]->bubble[0] = new stdClass();
	$data->posts[0]->bubble[1] = new stdClass();
	$data->posts[0]->orientation = 'landscape';
	$data->posts[0]->bubble[0]->text = 'Worn under a crisp, white shirt gives it a classic feel, keeping it cool and casual.';
	$data->posts[0]->bubble[1]->text = 'Converse for the weekend, silver flats or heels during the week. This look can easily be dressed up or down.';
	$data->posts[0]->bubble[0]->top = 11;
	$data->posts[0]->bubble[1]->top = 90;
	$data->posts[0]->description = 'Lorem ipsum dolor sit amet, ad laudem meliore eam, at dicunt aperiri neglegentur vis, quem dolorem apeirian ad est. Ex dicat percipitur disputando mea. At illum quaestio expetendis nec. Dictas gloriatur sea cu, cu pro everti audiam, paulo iudicabit ei nec. Ut fierent vivendum comprehensam cum, quo modo aperiam appellantur id, has te legere deseruisse. Eam eu stet viris scriptorem, cu melius theophrastus quo.';
	$data->posts[0]->poster = 'Abby';
	$data->posts[0]->price = 80.00;
	$data->posts[0]->a = 'aldo.com';
	$data->posts[0]->href = 'http://aldo.com';
	$data->posts[0]->product = 'Aldo white leather mules';
	
	$data->posts[1]->image = '/images/temp/have-to-portrait.jpg';
	$data->posts[1]->bubble[0] = new stdClass();
	$data->posts[1]->bubble[1] = new stdClass();
	$data->posts[1]->orientation = 'portrait';
	$data->posts[1]->bubble[0]->text = 'Silver stackable rings match the zipper detail in the jacket, and add to edginess of the moto jacket look.';
	$data->posts[1]->bubble[1]->text = 'Leopard print is a neutral, too. An untucked printed buttondown shirt is a refined messiness.';
	$data->posts[1]->bubble[0]->top = 49;
	$data->posts[1]->bubble[1]->top = 39;
	$data->posts[1]->description = 'Lorem ipsum dolor sit amet, ad laudem meliore eam, at dicunt aperiri neglegentur vis, quem dolorem apeirian ad est. Ex dicat percipitur disputando mea. At illum quaestio expetendis nec. Dictas gloriatur sea cu, cu pro everti audiam, paulo iudicabit ei nec. Ut fierent vivendum comprehensam cum, quo modo aperiam appellantur id, has te legere deseruisse. Eam eu stet viris scriptorem, cu melius theophrastus quo.';
	$data->posts[1]->poster = 'Abby';
	$data->posts[1]->price = 80.00;
	$data->posts[1]->a = 'aldo.com';
	$data->posts[1]->href = 'http://aldo.com';
	$data->posts[1]->product = 'Aldo white leather mules';
	