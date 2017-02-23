<?php
	require "lib/twitteroauth/autoload.php";

	use Abraham\TwitterOAuth\TwitterOAuth;
	
	$this->template('html5','top');
		
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token, $access_token_secret);
	$content = $connection->get("account/verify_credentials");
	
	$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
	
	$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
	
	$_SESSION['return_to_page'] = $_GET['page'];
	$_SESSION['oauth_token'] = $request_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
?>
	<script>window.open('<?=$url?>');</script>
<?php
	$this->template('html5','bottom');