$(document)

	.on('submit','form.form-user',function(e) {
		e.preventDefault();
		$('.invalid').removeClass('invalid');
		var full_name = $('input[name=fname]').val() + ' ' + $('input[name=lname]').val();
		$('input[name=full_name]').val(full_name);
		data = $(this).serialize();
		$('#message').removeClass('aql_saved').removeClass('aql_error').html('Saving...');
		$.post('/admin/users/edit/ajax/save-user', data, function(res) {
			if (res.success) {
				$('#message').html('User updated...').addClass('aql_saved');
			}
			else {
				$('#message').html(res.errorMsg).addClass('aql_error');
				for (var i in res.highlight) {
					$('input[name='+res.highlight[i]+']').addClass('invalid');
				}
			}
		},'json');
	})
	
;