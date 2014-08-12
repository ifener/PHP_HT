$(function(){
	$(".gear").click(function(){
		$(".pop,.exit").fadeIn();
	});
	
	$(".close").click(function(){
		$(".pop,.exit").fadeOut();
	});
});