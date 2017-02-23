<?php

	if ($template_area == 'top') {
		
		$this->css[] = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css';
		$this->css[] = '/templates/cms/dashboard.css';
		$this->css[] = '/lib/css/jquery-confirm.min.css';
		$this->css[] = '/lib/font-awesome-4.3.0/css/font-awesome.min.css';
		$this->css[] = '/lib/jquery-ui-1.11.4/jquery-ui.min.css';
		$this->css[] = '/lib/jquery-ui-1.11.4/add-ons/timepicker.css';
		$this->js[] = '/lib/jquery-ui-1.11.4/jquery-ui.min.js';
		$this->js[] = '/lib/jquery-ui-1.11.4/add-ons/timepicker.js';
		$this->js[] = '/lib/js/jquery-confirm.min.js';
		$this->js[] = '/lib/js/jquery.maskedinput.min.js';
		$this->js[] = '/templates/cms/docs.min.js';
		$this->js[] = '/lib/js/jquery.livequery.min.js';
		$this->js[] = '/templates/cms/ie10-viewport-bug-workaround.js';
		$this->js[] = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js';

		$this->favicon = '/images/icons/flirt.png';
		$this->template('html5','top');
?>
     <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Flirt Skirt or Marry</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="/admin/users/profile" <?=$this->page=='profile'?'class="active"':''?>><i class="fa fa-user"></i> My Profile</a></li>
            <li><a href="/admin/users" <?=$this->page=='users'?'class="active"':''?>><i class="fa fa-users"></i> Users</a></li>
            <li><a href="/admin?logout=1"><i class="fa fa-sign-out"></i> Logout</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li <?=$this->page=='overview'?'class="active"':''?>><a href="/admin">Overview <span class="sr-only">(current)</span></a></li>
          </ul>
          <ul class="nav nav-sidebar">
          	<li <?=$this->page=='new-post'?'class="active"':''?>><a href="/admin/new-post">New Post</a></li>
            <li <?=$this->page=='posts'?'class="active"':''?>><a href="/admin/posts">Posts</a></li>
          </ul>
          <ul class="nav nav-sidebar">
	        <li <?=$this->page=='analytics'?'class="active"':''?>><a target="analytics" href="https://www.google.com/analytics/web/">Analytics</a></li>
            <li <?=$this->page=='comments'?'class="active"':''?>><a href="/admin/comments">Comments</a></li>
            <li <?=$this->page=='submissions'?'class="active"':''?>><a href="/admin/submissions">Submissions</a></li>
            <li <?=$this->page=='votes'?'class="active"':''?>><a href="/admin/votes">Votes</a></li>            
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<?php
	}
	else if ($template_area == 'bottom') {
?>
        </div>
      </div>
    </div>
<?php
	$this->template('html5','bottom');
	}
?>