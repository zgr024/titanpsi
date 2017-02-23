<?php
	$this->noSidebar = true;
	$this->page = 'about';
	$this->title = 'About Us | Flirt Skirt or Marry';
	$this->head[]= '
		<meta name="copyright" content="Copyright '.date('Y').' Flirt Skirt or Marry, LLC">
		<meta name="description" content="About Us, Flirt Skirt or Marry">
		<meta name="keywords" content="All about Flirt Skirt or Marry">
		<meta name="DC.title" content="'.$this->title.'">
	';
	$this->template('website','top');
?>
    <div class="row">
        <h2>Our Mission</h2></div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1 text-center size20">   	
            <p>
                A fashion website that uses an interactive platform, to <span class="black bold basker">translate
                forward-looking fashion trends from the runway to all demographics</span> by providing style inspiration and shopping resources.
            </p>
        </div>
    </div>
    <div class="row">
    	<div class="col-md-10 col-md-offset-1 text-center size20">
            <p>
            	FlirtSkirtOrMarry.com <span class="black bold basker">extends trends beyond the fashion capitals</span>, by seeking user opinions to form a realistic forecast of trends. Used as a resource, industry professionals identify how to 
            	appropriately and effectively reach their target market through discovering consumer preference. FlirtSkirtOrMarry.com eases the approach to high fashion and promotes attainable style.
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 border text-center pad10">
            <a href="#contact-us" id="goto-contact">CONTACT US!</a>
        </div>
    </div>
    <div class="row">
        <img class="img-responsive" src="/images/about.jpg" width="1100" height="2170">
    </div>
    
    <form id="contact-us">
        <legend>CONTACT US</legend>
        <div class="row">
            <div class="col-md-5 col-md-offset-1">
                <div class="form-group">
                    <label for="name">NAME</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                </div>
                <div class="form-group">
                    <label for="email">EMAIL</label>
                    <input type="text" class="form-control" name="email" id="email" required>
                </div>
                <div class="form-group">
                    <label for="subject">SUBJECT</label>
                    <input type="text" class="form-control" name="subject" id="subject" required>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="message">MESSAGE</label>
                    <textarea class="form-control" name="message" id="message" required></textarea>
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-md-11">
            	<div id="submit" class="pull-right"><span>SUBMIT!</span></div>
            </div>
        </div>
        <div class="row">
        	<div class="col-md-10 col-md-offset-1 text-center">
            	<div id="saveMessage"></div>
            </div>
        </div>
        <img id="form-submitted" src="/images/icons/form-submitted.png" class="img-responsive"></form>
    </form>

<?php	
	$this->template('website','bottom');