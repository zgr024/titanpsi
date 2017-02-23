$('#body')
	
	.on('click','.vote-button',function(){
		var section = $(this).data('section');
		if (section == 'marry') window.location = '/shopping/'+$('#blog_post_slug').val();
		else if (section == 'skirt') window.location = '/shopping/'+$('#blog_post_slug').val()+'?section=skirt';
	})
	
; // $('#body')
