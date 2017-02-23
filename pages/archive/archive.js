// JavaScript Document
$(function(){
	
	var article = $('#scroll-to').val();
	setTimeout(function() {
		$('body, html').animate({scrollTop: $('#article_'+article).position().top + 200},'slow');
	},300);
});