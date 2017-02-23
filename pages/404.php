<?php
	if ($_SERVER['REQUEST_URI'] == '/twitterOAuth') redirect('/');
	$this->noSidebar = true;
	$this->template('website','top');
?>
	<div class="row">
		<div class="col-md-12" style="min-height: 600px;">
        	<h1>OOPS... The page you are looking for was not found.</h1>
        </div>
    </div>
<?php
	$this->template('website','bottom');