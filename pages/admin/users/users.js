// JavaScript Document
$(document)
	
	.on('click','.delete',function() {
		$.confirm({
			title: 'Confirm Delete!',
			content: 'Are you sure you wish to delete this user?',
			backgroundDismiss: false,
			icon: 'fa fa-warning',
			confirmButton: 'YES... Delete User',
			cancelButton: 'NO... Don\'t Delete',
			confirm: function(){
				$row = $(this).closest('tr');
				var ide = $row.attr('id');
				$.post('/admin/users/ajax/delete-user/'+ide,function(res){
					if ($.trim(res) == 'success') $row.fadeOut('fast');
					else if ($.trim(res) == 'self') {
						$.alert({
							title: 'Alert!',
							content: 'You cannot delete yourself!',
						});
					}
					else  {
						$.alert({
							title: 'Alert!',
							content: 'User not deleted!',
						});
					}
				});
			},
			cancel: function(){
				//alert('Canceled!')
			}
		});
		
		
	})