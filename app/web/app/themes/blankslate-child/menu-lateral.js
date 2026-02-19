/* ===========================
   LATERAL MENU JAVASCRIPT
   =========================== */

(function() {
	'use strict';

	const menuLateral = document.getElementById('menu-lateral');
	const menuOverlay = document.getElementById('menu-lateral-overlay');
	const menuProductsToggle = document.getElementById('menu-products-toggle');
	const menuCloseBtn = document.getElementById('menu-lateral-close-btn');
	const menuLateralCloseContainer = document.querySelector('.menu-lateral-close');

	// Verificar que todos los elementos existen
	if (!menuLateral || !menuProductsToggle) {
		console.error('No se encontraron elementos del menú lateral');
		return;
	}

	// Toggle menu when clicking on "Productos"
	menuProductsToggle.addEventListener('click', function(e) {
		e.preventDefault();
		e.stopPropagation();
		toggleMenu();
	});

	// Close menu when clicking the close button
	if (menuCloseBtn) {
		menuCloseBtn.addEventListener('click', function(e) {
			e.preventDefault();
			closeMenu();
		});
	}

	// Close menu when clicking on overlay
	if (menuOverlay) {
		menuOverlay.addEventListener('click', function(e) {
			e.preventDefault();
			closeMenu();
		});
	}

	// Close menu when clicking a menu item
	const menuLinks = menuLateral.querySelectorAll('a');
	menuLinks.forEach(function(link) {
		link.addEventListener('click', function() {
			closeMenu();
		});
	});

	// Function to toggle menu
	function toggleMenu() {
		if (menuLateral.classList.contains('active')) {
			closeMenu();
		} else {
			openMenu();
		}
	}

	// Function to open menu
	function openMenu() {
		menuLateral.classList.add('active');
		if (menuOverlay) {
			menuOverlay.classList.add('active');
		}
		if (menuLateralCloseContainer) {
			menuLateralCloseContainer.classList.add('active');
		}
	}

	// Function to close menu
	function closeMenu() {
		menuLateral.classList.remove('active');
		if (menuOverlay) {
			menuOverlay.classList.remove('active');
		}
		if (menuLateralCloseContainer) {
			menuLateralCloseContainer.classList.remove('active');
		}
	}

	// Close menu when pressing Escape key
	document.addEventListener('keydown', function(event) {
		if (event.key === 'Escape' && menuLateral.classList.contains('active')) {
			closeMenu();
		}
	});
})();
