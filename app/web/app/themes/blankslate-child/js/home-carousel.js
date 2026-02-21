/**
 * Home Carousel - Owl Carousel 2 Initialization
 */

jQuery(document).ready(function($) {
'use strict';

console.log('🔍 home-carousel.js cargado');

// Home Image Carousel
if ($('.home-image-carousel').length) {
console.log('✓ Inicializando image carousel');
$('.home-image-carousel').owlCarousel({
items: 1,
loop: true,
nav: true,
dots: false,
autoplay: true,
autoplayTimeout: 3000,
autoplayHoverPause: true,
navText: [
'<i class="fas fa-chevron-left"></i>',
'<i class="fas fa-chevron-right"></i>'
],
responsive: {
0: {
items: 1
},
768: {
items: 1
},
1024: {
items: 1
}
}
});
}

// Home Brands Carousel
if ($('.home-brands-carousel').length) {
console.log('✓ Inicializando brands carousel');
$('.home-brands-carousel').owlCarousel({
items: 6,
slideBy: 6,
loop: true,
nav: true,
dots: false,
autoplay: true,
autoplayTimeout: 3000,
autoplayHoverPause: true,
navText: [
'<i class="fas fa-chevron-left"></i>',
'<i class="fas fa-chevron-right"></i>'
],
responsive: {
0: {
items: 2,
slideBy: 2
},
768: {
items: 4,
slideBy: 4
},
1024: {
items: 6,
slideBy: 6
}
}
});
}

// Home Products Carousel
if ($('.home-products-carousel').length) {
console.log('✓ Inicializando products carousel');
$('.home-products-carousel').owlCarousel({
items: 5,
margin: 15,
loop: true,
nav: true,
dots: false,
autoplay: true,
autoplayTimeout: 3000,
autoplayHoverPause: true,
navText: [
'<i class="fas fa-chevron-left"></i>',
'<i class="fas fa-chevron-right"></i>'
],
responsive: {
0: {
items: 2,
margin: 15
},
768: {
items: 3,
margin: 15
},
1024: {
items: 5,
margin: 15
}
}
});
}

// Home Parts Carousel
if ($('.home-parts-carousel').length) {
	console.log('✓ Inicializando parts carousel');
	$('.home-parts-carousel').owlCarousel({
		items: 7,
		loop: true,
		nav: true,
		dots: false,
		autoplay: true,
		autoplayTimeout: 3000,
		autoplayHoverPause: true,
		navText: [
			'<i class="fas fa-chevron-left"></i>',
			'<i class="fas fa-chevron-right"></i>'
		],
		responsive: {
			0: {
				items: 2
			},
			768: {
				items: 7
			}
		}
	});
}

});
