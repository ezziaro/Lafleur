// Elements :
(function($){
	
	
	
// Variables
var rectangle= $('#apDiv0');


//TimelneLite
var tl = new TimelineLite();

$('#apDiv1').click(function(){
	tl.to(rectangle, 5, {opacity:1});
});



})(jQuery);