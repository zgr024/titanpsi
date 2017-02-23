/*
 * Author: Zach Rosenberg
 * Website: http://zrosenberg.com
 * File: default.js
 * Version: 1.0
 * Usage: JavaScript file for default (home) page, utilizes stellar.js
 */

$(document)
	
	.ready(function (){
    
		// responsive formatting based on window width
		if ($(window).width() >= 1000) {
			$('#body').addClass('r1000');
		} else {
			$('#body').addClass('r500');
		}
		
		// prevent flash of unstyled text
		$('#body').show();
	
		// start the slideshow
		$('.cycle-slideshow').show();
	
	
		// disable parallax on mobile devices
		if(!Modernizr.touch){ 
			$.stellar({ 
				horizontalScrolling: false 
			});
		}
	
		// force android chrome to fix the background hidden overflow
		//$('html').width(screen.width);
	
	
		// on scroll
		var top = $('#home').outerHeight();
		// the placeholder appears when the nav snaps to the top to preserve the window height
		$('#nav-placeholder').height($('nav').outerHeight());    
		$(window).scroll(function (event) {
	
			debug();
	
			var y = $(this).scrollTop();
			if (y >= top) {
				$('nav.fixable').addClass('fixed');
				$('#nav-placeholder').show();
			} else {
				$('nav.fixable').removeClass('fixed');
				$('#nav-placeholder').hide();
			}
		})
		
		 // on window resize
		$(window).resize(function() {
			var w = $(this).width();
			if (w <= 1000) {
				$('#body').removeClass('r1000').addClass('r500');
			} else {
				$('#body').removeClass('r500').addClass('r1000');
			}
		});
	
	
		// on device rotate
		jQuery(window).bind('orientationchange', function(e) {
			debug();
		});
	})

	     // on nav click
	.on('click', 'a', function(){
		
		var label = $(this).attr('href').replace('#','');

		// Send event to analytics
		ga('send', {
		  'hitType': 'event',            // Required.
		  'eventCategory': 'link',      // Required.
		  'eventAction': 'click',      // Required.
		  'eventLabel': label,
		});
		
		// compensation since the anchors are not scrolling to the correct spot
		var anchor_offset = 50;

		// only hijack this click if this hyperlink is a named anchor
		var chr = $.attr(this, 'href').substr(0,1);
		if (chr != '#') {
			return true;
		}
		var anchor = $.attr(this, 'href').substr(1);
		var aTag = $("#" + anchor);
		var y = aTag.offset().top - anchor_offset;
		
		// don't compensate for home
		if (y < 0) y = 0;

		$('html,body').animate({scrollTop: y},'slow');
		return false;
	})

;

function debug() {
    $('#debug').html(
        'win-w: ' + $(window).width() + ', ' +
        'html-w: ' + $('html').width() + ', ' +
        'doc-w: ' + $(document).width() + ', ' +
        'doc-h: ' + $(document).height() + ', ' +
        'o: ' + window.orientation
    );
}

// function isPortrait() {
//     if (window.orientation == 90 || window.orientation == -90) {
//         return false;
//     }
//     return true;
// }

// // mobile phone width hack
// function fixWidth() {
//     return;
//     if (   
//            $(window).width() == 360 // galaxy s3 portrait
//         || $(window).width() == 480 // iphone 4 landscape
//         || $(window).width() == 320 // iphone 4 portrait
//     ) {
//         $('html').width($(document).width());
//     } else {
//         $('html').width($(window).width());
//     }
// }


