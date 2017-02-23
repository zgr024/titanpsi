// JavaScript Document
$(document)
	
	.ready(function() {
		if (location.hash == '#contact') {
			setTimeout(function(){
				$('a#goto-contact').trigger('click');
			},300);
		}
	})
	
	.on('click','a#goto-contact',function(e) {
		e.preventDefault();
		$('html,body').animate({scrollTop: $('form#contact-us').position().top });
	})
	
	.on('click','#submit span',function() {
		if ($(this).hasClass('clicked')) return false;
		$('#saveMessage').html('').removeClass('aql_error').removeClass('aql_saved');
		var valid = true;
		$('#contact-us [required]').each(function(index, element) {
            if (!$(this).val()) {
				valid = false;
				$(this).addClass('invalid');
			}
			else $(this).removeClass('invalid');
        });
		
		if (!valid) {
			$('#saveMessage').html('All fields are required').addClass('aql_error');
			return false;
		}
		$(this).addClass('clicked');
		$.post("/about/ajax/save",$('#contact-us').serialize(),function(res) {
			if (res.success) {
				$('form#contact-us')[0].reset();
				$('#form-submitted').fadeIn('fast');
				$('#submit span').removeClass('clicked');				
			}
			else {
				$('#saveMessage').html('There was an error submitting the form.').addClass('aql_error');
				$('#submit span').removeClass('clicked');
			}
		},'json');
	})
	
	.on('click',function(){
		if ($('#form-submitted').is(':visible')) $('#form-submitted').fadeOut('fast');
	})
;