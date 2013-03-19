/* Author: John Cobb | johncobb.name | @john0514 */

jQuery(document).ready(function($) {

	$("#feature-slideshow").bjqs({
		'height': 228,
		'width': 1000,
		'centerMarkers': false,
		'centerControls': false,
		'animation': 'slide',
		'animationDuration': 500,
		'rotationSpeed': 5000,
		'nextText': '<i class="icon-chevron-right icon-white"></i>',
		'prevText': '<i class="icon-chevron-left icon-white"></i>'
	});

	$("#fade-example").bjqs({
		'height' : 228,
		'width' : 1000,
		'animationDuration' : 1200,
		'showMarkers' : false,
		'centerControls' :true,
		'nextText': '<i class="icon-chevron-right icon-white"></i>',
		'prevText': '<i class="icon-chevron-left icon-white"></i>',
		'useCaptions' : false,
		'keyboardNav' : false
	});

	$("#slide-example").bjqs({
		'height' : 228,
		'width' : 1000,
		'animation' : 'slide',
		'animationDuration' : 200,
		'centerMarkers' : false,
		'centerControls' :false,
		'nextText': '</i>',
		'prevText': '</i>',
		'useCaptions' : true,
		'keyboardNav' : true
	});


});
