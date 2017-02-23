// JavaScript Document
var votes = [];
$(document)

	.ready(function() {

        var popup = parseInt(getCookie('popup'));
        var sidebarSrollPoint = $('#sidebarValue').val()=='regular'?254:400;

        sidebarSrollPoint = $(window).height() - sidebarSrollPoint;
		
        if ((isNaN(popup) || !popup) && window.location.pathname == '/' && $(window).width() > 992) {
            setTimeout(function() {
                showPopup();
            },3000);
        }
		
		if ($(window).width() > 992) $(window).scroll();


		if ($('.blog-sidebar').height() < $('.blog-main').height()) {
			//console.log($('.blog-main').height());
			setTimeout(function(){
				$('.blog-sidebar').height($('.blog-main').height()+62);
			},300);
			
		}

		var scrolled = false;
		$(window).scroll(function() {
			if (typeof($('.blog-sidebar')) == 'undefined' || $(window).width() <= 992 && !scrolled) return false;
			
			scrolled = true;
			var instagramHeight = $('.instaDesktop a img').height();
			if ($('#instagram').position().top + $(window).height() - (700 + instagramHeight) > $(window).height()) {
 
				if ($(window).scrollTop() + $(window).height() > $(body).height() - instagramHeight - 10) {
					$('.blog-sidebar').removeClass('sidebar-fixed').addClass('sidebar-abs').css('top',$('body').height() - instagramHeight - 1654);
				}
				else $('.blog-sidebar').removeClass('sidebar-abs').addClass('sidebar-fixed').css({top:$(window).height() - ($('.blog-sidebar').height() + instagramHeight - 193)});

			}
			else $('.blog-sidebar').removeClass('sidebar-fixed').removeClass('sidebar-abs').css({top:0});
		});
		
	})

	
	
	.on('click', 'a', function(){

        // ignore voteLink and popupClose
		if ($(this).hasClass('voteLink') || $(this).hasClass('popupClose')) return true;

        var label = $(this).attr('href');

        // ignore if no href
        if (!label) return false;

        // Send event to analytics
        ga('send', {
          'hitType': 'event',            // Required.
          'eventCategory': 'link', 		// Required.
          'eventAction': 'click',      // Required.
          'eventLabel': label
        });

	})

    .on('change','input#dont-show',function() {
        setCookie('popup',1,365);
        closePopup();
    })

	.on('click','.overlayLink',function(e){
		var vote = $(this).data('vote');
		$('.voteLink.'+vote).trigger('click');
	})	
	
	.on('click','.voteLink',function(e) {
		e.preventDefault();
		data = {
			vote: $(this).data('vote'),
			href: $(this).attr('href'),
			ide: $(this).parent().data('ide')
		};
		
		var arr = data.href.split('/');
		var label = arr[arr.length-1].replaceAll('-',' ').ucWords();
		
		ga('send', {
		  'hitType': 'event',            // Required.
		  'eventCategory': data.vote,   // Required.
		  'eventAction': 'click',      // Required.
		  'eventLabel': label,
		});
		
		$.post('/ajax/vote',data);
		window.location.href = data.href;
		
	})

    .on('click','.closePopup',function () {
        closePopup();
    })
	
	.on('mouseover mouseout','.social-header .icon-container a img, footer .connect a img',function(e) {
		if (e.type == 'mouseover') {
			var src = $(this).attr('src').replace('.png','-on.png');
			$(this).attr('src',src);
		}
		else if (e.type == 'mouseout') {
			var src = $(this).attr('src').replace('-on.png','.png');
			$(this).attr('src',src);
		}
	})
	
	.on('mouseover mouseout','.social a img',function(e) {
		if (e.type == 'mouseover') {
			var src = $(this).attr('src').replace('.png','-on.png');
			$(this).attr('src',src);
		}
		else if (e.type == 'mouseout') {
			var src = $(this).attr('src').replace('-on.png','.png');
			$(this).attr('src',src);
		}
	})	
	
	.on('click','.search-header .search-button',function() {
		if ($('.search-header .search-text').is(':visible')) {
			var val = $('.search-header .search-text').val();
			if (val.length) location.href = '/search?q='+val;
			else $('.search-header .search-text').focus();
		}
		else {
			$('.search-header .tempHide').fadeIn('slow',function() {
				$('.search-header .search-text').focus();
			});			
		}
	})
	
	.on('keyup','.search-header .search-text',function(e) {
		if (e.which == 13) $('.search-header .search-button').trigger('click');
	})
	
	.on('click','.insta-click',function(){
		$('#instagram a:visible').trigger('click');
	})
	
	.on('click','.next-prev img',function() {
		$(this).siblings('a').trigger('click');
	})
;

// "string".replaceAll(find,replace)
String.prototype.replaceAll = function(f, r){
	return this.replace(new RegExp(f, 'g'), r);
}

// "string".ucWords()
String.prototype.ucWords = function () {
return (this + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
        return $1.toUpperCase();
    });
}

function showPopup() {
    $('#overlay').show();
    $('#howToPopup').show(600);
}

function closePopup() {
    $('#overlay').hide();
    $('#howToPopup').hide(600);

    if ($('.slides').is(':visible')) startDefaultSlideShow();
}

function startDefaultSlideShow() {
    var voting = true;
    $('.slides')
        .cycle({
            'timeout': 6000,
            'speed': 1000,
            'swipe': true,
            'swipe-fx': 'scrollHorz',
            'log': false,
            //fx: 'scrollHorz'
        })

        .on('cycle-after', function (event, optionHash, outgoingSlideEl, incomingSlideEl, forwardFlag) {
            slug = incomingSlideEl.getAttribute('data-slug');
            ide = incomingSlideEl.getAttribute('data-ide');

            voting = true;
            /*
            if (parseInt(incomingSlideEl.getAttribute('data-index')) == 0) {
                $('.overlay-off').fadeOut(100);
                $('#slideOverlay').animate({opacity: 0.7});
                $('.overlay-on').fadeIn(100);
                voting = true;
            }
            else if (parseInt(incomingSlideEl.getAttribute('data-index')) > 0 && voting === true) {
                $('.overlay-on').fadeOut(100);
                $('#slideOverlay').animate({opacity: 0});
                $('.overlay-off').fadeIn(100);
                $('#main-tag, .triangle-l').fadeIn('fast');
                voting = false;
            }

			*/
            $('.mainTrendTag').text(incomingSlideEl.getAttribute('data-tag').toUpperCase());
            $('.mainTrendDescription').html(incomingSlideEl.getAttribute('data-desc'));
            $('.trend-tag, .overlayTrend').text(incomingSlideEl.getAttribute('data-name'));
            $('.main-tag-category').text(incomingSlideEl.getAttribute('data-category'));
			$('.votes').find('a').each(function() {
				if ($(this).hasClass('flirt')) {
					$(this).attr('href','/style-tips/' + slug);
				} else if ($(this).hasClass('skirt')) {
					$(this).attr('href','/shopping/' + slug + '?section=skirt');
				} else if ($(this).hasClass('marry')) {
					$(this).attr('href','/shopping/' + slug + '?section=marry');
				}
			});

        })

        .on('cycle-pager-activated', function () {
            pagerActivated = true;
            $(this).cycle('pause');
        })

        .on('click', 'img.slide', function () {
            if ($(this).data('url')) window.location = $(this).data('url');
        })
    ;
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}