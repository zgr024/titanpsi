// JavaScript Document
$(document)
	.on('click','#more-posts',function(){
		num = $(this).data('num');
		length = $('.post-row.tempHide').length;
		$('.row.more').each(function(index, element) {
			$(this).fadeIn('slow').removeClass('more');
            if (index == num-1) return false;
			if (index == num-2 || index == length-1) $(this).css('border-bottom','none');
        });
		
		if (!$('.more').length) $(this).parent().fadeOut('slow');
		if ($(window).width() > 992) {
		
			if ($('#instagram').position().top + $(window).height() - 500 > $(window).height()) {
				$('.blog-sidebar').addClass('sidebar-fixed').css({top:$(window).height() - $('.blog-sidebar').height() + 250});
				 
				if ($(window).scrollTop() + $(window).height() > $(body).height() - 530) {
					$('.sidebar-fixed').removeClass('sidebar-fixed').addClass('sidebar-abs').css('top',$('body').height() - 1675);
				}
				else $('.sidebar-fixed').removeClass('sidebar-abs').addClass('sidebar-fixed').css({top:$(window).height() - $('.blog-sidebar').height() + 250});
			}
			else $('.blog-sidebar').removeClass('sidebar-fixed').css({top:0});
		} 
		else {
			
			/*$('.blog-sidebar').height($('.blog-main').height()+62);*/
			
		}
	})
;