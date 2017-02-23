// JavaScript Document
$(function(){

	$('#most-similar').rotate(-10);
	$('#least-similar').rotate(10);
	
	if (getArgs('section') == 'skirt') {
		setTimeout(function() {
			$('body, html').animate({scrollTop: $('#skirtStart').position().top + 96});
		},300);
	}	
	
});

$('#body')
	
	.on('click','.vote-button',function(){
		var section = $(this).data('section');
		if (section == 'marry') $('body, html').animate({scrollTop:0});
		else if (section == 'skirt') $('body, html').animate({scrollTop: $('#skirtStart').position().top + 96});
		else if (section == 'flirt') window.location = '/style-tips/'+$('#blog_post_slug').val();
	})
	
; // $('#body')

function getArgs(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split('&');
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split('=');
        if (decodeURIComponent(pair[0]) == variable) {
            return decodeURIComponent(pair[1]);
        }
    }
    console.log('Query variable %s not found', variable);
}