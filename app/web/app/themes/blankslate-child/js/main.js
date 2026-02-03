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
			menuPrincipal.classList.toggle('show');
			menuIcon.classList.toggle('fa-bars');
			menuIcon.classList.toggle('fa-times');
		});
	}

	// Submenu toggle for mobile
	const menuItems = document.querySelectorAll('#menu-principal > li');
	menuItems.forEach(item => {
		const submenu = item.querySelector('ul');
		if (submenu) {
			const link = item.querySelector('a');
			link.addEventListener('click', function(e) {
				// Solo prevenir default si estamos en mobile
				if (window.innerWidth < 768) {
					e.preventDefault();
					item.classList.toggle('active');
				}
			});
		}
	});
});

