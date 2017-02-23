$(document)

	.on('click','#runSQL',function() {
		var data = {
			sql: $('#sql').val()
		};
		$.post('/admin/lookup/ajax/run-sql',data,function(res) {
			$('#results').html(res);
		});
	})
	
;
