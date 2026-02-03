document.addEventListener('DOMContentLoaded', function() {
	const headerSticky = document.querySelector('.header-sticky');
	
	if (!headerSticky) return;
	
	window.addEventListener('scroll', function() {
		if (window.scrollY > 50) {
			headerSticky.classList.add('sticky');
		} else {
			headerSticky.classList.remove('sticky');
		}
	});

	// Menu mobile toggle
	const menuMobileButton = document.getElementById('menu-mobile-button');
	const menuPrincipal = document.getElementById('menu-principal');
	const menuIcon = menuMobileButton ? menuMobileButton.querySelector('i') : null;

	if (menuMobileButton && menuPrincipal && menuIcon) {
		menuMobileButton.addEventListener('click', function() {
			menuPrincipal.classList.toggle('hidden');
			menuIcon.classList.toggle('fa-bars');
			menuIcon.classList.toggle('fa-times');
		});
	}
});
