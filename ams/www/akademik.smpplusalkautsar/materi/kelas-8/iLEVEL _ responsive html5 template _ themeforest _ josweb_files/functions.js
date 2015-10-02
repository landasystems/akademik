	
 /***************************************************
	IMAGE HOVER EFFECTS
***************************************************/
<!--general hover--> 
$(window).load(function(){
$('[data-zlname = hover]').mateHover({
	position: 'x+i',
	overlayStyle: 'rolling',
	overlayBg:'#104C73',
	overlayOpacity: 0.9,
	overlayEasing: 'easeOutCirc',
	rollingPosition: 'bottom'
});

$('[data-zlname = port_hover]').mateHover({
	position: 'x+i-reverse',
	overlayStyle: 'double',
	doublePosition: 'vertical',
	overlayOpacity: 1,
	overlayBg: '#104C73'
});
	});
	
	/***************************************************
	ANIMATIONS
***************************************************/
$(function() { 	
$('.welcome').show().addClass("animated fadeInDown");
$('.welcome_index').show().addClass("animated fadeInDown");
$('.pricing-table').show().addClass("animated fadeInUp");
$('.tile').show().addClass("animated fadeInUp");
}); 