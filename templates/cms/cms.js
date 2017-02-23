// JavaScript Document
String.prototype.toSlug = function() {
	return this
		.replace(/\s+/g, '-')           // Replace spaces with -
		.replace(/[^\w\-]+/g, '')       // Remove all non-word chars
		.replace(/\-\-+/g, '-')         // Replace multiple - with single -
		.replace(/^-+/, '')             // Trim - from start of text
		.replace(/-+$/, '')
		.toLowerCase()
    ;
}

String.prototype.ucwords = function () {
return (this + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
        return $1.toUpperCase();
    });
}

$.fn.animateHighlight = function (highlightColor, duration) {
	var highlightBg = highlightColor || "#a5d1b4";
	var animateMs = duration || 1500; // edit is here
	var originalBg = this.css("background-color");

	if (!originalBg || originalBg == highlightBg)
		originalBg = "#FFFFFF"; // default to white

	jQuery(this)
		.css("backgroundColor", highlightBg)
		.animate({ backgroundColor: originalBg }, animateMs, null, function () {
			jQuery(this).css("backgroundColor", originalBg); 
		});
};

$(document)
	
	.ready(function() {
		
		$('.datetimepicker').datetimepicker({
			timeFormat: "hh:mm tt"
		});
		
		$('.datepicker').datepicker();
		
		setInterval(function() {
			$.post('/ajax/login-skybox/check-login',function(req) {
				if ($.trim(req) == 'logout') location.reload();
			});
		},30000);
		
	})
; // $(document)