// JavaScript Document
var overlay = false;
var pagerActivated = false;

$(document)
	
	.ready(function() {
		if ($('#popup').val() == "0") {			
			setTimeout(function() {
				$.skybox("/pop-up");
			},1000);
		}

		if ($(window).width() < 1200) {
			$('.slides').css('height','auto');
		}

		$('.slides')
			.cycle({
				'timeout': 6000,
				'speed': 1000,
				'swipe': true,
				'swipe-fx': 'scrollHorz',
				'log': false,
				//fx: 'scrollHorz'
			})
			
			.on('cycle-after', function(event, optionHash, outgoingSlideEl, incomingSlideEl, forwardFlag){
				slug = incomingSlideEl.getAttribute('data-slug');
				ide = incomingSlideEl.getAttribute('data-ide');
				$('.votes').data('ide',ide);
				$('.voteLink').each(function(index, element) {
				    if ($(this).data('vote') == 'flirt') $(this).attr('href','/style-tips/'+slug);
					else if ($(this).data('vote') == 'skirt') $(this).attr('href','/shopping/'+slug+'?section=skirt');
					else if ($(this).data('vote') == 'marry') $(this).attr('href','/shopping/'+slug+'?section=marry');
                });
				$('#mainTrendTag').text(incomingSlideEl.getAttribute('data-tag'));
				$('#mainTrendDescription').html(incomingSlideEl.getAttribute('data-desc'));
				$('.trend-tag, .overlayTrend').text(incomingSlideEl.getAttribute('data-name'));
			})
			
			.on('cycle-pager-activated',function() {
				pagerActivated = true;
				$(this).cycle('pause');
			})
			
		;
	})	
	
	.on('mouseover','img.slide, #main-tag',function() {
		if ($(window).width() >= 1200) {
			$('#slideOverlay, #slideOverlayText').fadeIn('fast');
			$('#main-tag, .triangle-l').fadeOut('fast');
			$('.slides').cycle('pause');
		}
	})
	
	.on('mouseover','.surround, .cycle-pager',function() {
		if ($(window).width() >= 1200) {
			$('#slideOverlay, #slideOverlayText').fadeOut('fast');
			$('#main-tag, .triangle-l').fadeIn('fast');
			if (!pagerActivated) $('.slides').cycle('resume');
		}
	})
	
	.on('click','#more-posts',function(){
		num = $(this).data('num');
		length = $('.post-row.tempHide').length;
		$('.post-row.tempHide').each(function(index, element) {
			$(this).fadeIn('slow').removeClass('tempHide');
            if (index == num-1) return false;
			if (index == num-2 || index == length-1) $(this).css('border-bottom','none');
        });
		$('.goto-archive').fadeIn('fast');
		if (!$('.post-row.tempHide').length) $(this).parent().fadeOut('slow');
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

$(window).resize(function(){
	
	if ($(this).width() < 1200) {
		slideHeight = $('.slides').height();
		if ($('#slideOverlay').is(':visible')) {
			$('#slideOverlay, #slideOverlayText').fadeOut('slow');
			$('#main-tag, .triangle-l').fadeIn('slow');
			$('.slides').cycle('resume');
		}
		$('.slides').css('height','auto');
	}
	else {
		$('.slides').css('height','397px');
	}	
	
});