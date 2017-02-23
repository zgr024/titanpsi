<?php
	$slides = array();
	
	$slides[0] = new stdClass();
	$slides[0]->image = '/images/temp/sneaks.jpg';
	$slides[0]->name = 'Summer Sneaks';
	$slides[0]->tagline = 'Going Sporty?';
	$slides[0]->category = 'flirt.skirt.marry';
	$slides[0]->slug = 'summer-sneaks';
	$slides[0]->similar = new stdClass();
	$slides[0]->similar->slug = 'mules';
	$slides[0]->description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mattis tempor risus, nec porttitor mauris lobortis vitae. Ut risus mi, finibus vitae ipsum.';
	
	$slides[1] = new stdClass();
	$slides[1]->image = '/images/temp/sneaks-zoomed.png';
	$slides[1]->name = 'Walk of Shame';
	$slides[1]->tagline = 'You Can Now Run!';
	$slides[1]->category = 'flirt.skirt.marry';
	$slides[1]->slug = 'summer-sneaks';
	$slides[1]->similar = new stdClass();
	$slides[1]->similar->slug = 'summer-kicks';
	$slides[1]->description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mattis tempor risus, nec porttitor mauris lobortis vitae. Ut risus mi, finibus vitae ipsum.';
	
	$slides[2] = new stdClass();
	$slides[2]->image = '/images/temp/sneaks-bw.png';
	$slides[2]->name = 'Walk of Shame';
	$slides[2]->tagline = 'Summer Lovin\'';
	$slides[2]->category = 'flirt.skirt.marry';
	$slides[2]->slug = 'summer-lovin';
	$slides[2]->similar = new stdClass();
	$slides[2]->similar->slug = 'move-over-mules';
	$slides[2]->description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mattis tempor risus, nec porttitor mauris lobortis vitae. Ut risus mi, finibus vitae ipsum.';
	
	$posts = array();
	
	for ($x = 0; $x <= 10; $x++){
		$posts[$x] = new stdClass();
	}	
	
	$posts[0]->category = 'shopping';
	$posts[0]->image = '/images/temp/post-image.png';
	$posts[0]->name = 'All Natural, All Season Long';
	$posts[0]->description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mattis tempor risus, nec porttitor mauris lobortis vitae. Ut risus mi, finibus vitae ipsum ac, consequat maximus turpis. Nullam gravida eu mauris et gravida. Donec a diam mollis, molestie massa sit amet, pharetra arcu. Nunc hendrerit odio ut molestie sodales. Duis risus risus, ultrices quis leo vel, lacinia porta metus.';
	$posts[0]->slug = 'all-natural';
	
	$posts[1]->category = 'flirt.skirt.marry?';
	$posts[1]->image = '/images/temp/post-image.png';
	$posts[1]->name = 'All Natural, All Season Long';
	$posts[1]->description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mattis tempor risus, nec porttitor mauris lobortis vitae. Ut risus mi, finibus vitae ipsum ac, consequat maximus turpis. Nullam gravida eu mauris et gravida. Donec a diam mollis, molestie massa sit amet, pharetra arcu. Nunc hendrerit odio ut molestie sodales. Duis risus risus, ultrices quis leo vel, lacinia porta metus.';
	$posts[1]->slug = 'all-natural1';
	
	$posts[2]->category = 'flirt.skirt.marry?';
	$posts[2]->image = '/images/temp/post-image.png';
	$posts[2]->name = 'All Natural, All Season Long';
	$posts[2]->description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mattis tempor risus, nec porttitor mauris lobortis vitae. Ut risus mi, finibus vitae ipsum ac, consequat maximus turpis. Nullam gravida eu mauris et gravida. Donec a diam mollis, molestie massa sit amet, pharetra arcu. Nunc hendrerit odio ut molestie sodales. Duis risus risus, ultrices quis leo vel, lacinia porta metus.';
	$posts[2]->slug = 'all-natural2';
	
	$posts[3]->category = 'shopping';
	$posts[3]->image = '/images/temp/post-image.png';
	$posts[3]->name = 'All Natural, All Season Long';
	$posts[3]->description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mattis tempor risus, nec porttitor mauris lobortis vitae. Ut risus mi, finibus vitae ipsum ac, consequat maximus turpis. Nullam gravida eu mauris et gravida. Donec a diam mollis, molestie massa sit amet, pharetra arcu. Nunc hendrerit odio ut molestie sodales. Duis risus risus, ultrices quis leo vel, lacinia porta metus.';
	$posts[3]->slug = 'all-natural3';
	
	$posts[4]->category = 'flirt.skirt.marry?';
	$posts[4]->image = '/images/temp/post-image.png';
	$posts[4]->name = 'All Natural, All Season Long';
	$posts[4]->description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mattis tempor risus, nec porttitor mauris lobortis vitae. Ut risus mi, finibus vitae ipsum ac, consequat maximus turpis. Nullam gravida eu mauris et gravida. Donec a diam mollis, molestie massa sit amet, pharetra arcu. Nunc hendrerit odio ut molestie sodales. Duis risus risus, ultrices quis leo vel, lacinia porta metus.';
	$posts[4]->slug = 'all-natural4';
	
	$posts[5]->category = 'flirt.skirt.marry?';
	$posts[5]->image = '/images/temp/post-image.png';
	$posts[5]->name = 'All Natural, All Season Long';
	$posts[5]->description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mattis tempor risus, nec porttitor mauris lobortis vitae. Ut risus mi, finibus vitae ipsum ac, consequat maximus turpis. Nullam gravida eu mauris et gravida. Donec a diam mollis, molestie massa sit amet, pharetra arcu. Nunc hendrerit odio ut molestie sodales. Duis risus risus, ultrices quis leo vel, lacinia porta metus.';
	$posts[5]->slug = 'all-natural5';
	
	$posts[6]->category = 'shopping';
	$posts[6]->image = '/images/temp/post-image.png';
	$posts[6]->name = 'All Natural, All Season Long';
	$posts[6]->description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mattis tempor risus, nec porttitor mauris lobortis vitae. Ut risus mi, finibus vitae ipsum ac, consequat maximus turpis. Nullam gravida eu mauris et gravida. Donec a diam mollis, molestie massa sit amet, pharetra arcu. Nunc hendrerit odio ut molestie sodales. Duis risus risus, ultrices quis leo vel, lacinia porta metus.';
	$posts[6]->slug = 'all-natural6';
	
	$posts[7]->category = 'shopping';
	$posts[7]->image = '/images/temp/post-image.png';
	$posts[7]->name = 'All Natural, All Season Long';
	$posts[7]->description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mattis tempor risus, nec porttitor mauris lobortis vitae. Ut risus mi, finibus vitae ipsum ac, consequat maximus turpis. Nullam gravida eu mauris et gravida. Donec a diam mollis, molestie massa sit amet, pharetra arcu. Nunc hendrerit odio ut molestie sodales. Duis risus risus, ultrices quis leo vel, lacinia porta metus.';
	$posts[7]->slug = 'all-natural6';
	
	$posts[8]->category = 'shopping';
	$posts[8]->image = '/images/temp/post-image.png';
	$posts[8]->name = 'All Natural, All Season Long';
	$posts[8]->description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mattis tempor risus, nec porttitor mauris lobortis vitae. Ut risus mi, finibus vitae ipsum ac, consequat maximus turpis. Nullam gravida eu mauris et gravida. Donec a diam mollis, molestie massa sit amet, pharetra arcu. Nunc hendrerit odio ut molestie sodales. Duis risus risus, ultrices quis leo vel, lacinia porta metus.';
	$posts[8]->slug = 'all-natural6';
	
	$posts[9]->category = 'shopping';
	$posts[9]->image = '/images/temp/post-image.png';
	$posts[9]->name = 'All Natural, All Season Long';
	$posts[9]->description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mattis tempor risus, nec porttitor mauris lobortis vitae. Ut risus mi, finibus vitae ipsum ac, consequat maximus turpis. Nullam gravida eu mauris et gravida. Donec a diam mollis, molestie massa sit amet, pharetra arcu. Nunc hendrerit odio ut molestie sodales. Duis risus risus, ultrices quis leo vel, lacinia porta metus.';
	$posts[9]->slug = 'all-natural6';
	
	$posts[10]->category = 'shopping';
	$posts[10]->image = '/images/temp/post-image.png';
	$posts[10]->name = 'All Natural, All Season Long';
	$posts[10]->description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mattis tempor risus, nec porttitor mauris lobortis vitae. Ut risus mi, finibus vitae ipsum ac, consequat maximus turpis. Nullam gravida eu mauris et gravida. Donec a diam mollis, molestie massa sit amet, pharetra arcu. Nunc hendrerit odio ut molestie sodales. Duis risus risus, ultrices quis leo vel, lacinia porta metus.';
	$posts[10]->slug = 'all-natural6';