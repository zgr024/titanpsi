    // login
    $('#login_username:visible').livequery(function(){
        $(this).focus();
    });
    $('#skybox').on('keyup','#login_password',function(e){
        if(e.which == 13 ){
			e.preventDefault();
            $('#login-button').trigger('click');
        }
    });
	
	$('#skybox').on('submit','form.form-signin',function(e) {
		e.preventDefault();
		var data = $(this).serialize();
        $.post('/ajax/login-skybox/authenticate', data, function(req){
                if (req=='success') {
                    var url = window.location.href;
                    if (navigator.appName=="Microsoft Internet Explorer") {
						url = url.substr(0,url.indexOf('#'));
						url = removeParam('skybox',url);
                    	url = removeParam('logout',url);
						window.location.href = url;
					}
					else {
						url = removeParam('skybox',url);
                    	url = removeParam('logout',url);					
						window.location.href = url;
					}
                } else {
                    if (data=='error') {
                        $('#login_message').html('Incorrect login.  Try again.');
                    } else if (data.indexOf('Unable to bind to server')) {
						$('#login_message').html('Incorrect login.  Try again.');
					} else {
                        $('#login_message').html(data);
                    }
                    if ( $('#login_message').is(':visible') ) $('#login_message').fadeTo('fast',1);
                    else $('#login_message').slideDown('fast');
                    $('#login_password').val('');
                    $('#login-button').attr('src','/images/login.png');
                    if ( $('#login_username').val() == '' ) $('#login_username').focus();
                    else $('#login_password').focus();
                }
            }
        );
        return false;
	});
	$('#customerFacingLogin').livequery('click',function() {
		$('#login-button').trigger('click');
	});