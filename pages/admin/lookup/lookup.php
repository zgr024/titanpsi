<?
	$this->template('cms','top');
?>
	<div class="form-group">
    	<textarea id="sql" class="form-control" placeholder="Enter SQL..."></textarea>
        <button type="button" class="btn btn-primary" id="runSQL">Run</button>
    </div>
    
    <div id="results"></div>
<?    
	$this->template('cms','bottom');