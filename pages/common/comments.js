var session = {},
	keys = {
		facebook: 669836156455972,
		twitter: 'J3zB5DtaChH1OhIsesdmqON6K',
		google: '261152422833-o56e3spu9glj8fenkspgo091rd37jb86.apps.googleusercontent.com'
	},
	noSocial = false,
	auth2, // The Google Sign-In object
	googleUser,
	loginState = false; // The current Google user

$(document)
	.ready(function() {
		
		
		/*** START GOOGLE ***/
		
		$('#google-sign-in').livequery(function(){
			auth2.attachClickHandler(document.getElementById('google-sign-in'), {},
				function(googleUser) {
					var profile = auth2.currentUser.get().getBasicProfile();
					session.id = profile.getId();
					$('#comment-name').val(profile.getName());
					$('input[name=photo_uri]').val(profile.getImageUrl());
					$('input[name=email]').val(profile.getEmail());
					$('input[name=google_uid]').val(profile.getId());
					$('#comment-profile').html('You are signed in with Google <a id="sign-out" class="pull-right" data-social="google">sign out</a>');
					
					history.back();
				}, function(error) {
					alert(JSON.stringify(error, undefined, 2));
				}
			);
		})
		
		var appStart = function() {
		  gapi.load('auth2', initSigninV2);
		};
		
		var initSigninV2 = function() {
			auth2 = gapi.auth2.init({
				client_id: keys.google,
				scope: 'profile'
			});
		
			// Listen for sign-in state changes.
			auth2.isSignedIn.listen(signinChanged);
			
			// Listen for changes to current user.
			auth2.currentUser.listen(userChanged);
			
			  // Sign in the user if they are currently signed in.
			if (auth2.isSignedIn.get() == true) { 
				auth2.signIn();
				loginState = true;
			}
			
			  // Start with the current live values.
			refreshValues();
		};
		
		var signinChanged = function (val) {
			if (val == false) {
				//console.log('Signin state changed to ', val);
				$('#comment-profile').html('You have been logged out. <a class="sign-in pull-right" skybox="true">sign in</a>');
				$('form#comments input').val('');
				session = {};
			}
			else {
				FB.logout(function(response) {
					// Log out of facebook if logged in
				});
			}
			
		};
		
		var userChanged = function (user) {
			//console.log('User now: ', user);
			googleUser = user;
			updateGoogleUser();
		};
		
		var updateGoogleUser = function () {
			//console.log(googleUser);
			var profile = auth2.currentUser.get().getBasicProfile();
			
			if (profile) {
				$('#comment-name').val(profile.getName());
				$('input[name=google_uid]').val(profile.getId());
				$('input[name=photo_uri]').val(profile.getImageUrl());
				$('input[name=email]').val(profile.getEmail());
				$('input[name=google_uid]').val(profile.getId());
				$('#comment-profile').html('You are signed in with Google <a id="sign-out" class="pull-right" data-social="google">sign out</a>');
				session.id = profile.getId();
			}
					  
		};
		
		/**
		 * Retrieves the current user and signed in states from the GoogleAuth
		 * object.
		 */
		var refreshValues = function() {
		  if (auth2){
			//console.log('Refreshing values...');
			updateGoogleUser();
		  }
		}
		
		appStart();
		
		/*** END GOOGLE ***/
		
		if ($('input[name=noSocial]').val() == '1') noSocial = true;
		
		if ($('input[name=twit_uid]').val()) {
			session.id = $('#twit_uid').val();
		}
		
		if (location.search == '?comments') $('html, body').animate({scrollTop: $('#comments').position().top});
		
		window.fbAsyncInit = function() {
			FB.init({
			  appId      : keys.facebook,
			  xfbml      : true,
			  version    : 'v2.3'
			});
		
			FB.getLoginStatus(function(response) {
				statusChangeCallback(response);
			});
		};
				
	})  
	
	.on('click','.btn-facebook',function(){
		
		FB.login(function(response){
			//console.log(response);
			FB.getLoginStatus(function(response) {
				statusChangeCallback(response);
			});
		},{scope: 'public_profile,email'});
		
	})
	
	.on('focus','#comments input, #comments textarea',function(){
		if (!session.id && !noSocial && !$('input[name=twit_uid]').val()) $.skybox('/social-sign-in'+location.pathname);
	})
	
	.on('click','.sign-in',function(){
		$.skybox('/social-sign-in'+location.pathname);
	})
	
	.on('click','#sign-out',function(){
		switch ($(this).data('social')) {
			case 'google':
				var auth2 = gapi.auth2.getAuthInstance();
				auth2.signOut();
				break;
			case 'facebook':
				FB.logout(function(response) {
					$('#comment-profile').html('You have been logged out. <a class="sign-in pull-right" skybox="true">sign in</a>');
					$('form#comments input').val('');
					FB.getLoginStatus(function(response) {
						statusChangeCallback(response);
					});
				});
				break;
			case 'twitter':
				$.post('/common/ajax/twitter-logout',function(){
					$('#comment-profile').html('You have been logged out. <a class="sign-in pull-right" skybox="true">sign in</a>');
				    $('form#comments input').val('');
					session = {};
				});
				
		}
	})
	
	.on('click','#post-comment',function() {
		if ($(this).hasClass('clicked')) return false;
		$('#saveMessage').html('').removeClass('aql_error').removeClass('aql_saved');
		var valid = true;
		$('#comments [required]').each(function(index, element) {
			if (!$(this).val()) {
				valid = false;
				$(this).addClass('invalid');
			}
			else $(this).removeClass('invalid');
		});
		
		if (!valid) {
			$('#saveMessage').html('Name &amp; Message are required').addClass('aql_error');
			return false;
		}
		$(this).addClass('clicked');
		$.post("/common/ajax/save-comment",$('#comments').serialize(),function(res) {
			if (res.success) {
				$('#message').val('');
				$('#form-submitted').fadeIn('fast');
				$('#post-comment').removeClass('clicked');				
			}
			else {
				$('#saveMessage').html('There was an error submitting the form.').addClass('aql_error');
				$('#post-comment').removeClass('clicked');
			}
		},'json');
	})
	
	.on('click',function(){
		if ($('#form-submitted').is(':visible')) $('#form-submitted').fadeOut('fast');
	})
