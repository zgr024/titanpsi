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
        <div class="col-md-9 col-sm-7 col-xs-12">
            <div class="row">
                <h2>About</h2>
            </div>
            <div class="row">
                <div class="col-md-12 text-center size20">   	
                    <p>
                        <em>Flirt Skirt or Marry</em> was created by <strong>Allison Duda Kahler</strong> and
                        <strong>Abby Sonnett</strong> in 2014. Originally from Ohio, these NYC
                        transplants were inspired by the New York fashion culture,
                        and discovered the need to bring it to other parts of the
                        country faster than the current year cycle. 
                    </p>
                </div>
            </div>
            <div class="row">
            	<div class="col-md-12 text-center size20">
                    <p>
                    	Through utilizing fast fashion retailers and their discovery of
                        underutilized brands, FSM creates a community of
                        like-minded females who wish to be educated on current
                        trends, as well as be the leaders for runway style expansion to
                        their demographics.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center size20">
                    <p>
                        This site is used for learning how to adapt current runway
                        trends into your own wardrobe from accessible resources. 
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 border text-center pad10 how-to-use-link">
                    <a href="/how-to-use">HOW TO USE THIS SITE</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center size20">
                    <p>
                        FlirtSkirtOrMarry.com extends trends beyond the fashion
                        capitals, by seeking user opinions to form a realistic forecast
                        of trends. FlirtSkirtOrMarry.com eases the approach to high
                        fashion and promotes attainable style.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-5 hidden-xs">
            <img class="img-responsive" src="/images/about/allison-and-abby.png">
        </div>
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