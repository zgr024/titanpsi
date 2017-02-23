<?php
	$this->title = "How To Use This Site";
	$this->head[]= '
		<meta name="copyright" content="Copyright '.date('Y').' Flirt Skirt or Marry, LLC">
		<meta name="description" content="How to use Flirt Skirt or Marry">
		<meta name="keywords" content="fashion trends,spring fashion trends,fall fashion trends,summer fashion trends,latest fashion trends,trending styles,favorite fashion,favorite styles">
		<meta name="DC.title" content="'.$this->title.'">
	';
    $this->sidebar = 'how-to';
	$this->template('website','top');
?>

	<div class="row" style="margin-top: 10px;">
    	<div class="col-md-12">
        	<img src="/images/how-to-use/how-to-use.jpg" class="img-responsive">
   		</div>
    </div>
   
<?php
	$this->template('website','bottom');