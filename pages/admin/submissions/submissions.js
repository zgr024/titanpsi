var path = '/admin/submissions/';

$(document)
	
	.on('click','.delete',function() {
		$.confirm({
			title: 'Confirm Delete!',
			content: 'Are you sure you wish to delete this submission?',
			backgroundDismiss: false,
			icon: 'fa fa-warning',
			confirmButton: 'YES... Delete Submission',
			cancelButton: 'NO... Don\'t Delete',
			confirm: function(){
				$row = $(this).closest('tr');
				var ide = $row.attr('id');
				$.post(path+'ajax/delete-submission/'+ide,function(res) {
					if ($.trim(res) == 'success') $row.fadeOut('fast');
					else  {
						$.alert({
							title: 'Alert!',
							content: 'Comment not deleted!',
						});
					}
				});
			},
			cancel: function(){
				//alert('Canceled!')
			}
		});
		
	})
	
	.on('click','.view',function(){
		var $row = $(this).closest('tr');
		var ide = $row.attr('id');
		$row.removeClass('bold');
		$.dialog({
			title: 'Message',
			content: 'url:'+path+'skybox/profile/'+ide,
		});
	})
;