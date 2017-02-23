<?php
	if ($_GET['denied']) redirect('/'.$_SESSION['return_to_page']);
	require "lib/twitteroauth/autoload.php";

	use Abraham\TwitterOAuth\TwitterOAuth;

	$_SESSION['oauth_token'] = $_GET['oauth_token'];
	$_SESSION['oauth_verifier'] = $_GET['oauth_verifier'];
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_GET['oauth_token'], $_SESSION['oauth_token_secret']);
	$access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_GET['oauth_verifier']));
	$_SESSION['access_token'] = $access_token;
	//print_a($_SESSION);
	redirect('/'.$_SESSION['return_to_page']);