$(document)

	.on('submit','form.form-register',function(e) {
		e.preventDefault();
		$('.invalid').removeClass('invalid');
		var full_name = $('input[name=fname]').val() + ' ' + $('input[name=lname]').val();
		$('input[name=full_name]').val(full_name);
		data = $(this).serialize();
		$.post('/admin/users/register/ajax/create-user', data, function(res) {
			if (res.success) {
				$('#message').html('User entered...');
				$('form.form-register input').val('');
			}
			else {
				$('#message').html(res.errorMsg);
				for (var i in res.highlight) {
					$('input[name='+res.highlight[i]+']').addClass('invalid');
				}
			}
		},'json');
	})
	
;