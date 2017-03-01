<?php
	use \FSM\Model\blog_post;
	
	if ($template_area == 'top') {	
		if ($_GET['destroy']) session_destroy();
        $this->css[] = '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css';
		$this->css[] = '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css';
		$this->js[] = '/lib/js/jquery.cycle2.min.js';
		$this->js[] = '/lib/js/jquery.livequery.min.js';
        $this->js[] = '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js';

    	$this->favicon = '/images/icons/favicon.png';

		$this->template('html5','top');
?>
		<header class="container-fluid hidden-xs">
        	<div class="container">
            	<div class="row">
                	<ul>
                        <li>LICENSED &amp; INSURED</li>
                        <li><a href="/">HOME</a></li>
                        <li><a href="/our-services">SERVICES</a> </li>
                        <li><a href="/building-maintenance">BUILDING MAINTENANCE</a> </li>
                        <li><a class="scrollLink" data-target="about">ABOUT</a></li>
                        <li><a class="scrollLink" data-target="about">CONTACT US</a></li>
                        <li>(754) 300-9PSI</li>
                    </ul>
                </div>
            </div>
        </header>
		<div class="container-fluid">

<?php
	}
	else if ($template_area == 'bottom') {
        if (!$this->noContact) {
            ?>
            <section id="contact" class="container-fluid">
                <div class="container">
                    <h2>CONTACT US 24/7</h2>
                    <div class="row">
                        <div class="col-md-3">
                            <h3>CALL US</h3>
                            <div>(754) 300-9774</div>
                        </div>
                        <div class="col-md-3">
                            <h3>EMAIL US</h3>
                            <div><a href="mailto:Sales@TitanPSI.com">mailto:Sales@TitanPSI.com</a></div>
                        </div>
                        <div class="col-md-3">
                            <h3>AREAS COVERED</h3>
                            <div class="areas">
                                <div class="col-md-6">
                                    Broward<br>
                                    Miami Dade<br>
                                    Palm Beach
                                </div>
                                <div class="col-md-6">
                                    Orlando<br>
                                    The Keys<br>
                                    Naples
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h3>FOLLOW US</h3>
                            <div>
                                <a href="https://www.facebook.com/titanpsi"><i class="fa fa-facebook"></i></a>
                                <a href="https://www.twitter.com/titanpsi"><i class="fa fa-twitter"></i></a>
                                <a href="https://instagram.com/titanpsi"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
        }
?>
		</div>
<?php

		$this->template('html5','bottom');
	}