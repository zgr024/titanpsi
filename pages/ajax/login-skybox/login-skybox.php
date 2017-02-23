<?php
	if ($_SESSION['login']['person_id']) {
?>
	<script>
    	$(function() {
			$.skyboxHide();
		});
    </script>
<?	
	} 
	
	if (!$this->is_ajax_request) redirect('/admin?skybox=/ajax/login-skybox');

	$this->template('login','top');
?>
<form class="form-signin">
    <h2 class="form-signin-heading">Please sign in</h2>
    <label for="inputEmail" class="sr-only">Username</label>
    <input type="text" id="inputEmail" class="form-control" name="login_username" placeholder="Username" value="<?=$_COOKIE['login_username']?>" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" class="form-control" name="login_password" placeholder="Password" required>
    <div class="checkbox">
 		<label>
    		<input type="checkbox" name="remember" <?=$_COOKIE['login_username']?'checked':''?>> Remember me
  		</label>
	</div>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <div id="login_message"></div>
</form>
<?	
	$this->template('login','bottom');
?>