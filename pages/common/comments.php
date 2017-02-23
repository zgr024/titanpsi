<?php

	require "lib/twitteroauth/autoload.php";

	use Abraham\TwitterOAuth\TwitterOAuth;
	$creds = array(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
	//print_a($creds);

	if ($_SESSION['access_token']) {
		$access_token = $_SESSION['access_token'];
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
	
		$user = $connection->get("account/verify_credentials");
		
		$twitterID = $user->id;
		$name = $user->name;
		$photo_uri = $user->profile_image_url;		
	}
?>

<div class="row comments">
    <div class="col-md-12">
        <h3><span>WHATCHA THINKING?</span></h3>
<?php
	if ($commentSettings['type'] == 'blog_post') {
		$comments = $post->comments;
	} else {
		
	}
    if ($comments) foreach ($comments as $comment) {
		if ($comment->status != 1 || $comment->category != $commentSettings['category']) continue;
?>            
        <div class="row comment">
            <div class="col-md-2 pic"><img src="<?=$comment->photo_uri?$comment->photo_uri:'/images/temp/comment-pic.png'?>" class="img-responsive"></div>
            <div class="col-md-10">
                <p class="commentor"><?=strtoupper($comment->full_name)?> SAYS</p>
                <p class="comment-text"><?=$comment->message?></p>
                <p class="comment-date"><?=date('j M Y g:i A',strtotime($comment->insert_time))?></p>
            </div>
        </div>
<?php
    }
?>
    </div>
</div>
<form id="comments">
	<input type="hidden" name="ide" value="<?=$commentSettings['ide']?>">
    <input type="hidden" name="type" value="<?=$commentSettings['type']?>">
    <input type="hidden" name="category" value="<?=$commentSettings['category']?>">
	<input type="hidden" name="noSocial" value="<?=$_SESSION['noSocial']?$_SESSION['noSocial']:0?>">
	<input type="hidden" name="fb_uid">
	<input type="hidden" name="twit_uid" value="<?=$twitterID?>">
    <input type="hidden" name="google_uid">
    <input type="hidden" name="photo_uri" value="<?=$photo_uri?>">
    <div class="row">
    	<div class="col-md-10 col-md-offset-1" id="comment-profile"><?=$twitterID?'You are signed in with Twitter <a id="sign-out" class="pull-right" data-social="twitter">sign out</a>':''?></div>
    </div>
    <div class="row">
        <div class="col-md-5 col-md-offset-1">
            <div class="form-group">
                <label for="comment-name">NAME</label>
                <input type="text" class="form-control" name="full_name" id="comment-name" value="<?=$name?>" required placeholder="required">
            </div>
            <div class="form-group">
                <label for="email">EMAIL</label>
                <input type="text" class="form-control" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="website">WEBSITE</label>
                <input type="text" class="form-control" name="website" id="website">
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="message">MESSAGE</label>
                <textarea class="form-control" name="message" id="message" required placeholder="required"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-11">
            <div id="post-comment" class="pull-right"><span>POST COMMENT</span></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1 text-center">
            <div id="saveMessage"></div>
        </div>
    </div>
    <img id="form-submitted" src="/images/icons/form-submitted.png" class="img-responsive"></form>
</form>