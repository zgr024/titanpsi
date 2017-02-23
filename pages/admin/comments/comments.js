$(document)
	
	.on('click','.delete',function() {
		$.confirm({
			title: 'Confirm Delete!',
			content: 'Are you sure you wish to delete this comment?',
			backgroundDismiss: false,
			icon: 'fa fa-warning',
			confirmButton: 'YES... Delete Comment',
			cancelButton: 'NO... Don\'t Delete',
			confirm: function(){
				$row = $(this).closest('tr');
				var ide = $row.attr('id');
				$.post('/admin/comments/ajax/delete-comments/'+ide,function(res) {
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
	
	.on('change','.status',function(){
		$row = $(this).closest('tr');
		text = $row.find('select.status option:selected').text();
		var val = $(this).val();
		var ide = $row.attr('id');
		$.post('/admin/comments/ajax/update-status/'+ide,{ status: val },function(res) {
			if ($.trim(res) == 'success') {
				$.alert({
					title: 'Saved!',
					autoClose: 'confirm|3000',
					content: 'Status Changed to '+text+'!',
				});
			}
			else  {
				$.alert({
					title: 'Alert!',
					content: 'Status not Saved!',
				});
			}
		});
	})
;