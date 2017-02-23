<?php
	require "lib/twitteroauth/autoload.php";

	use Abraham\TwitterOAuth\TwitterOAuth;
	
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token, $access_token_secret);
	$content = $connection->get("account/verify_credentials");
	
	$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
	
	$twitterUrl = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
	$_SESSION['return_to_page'] = IDE . '?comments';
	$_SESSION['oauth_token'] = $request_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

	$this->css[] = '/lib/bootstrap-3.3.2-dist/css/social-buttons.css';
	$this->template('social-skybox','top');
?>
	<a class="btn btn-block btn-social btn-facebook">
      <i class="fa fa-facebook"></i>
      Sign in with Facebook
    </a>
    <a href="<?=$twitterUrl?>" class="btn btn-block btn-social btn-twitter">
      <i class="fa fa-twitter"></i>
      Sign in with Twitter
    </a>
    <a class="btn btn-block btn-social btn-google-plus" id="google-sign-in">
      <i class="fa fa-google"></i>
      Sign in with Google
    </a>
	<a class="no-social">Don't Sign Me In... Just Let Me Comment</a>
<?php
	$this->template('skybox','bottom');