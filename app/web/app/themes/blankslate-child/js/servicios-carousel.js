(function($) {
	$(document).ready(function() {
		var $carousel = $('.servicios-carousel');

		if (!$carousel.length || typeof $.fn.owlCarousel !== 'function') {
			return;
		}

		$carousel.owlCarousel({
			items: 1,
			loop: true,
			nav: true,
			dots: true,
			margin: 0,
			autoplay: true,
			autoplayTimeout: 3000,
			autoplayHoverPause: true,
			navText: [
				'<span class="servicios-owl-nav"><i class="fas fa-chevron-left"></i></span>',
				'<span class="servicios-owl-nav"><i class="fas fa-chevron-right"></i></span>'
			],
			responsive: {
				0: {
					items: 1
				},
				768: {
					items: 1
				}
			}
		});
	});
})(jQuery);
