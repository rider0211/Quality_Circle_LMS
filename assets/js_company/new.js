$(document).ready(function() {
    $('#myCarouse2').carousel({
	    interval: 10000
	})
});


 
jQuery(document).ready(function() {
 
 
 
jQuery('.carousel[data-type="multi"] .item').each(function(){
 
var next = jQuery(this).next();
 
if (!next.length) {
 
next = jQuery(this).siblings(':first');
 
}
 
next.children(':first-child').clone().appendTo(jQuery(this));
 
 
 
for (var i=0;i<2;i++) {
 
next=next.next();
 
if (!next.length) {
 
next = jQuery(this).siblings(':first');
 
}
 
next.children(':first-child').clone().appendTo($(this));
 
}
 
});
 
 
 
});
 
