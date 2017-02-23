$(document)
	
	.on('click','.map-location',function() {
		
		var loc = $(this).attr('id').replace('location-','');
		$('.hidden-map:visible').fadeOut('fast');
		$('.map-location:not(:visible)').fadeIn('fast');
		$(this).fadeOut('fast');
		$('.hidden-number:visible').fadeOut('fast');
		$('#'+loc+',#votes-'+loc).fadeIn('fast');		
	})
	
	.on('click','.text-location',function() {
		
		var loc = $(this).text().toLowerCase();
		//console.log(loc);
		if ($('.text-box').is(':visible')) {
			$('.text-box:visible').fadeOut('fast',function(){
				$('#box-'+loc).fadeIn('fast');
			});
		}
		else $('#box-'+loc).fadeIn('fast');
		$('text-location.selected').removeClass('selected');
		$(this).addClass('selected');
		
	})