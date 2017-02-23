$('.table-responsive table')
	
	.on('click','a.delete',function() {
		ide = $(this).closest('tr').attr('id');
		$.confirm({
			title: 'Delete post?',
			content: 'Are you sure you want to delete this post?',
			confirmButton: 'YES',
	    	cancelButton: 'NO',
			autoClose: 'cancel|6000',
			confirm: function(){
				$.post('/admin/ajax/delete-post/'+ide,function(res){
					if ($.trim(res) == 'success') {
						$('#'+ide).fadeOut('fast');
					}
				});
			}			
		});
	})
;