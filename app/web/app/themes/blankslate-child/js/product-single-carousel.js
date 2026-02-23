/**
 * Product Single Page - Owl Carousel 2 Initialization & Tabs
 */

jQuery(document).ready(function($) {
	'use strict';

	console.log('🔍 product-single-carousel.js cargado');

	// Product Gallery Carousel
	var mainCarousel = null;
	
	if ($('.product-gallery-carousel').length) {
		console.log('✓ Inicializando product gallery carousel');
		
		// Determine if we have thumbnails
		var hasThumbnails = $('.product-thumbnail-item').length > 0;
		console.log('Has thumbnails:', hasThumbnails);
		
		mainCarousel = $('.product-gallery-carousel').owlCarousel({
			items: 1,
			loop: !hasThumbnails, // Disable loop if we have thumbnails to avoid index mismatch
			nav: true,
			dots: false,
			autoplay: false,
			autoplayTimeout: 5000,
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
		}).data('owl.carousel');

		// Thumbnails Carousel - Using flex layout instead of owl carousel
		if (hasThumbnails && mainCarousel) {
			console.log('✓ Inicializando product thumbnails');
			console.log('Total thumbnails:', $('.product-thumbnail-item').length);
			
			// Set first thumbnail as active by default
			$('.product-thumbnail-item').first().addClass('active');
			
			// Make thumbnails clickable to change main carousel using event delegation
			$(document).on('click', '.product-thumbnail-item', function(e) {
				e.preventDefault();
				e.stopPropagation();
				var $thumbnails = $('.product-thumbnail-item');
				var index = $thumbnails.index(this);
				console.log('Thumbnail clicked, index:', index, 'Total thumbnails:', $thumbnails.length);
				
				// Update active thumbnail immediately
				$thumbnails.removeClass('active');
				$(this).addClass('active');
				console.log('Active class added to thumbnail:', index);
				
				// Trigger carousel to change
				if (mainCarousel) {
					mainCarousel.to(index, 300);
					console.log('Carousel triggered to index:', index);
				}
			});

			// Update active thumbnail when main carousel changes
			$('.product-gallery-carousel').on('changed.owl.carousel', function(event) {
				console.log('Carousel changed event fired');
				console.log('Event:', event);
				var carouselInstance = $(this).data('owl.carousel');
				var realIndex = carouselInstance.relative(carouselInstance.current());
				console.log('Real carousel index:', realIndex, 'Current item index:', event.item.index);
				
				var index = realIndex;
				var $thumbnails = $('.product-thumbnail-item');
				console.log('Setting active thumbnail to index:', index, 'of', $thumbnails.length);
				$thumbnails.removeClass('active');
				$thumbnails.eq(index).addClass('active');
			});
		}
	}

	// Image Modal Functionality
	var modal = $('#imageModal');
	var modalImg = $('#modalImage');
	var captionText = $('#modalCaption');

	// Click on main carousel images to open modal
	$(document).on('click', '.product-gallery-image', function() {
		var imgSrc = $(this).attr('src');
		var imgAlt = $(this).attr('alt');
		
		modal.addClass('active');
		modalImg.attr('src', imgSrc);
		captionText.text(imgAlt);
		$('body').css('overflow', 'hidden');
	});

	// Close modal on click
	$('.modal-close').on('click', function() {
		modal.removeClass('active');
		$('body').css('overflow', '');
	});

	// Close modal when clicking outside the image
	modal.on('click', function(e) {
		if (e.target === this || $(e.target).hasClass('modal-close')) {
			modal.removeClass('active');
			$('body').css('overflow', '');
		}
	});

	// Close modal with Escape key
	$(document).on('keydown', function(e) {
		if (e.key === 'Escape' && modal.hasClass('active')) {
			modal.removeClass('active');
			$('body').css('overflow', '');
		}
	});

	// Related Products Carousel
	if ($('.related-products-carousel').length) {
		console.log('✓ Inicializando related products carousel');
		$('.related-products-carousel').owlCarousel({
			items: 5,
			margin: 15,
			loop: true,
			nav: true,
			dots: false,
			autoplay: true,
			autoplayTimeout: 5000,
			autoplayHoverPause: true,
			navText: [
				'<i class="fas fa-chevron-left"></i>',
				'<i class="fas fa-chevron-right"></i>'
			],
			responsive: {
				0: {
					items: 1,
					margin: 10
				},
				480: {
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

	// Tab Navigation
	console.log('✓ Inicializando tab navigation');
	console.log('Tab buttons found:', $('.tab-button').length);
	
	$('.tab-button').on('click', function(e) {
		e.preventDefault();
		var tabName = $(this).data('tab');
		console.log('Tab clicked:', tabName);
		var tabContent = $('#tab-' + tabName);
		console.log('Tab content found:', tabContent.length);

		// Remove active class from all buttons and content
		$('.tab-button').removeClass('active');
		$('.tab-content').removeClass('active');

		// Add active class to clicked button and corresponding content
		$(this).addClass('active');
		tabContent.addClass('active');
		
		console.log('Tab content active now:', tabContent.hasClass('active'));
	});

	// Set first tab as active by default
	if ($('.tab-button').length) {
		$('.tab-button').first().addClass('active');
		$('.tab-content').first().addClass('active');
	}

});