;

$('#skybox')
	.on('click','.no-social',function() {
		noSocial = true;
		$.post('/common/ajax/let-me-comment',function(){
			$('#comment-profile').html('I changed my mind. I want to <a class="sign-in" skybox="true">sign in.</a>');
			history.back();
		});
	})
;

function statusChangeCallback(response) {
			//console.log('statusChangeCallback');
			//console.log(response);
			// The response object is returned with a status field that lets the
			// app know the current login status of the person.
			// Full docs on the response object can be found in the documentation
			// for FB.getLoginStatus().
			console.log(response);
			if (response.status === 'connected') {
				//console.log('Logged into your app and Facebook.');
				saveSession();
			} else if (response.status === 'not_authorized') {
				// The person is logged into Facebook, but not your app.
				//console.log('Please log into this app.');
				session = {};
			} else {
				// The person is not logged into Facebook, so we're not sure if
				// they are logged into this app or not.
				//console.log('Please log into Facebook.');
				session = {};
			}
		}
		
		function checkLoginState() {
			FB.getLoginStatus(function(response) {
				statusChangeCallback(response);
			});
		}
		
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = '//connect.facebook.net/en_US/sdk.js';
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
			
		// Here we run a very simple test of the Graph API after login is
		// successful.  See statusChangeCallback() for when this call is made.
		function saveSession() {
			//console.log('Welcome!  Fetching your information.... ');
			FB.api('/me', function(response) {
				//console.log('Successful login for: ' + response.name);
				//console.log(response);
				session = response;
				//console.log(session);
				$('#comment-name').val(session.first_name);
				$('#comment-profile').html('You are signed in with Facebook <a id="sign-out" class="pull-right" data-social="facebook">sign out</a>');
				$('input[name=fb_uid]').val(session.id);
				if ($('#skybox').is(':visible')) history.back();
			});
		}